<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Auction;
use App\MarketOffer;
use App\Company;

class MarketplaceController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $offers = MarketOffer::where('creator', $user->id)->where('creatortype', 0)->get();
        $itemnames = $this->getItemNames();

        $auctions = Auction::all();
        $auctioneers = array();
        $types = array();

        foreach ($auctions as $a) {
            $auctioneers[$a->id] = User::where('id', $a->user)->get()->first()->name;
            $types[$a->id] = "" . ObjectController::getTypeName($a->type) . " " . LocationController::getName($a->location);
        }

        return view('marketplace', array(
            "user" => $user,
            "offers" => $offers,
            'itemnames' => $itemnames,
            "auctions" => $auctions,
            "auctioneers" => $auctioneers,
            "types" => $types
        ));
    }

    /*Company market place*/
    public function companyIndex()
    {
        $user = Auth::user();
        $offers = MarketOffer::where('creator', CompanyController::getAffiliation($user))->where('creatortype', 1)->get();
        $itemnames = $this->getItemNames();

        if (CompanyController::getAffiliation($user) == -1)
            return redirect('companydashboard');

        $company = Company::where('id', CompanyController::getAffiliation($user))->get()->first();

        $options = CompanyController::getOptions($company->id);
        $rights = CompanyController::getRights($user);

        if (!CompanyController::hasRights($user, CompanyController::getOptions($company->id)->viewoffers)) {
            return redirect('companydashboard')->with('fail', 'You do not have permission to view company market offers.');
        }

        return view('companymarket', array(
            "user" => $user,
            "offers" => $offers,
            'itemnames' => $itemnames,
            'options' => $options,
            'rights' => $rights
        ));
    }

    public function createOffer(Request $request)
    {
        $creator = Auth::user()->id;
        $offertype = $request->input('offertype');
        $item = $request->input('item');
        $price = $request->input('price');
        $amount = $request->input('amount');
        $completed = 0;
        $cash = 0;


        $user = User::where('id', $creator)->get()->first();
        $useroffers = MarketOffer::where('creator', $user->id)->where('creatortype', 0)->get()->count();
        $limit = 3;

        if (!$this->validItem($item))
            return redirect('companymarket')->with('fail', 'Invalid item.');

        if ($user->vip == true)
            $limit = 6;

        if ($useroffers == $limit)
            return redirect('marketplace')->with('fail', 'You have reached the ' . $limit . ' offer limit.');

        if ($amount < 1 || $price < 1)
            return redirect('newoffer')->with('fail', 'Invalid amount.');

        /*
         * Buy offer
         */
        if ($offertype == 0) {

            if ($user->cash < $amount * $price)
                return redirect('newoffer')->with('fail', 'You do not have enough cash to create that offer.');

            $user->cash -= $amount * $price;
            $cash = $amount * $price;

            $userMatches = MarketOffer::where('item', $item)
                ->where('creatortype', 0)
                ->where('creator', '!=', $user->id)
                ->where('cancelled', false)
                ->where('price', '<=', $price)
                ->where('offertype', 1)
                ->get()
                ->sortBy('price');

            $companyMatches = MarketOffer::where('item', $item)
                ->where('creatortype', 1)
                ->where('creator', '!=', $user->company)
                ->where('cancelled', false)
                ->where('price', '<=', $price)
                ->where('offertype', 1)
                ->get()
                ->sortBy('price');

            $matches = $userMatches->merge($companyMatches);

            foreach ($matches as $match) {

                if ($completed >= $amount)
                    break;

                if (!$match->amount == $match->completed) {
                    $available = $match->amount - $match->completed;
                    $needed = ($amount - $completed);
                    if ($needed >= $available) {
                        $completed += $available;
                        $match->completed += $available;
                        $cash -= ($available * $match->price);
                        $match->cash += ($available * $match->price);
                    } else {
                        $completed += $needed;
                        $match->completed += $needed;
                        $cash -= ($needed * $match->price);
                        $match->cash += ($needed * $match->price);
                    }
                    $user->save();
                    $match->save();
                }
            }
            $user->save();

            /*
             * sell offer
             */
        } else if ($offertype == 1) {

            if (!$this->hasItem($user, $item, $amount))
                return redirect('newoffer')->with('fail', 'You do not have the required resources to create that offer.');

            $this->removeItem($user, $item, $amount);

            $matches = MarketOffer::where('item', $item)
                ->where('cancelled', false)
                ->where('price', '>=', $price)
                ->where('offertype', 0)
                ->where('creator', '!=', $user->id)
                ->get()
                ->sortByDesc('price');

            $affiliation = CompanyController::getAffiliation($user);

            foreach ($matches as $match) {
                //ignore offers from your own company
                if (!($match->creatortype == 1 && $match->creator == $affiliation)) {
                    if ($completed >= $amount)
                        break;
                    if (!$match->amount == $match->completed) {
                        $needed = $match->amount - $match->completed;
                        $available = $amount - $completed;
                        if ($needed >= $available) {
                            $match->completed += $available;
                            $completed += $available;
                            $cash += ($price * $available);
                            $match->cash -= ($price * $available);
                        } else {
                            $match->completed += $needed;
                            $completed += $needed;
                            $cash += ($price * $needed);
                            $match->cash -= ($price * $needed);
                        }
                        $match->save();
                    }
                }
            }
        }

        //all matches have been applied, saving the offer into the database.
        $offer = MarketOffer::create([
            'creator' => $creator,
            'creatortype' => 0,
            'offertype' => $offertype,
            'item' => $item,
            'price' => $price,
            'amount' => $amount,
            'completed' => $completed,
            'collected' => 0,
            'cash' => $cash,
            'cancelled' => false
        ]);
        $offer->save();

        return redirect('marketplace')->with('success', 'Offer created.');
    }

    public function createCompanyOffer(Request $request)
    {

        $creator = CompanyController::getAffiliation(Auth::user());
        $offertype = $request->input('offertype');
        $item = $request->input('item');
        $price = $request->input('price');
        $amount = $request->input('amount');
        $completed = 0;
        $cash = 0;

        $company = Company::where('id', $creator)->get()->first();
        $companyoffers = MarketOffer::where('creator', $company->id)->where('creatortype', 1)->get()->count();
        $limit = 2;

        if ($item == 3) //cant buy/sell prestige points as a company
            return redirect('companymarket')->with('fail', 'You can not buy/sell prestige points as a company.');

        if (!$this->validItem($item))
            return redirect('companymarket')->with('fail', 'Invalid item.');

        if ($companyoffers == $limit)
            return redirect('companymarket')->with('fail', 'You have reached the ' . $limit . ' offer limit.');

        if ($amount < 1 || $price < 1)
            return redirect('newcompanyoffer')->with('fail', 'Invalid amount.');

        /*COMPANY BUY OFFER*/
        if ($offertype == 0) {

            if ($company->cash < $amount * $price)
                return redirect('newcompanyoffer')->with('fail', 'The company does not have enough cash to create that offer.');

            $company->cash -= $amount * $price;
            $cash = $amount * $price;

            $userMatches = MarketOffer::where('item', $item)
                ->where('creatortype', 0)
                ->where('cancelled', false)
                ->where('price', '<=', $price)
                ->where('offertype', 1)
                ->get()
                ->sortBy('price');

            //remove company members from list
            foreach ($userMatches as $match) {
                if (CompanyController::getAffiliation($match->creator) == $company->id) {
                    $userMatches = $userMatches->except($match->id);
                }
            }

            $companyMatches = MarketOffer::where('item', $item)
                ->where('creatortype', 1)
                ->where('creator', '!=', $company->id)
                ->where('cancelled', false)
                ->where('price', '<=', $price)
                ->where('offertype', 1)
                ->get()
                ->sortBy('price');

            $matches = $userMatches->merge($companyMatches);

            foreach ($matches as $match) {

                if ($completed >= $amount)
                    break;

                if (!$match->amount == $match->completed) {
                    $available = $match->amount - $match->completed;
                    $needed = ($amount - $completed);
                    if ($needed >= $available) {
                        $completed += $available;
                        $match->completed += $available;
                        $cash -= ($available * $match->price);
                        $match->cash += ($available * $match->price);
                    } else {
                        $completed += $needed;
                        $match->completed += $needed;
                        $cash -= ($needed * $match->price);
                        $match->cash += ($needed * $match->price);
                    }
                    $company->save();
                    $match->save();
                }
            }
            $company->save();
        } else if ($offertype == 1) { /*SELL OFFER BY COMPANY*/
            if (!$this->hasItem($company, $item, $amount))
                return redirect('newcompanyoffer')->with('fail', 'The company does not have the required resources to create that offer.');

            $this->removeItem($company, $item, $amount);

            $userMatches = MarketOffer::where('item', $item)
                ->where('creatortype', 0)
                ->where('cancelled', false)
                ->where('price', '>=', $price)
                ->where('offertype', 0)
                ->where('creator', '!=', $company->id)
                ->get()
                ->sortByDesc('price');

            //remove company members from list
            foreach ($userMatches as $match) {
                if (CompanyController::getAffiliation($match->creator) == $company->id) {
                    $userMatches = $userMatches->except($match->id);
                }
            }

            $companyMatches = MarketOffer::where('item', $item)
                ->where('creatortype', 1)
                ->where('cancelled', false)
                ->where('price', '>=', $price)
                ->where('offertype', 0)
                ->where('creator', '!=', $company->id)
                ->get()
                ->sortByDesc('price');

            $matches = $userMatches->merge($companyMatches);

            foreach ($matches as $match) {

                if ($completed >= $amount)
                    break;
                if (!$match->amount == $match->completed) {
                    $needed = $match->amount - $match->completed;
                    $available = $amount - $completed;
                    if ($needed >= $available) {
                        $match->completed += $available;
                        $completed += $available;
                        $cash += ($price * $available);
                        $match->cash -= ($price * $available);
                    } else {
                        $match->completed += $needed;
                        $completed += $needed;
                        $cash += ($price * $needed);
                        $match->cash -= ($price * $needed);
                    }
                    $match->save();
                }
            }
        }

        //all matches have been applied, saving the offer into the database.
        $offer = MarketOffer::create([
            'creator' => $creator,
            'creatortype' => 1,
            'offertype' => $offertype,
            'item' => $item,
            'price' => $price,
            'amount' => $amount,
            'completed' => $completed,
            'collected' => 0,
            'cash' => $cash,
            'cancelled' => false
        ]);
        $offer->save();

        return redirect("companymarket")->with("success", "Offer created.");
    }

    public function cancelOffer(Request $request)
    {
        $user = Auth::user();
        $offer = MarketOffer::where('id', $request->input('id'))->get()->first();;

        if ($offer->creatortype == 0) {
            if (Auth::user()->id != $offer->creator) {
                return redirect('marketplace')->with('fail', 'That is not your offer.');
            }
            $redirect = 'marketplace';
        }

        $company = Company::where('id', CompanyController::getAffiliation($user))->get()->first();

        if ($offer->creatortype == 1) {
            if (CompanyController::getAffiliation(Auth::user()) != $offer->creator) {

                return redirect('marketplace')->with('fail', 'You do not have permission to cancel that offer.');
            }
            if (!CompanyController::hasRights(Auth::user(), CompanyController::getOptions($company->id)->makeoffers)) {
                return redirect('companydashboard')->with('fail', 'You do not have permission to handle company market offers.');
            }
            $redirect = 'companymarket';
        }

        if ($offer->amount == $offer->completed)
            return redirect($redirect)->with('neutral', 'Offer has already been completed, please collect.');

        $offer->cancelled = true;
        $offer->save();
        return redirect($redirect)->with('success', 'Offer cancelled.');
    }

    public function collectOffer(Request $request)
    {
        $offer = MarketOffer::where('id', $request->input('id'))->get()->first();
        $toCollect = $offer->completed - $offer->collected;

        if ($offer->creatortype != 0)
            return redirect('marketplace')->with('fail', 'Invalid offer.');

        if (Auth::user()->id != $offer->creator) {
            return redirect('marketplace')->with('fail', 'That is not your offer.');
        }

        $user = Auth::user();

        if ($offer->offertype == 0) { //buy offer

            if ($offer->cancelled == false && $toCollect <= 0)
                return redirect('marketplace')->with('fail', 'The collection box of this offer is currently empty.');

            $this->addItem($user, $offer->item, $toCollect);
            $offer->collected += $toCollect;
            $offer->save();
            if ($offer->cancelled == true || $offer->amount == $offer->completed) {
                $cash = $offer->cash;
                $user->cash += $cash;
                $user->save();
                $offer->delete();

                if ($offer->amount == $offer->completed) {
                    //unlock exchanger title
                    ProfileController::forceUnlockTitle(11);
                }

                if ($cash > 0)
                    return redirect('marketplace')->with('success', 'Collected ' . number_format($toCollect) . ' items and $' . number_format($cash) . '. The offer has been removed.');
                else
                    return redirect('marketplace')->with('success', 'Collected ' . number_format($toCollect) . ' items. The offer has been removed.');
            } else {
                return redirect('marketplace')->with('success', 'Collected ' . number_format($toCollect) . ' items.');
            }

        } else if ($offer->offertype == 1) { // sell offer

            if ($offer->cancelled == false && $toCollect <= 0)
                return redirect('marketplace')->with('fail', 'The collection box of this offer is currently empty.');

            $cash = $offer->cash;
            $user->cash += $cash;
            $offer->cash = 0;
            $user->save();
            $offer->save();
            $offer->collected += $toCollect;
            if ($offer->cancelled == true || $offer->amount == $offer->completed) {
                $this->addItem($user, $offer->item, $offer->amount - $offer->completed);
                $offer->delete();

                if ($offer->amount == $offer->completed) {
                    //unlock exchanger title
                    ProfileController::forceUnlockTitle(11);
                }

                if ($offer->amount - $offer->completed > 0)
                    return redirect('marketplace')->with('success', 'Collected ' . number_format($offer->amount - $offer->completed) . ' items and $' . number_format($cash) . '. The offer has been removed.');
                else
                    return redirect('marketplace')->with('success', 'Collected $' . number_format($cash) . '. The offer has been removed.');
            } else {
                return redirect('marketplace')->with('success', 'Collected $' . number_format($cash) . '.');
            }
        }
    }

    public function collectCompanyOffer(Request $request)
    {
        $offer = MarketOffer::where('id', $request->input('id'))->get()->first();
        $toCollect = $offer->completed - $offer->collected;
        $company = Company::where('id', $offer->creator)->get()->first();

        if ($offer->creatortype != 1)
            return redirect('companymarket')->with('fail', 'Invalid offer.');

        if (CompanyController::getAffiliation(Auth::user()) != $offer->creator) {
            return redirect('companymarket')->with('fail', 'You do not have permission to cancel that offer.');
        }
        if (!CompanyController::hasRights(Auth::user(), CompanyController::getOptions($company->id)->makeoffers)) {
            return redirect('companydashboard')->with('fail', 'You do not have permission to handle company market offers.');
        }

        if ($offer->offertype == 0) { //buy offer

            if ($offer->cancelled == false && $toCollect <= 0)
                return redirect('companymarket')->with('fail', 'The collection box of this offer is currently empty.');

            $this->addItem($company, $offer->item, $toCollect);
            $offer->collected += $toCollect;
            $offer->save();
            if ($offer->cancelled == true || $offer->amount == $offer->completed) {
                $cash = $offer->cash;
                $company->cash += $cash;
                $company->save();
                $offer->delete();

                if ($cash > 0)
                    return redirect('companymarket')->with('success', 'Collected ' . number_format($toCollect) . ' items and $' . number_format($cash) . '. The offer has been removed.');
                else
                    return redirect('companymarket')->with('success', 'Collected ' . number_format($toCollect) . ' items. The offer has been removed.');
            } else {
                return redirect('companymarket')->with('success', 'Collected ' . number_format($toCollect) . ' items.');
            }

        } else if ($offer->offertype == 1) { // sell offer

            if ($offer->cancelled == false && $toCollect <= 0)
                return redirect('companymarket')->with('fail', 'The collection box of this offer is currently empty.');

            $cash = $offer->cash;
            $company->cash += $cash;
            $offer->cash = 0;
            $company->save();
            $offer->save();
            $offer->collected += $toCollect;
            if ($offer->cancelled == true || $offer->amount == $offer->completed) {
                $this->addItem($company, $offer->item, $offer->amount - $offer->completed);
                $offer->delete();

                if ($offer->amount - $offer->completed > 0)
                    return redirect('companymarket')->with('success', 'Collected ' . number_format($offer->amount - $offer->completed) . ' items and $' . number_format($cash) . '. The offer has been removed.');
                else
                    return redirect('companymarket')->with('success', 'Collected $' . number_format($cash) . '. The offer has been removed.');
            } else {
                return redirect('companymarket')->with('success', 'Collected $' . number_format($cash) . '.');
            }
        }
    }


    public function hasItem($user, $item, $amount)
    {
        switch ($item) {
            case 0://wood
                return $user->wood >= $amount;
            case 1://stone
                return $user->stone >= $amount;
            case 2://oil
                return $user->oil >= $amount;
            case 3://prestige point
                return $user->prestigepoints >= $amount;
            case 4://planks
                return $user->planks >= $amount;
            case 5://bricks
                return $user->bricks >= $amount;
            case 6://gasoline
                return $user->gasoline >= $amount;
        }
    }

    public function removeItem($user, $item, $amount)
    {
        switch ($item) {
            case 0://wood
                $user->wood -= $amount;
                break;
            case 1://stone
                $user->stone -= $amount;
                break;
            case 2://oil
                $user->oil -= $amount;
                break;
            case 3://prestige point
                $user->prestigepoints -= $amount;
                break;
            case 4://planks
                $user->planks -= $amount;
                break;
            case 5://bricks
                $user->bricks -= $amount;
                break;
            case 6://gasoline
                $user->gasoline -= $amount;
                break;
        }
        $user->save();
    }

    public function addItem($user, $item, $amount)
    {
        switch ($item) {
            case 0://wood
                $user->wood += $amount;
                break;
            case 1://stone
                $user->stone += $amount;
                break;
            case 2://oil
                $user->oil += $amount;
                break;
            case 3://prestige point
                $user->prestigepoints += $amount;
                break;
            case 4://planks
                $user->planks += $amount;
                break;
            case 5://bricks
                $user->bricks += $amount;
                break;
            case 6://gasoline
                $user->gasoline += $amount;
                break;
        }
        $user->save();
    }

    public function validItem($item)
    {
        if ($item < 0)
            return false;

        if ($item > count($this->getItemNames()) - 1)
            return false;

        return true;
    }

    public function getItemNames()
    {
        return collect(["Wood", "Stone", "Oil", "Prestige point", "Planks", "Bricks", "Gasoline"]);
    }

    public function newOffer()
    {
        return view('newoffer', array("user" => Auth::user()));
    }

    public function newCompanyOffer()
    {
        $user = Auth::user();
        $cid = CompanyController::getAffiliation($user);

        if ($cid == -1) {
            return redirect("companyprofile");
        }

        $company = Company::where('id', $cid)->get()->first();

        if (!CompanyController::hasRights($user, CompanyController::getOptions($company->id)->makeoffers)) {
            return redirect('companymarket')->with('fail', 'You do not have permission to handle company market offers.');
        }

        return view('newcompanyoffer', array("user" => Auth::user()));
    }

    public static function getAvgItemPrice($item)
    {
        $offers = MarketOffer::where('item', $item)->get();
        $amount = 0;
        $pricetotal = 0;
        foreach ($offers as $offer) {
            $a = $offer->amount - $offer->completed;

            $amount += $a;
            $pricetotal += $a * $offer->price;
        }

        if ($amount == 0)
            return 0;

        return ($pricetotal / $amount);
    }

    public static function getMedianPrice($item)
    {
        $offers = MarketOffer::where('item', $item)->get();
        $amount = 0;
        $i = 0;
        $array = array();
        foreach ($offers as $offer) {
            if ($offer->cancelled == false) {
                $a = $offer->amount - $offer->completed;
                for ($t = $i; $i < $t + $a; $i++) {
                    $array[$i] = $offer->price;
                    $amount++;
                }
            }
        }

        if ($amount == 0)
            return 0;

        return self::calculateMedian($array);
    }

    public static function getItemAmount($item)
    {
        $offers = MarketOffer::where('item', $item)->get();
        $total = 0;
        foreach ($offers as $offer) {
            if ($offer->cancelled == false)
            $total += ($offer->amount - $offer->completed);
        }

        return $total;
    }

    static function calculateMedian($Values)
    {
        //Remove array items less than 1

        //Sort the array into descending order 1 - ?
        sort($Values, SORT_NUMERIC);

        //Find out the total amount of elements in the array
        $Count = count($Values);

        //Check the amount of remainders to calculate odd/even
        if ($Count % 2 == 0) {
            return $Values[$Count / 2];
        }

        return (($Values[($Count / 2)] + $Values[($Count / 2) - 1]) / 2);
    }

    public function marketPrices()
    {

        $items = $this->getItemNames();

        $prices = array();
        $amounts = array();

        $quicksells = array();
        //TODO AMOUNT OF LOCATIONS
        $locations = 3;
        for ($l = 1; $l <= $locations; $l++) {
            $allprices = array();
            for ($i = 0; $i < count($items); $i++) {
                $allprices[$i] = LocationController::getSellPrice($l, $i);
            }
            $quicksells[$l] = $allprices;
        }

        for ($i = 0; $i < count($items); $i++) {
            $prices[$i] = self::getMedianPrice($i);
            $amounts[$i] = self::getItemAmount($i);
        }

        return view('marketprices', array(
            "user" => Auth::user(),
            "prices" => $prices,
            "items" => $items,
            "amounts" => $amounts,
            'quicksells' => $quicksells
        ));
    }
}
