<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Stock;
use App\User;
use App\UserStock;

class StocksController extends Controller
{
    public function index()
    {
        //TODO only for testing rates
        StocksController::update();

        $owned = collect([
            0,
            StocksController::getStock(Auth::user(), 1),
            StocksController::getStock(Auth::user(), 2),
            StocksController::getStock(Auth::user(), 3),
            StocksController::getStock(Auth::user(), 4),
            StocksController::getStock(Auth::user(), 5),
            StocksController::getStock(Auth::user(), 6),
            StocksController::getStock(Auth::user(), 7),
            StocksController::getStock(Auth::user(), 8),
            StocksController::getStock(Auth::user(), 9),
            StocksController::getStock(Auth::user(), 10),
        ]);
        return view('stockmarket', array(
            "user" => Auth::user(),
            "stocks" => Stock::all(),
            "limit" => StocksController::getMaxStock(),
            "owned" => $owned
        ));
    }

    public function update()
    {
        $stocks = Stock::all();
        $diff = 200;
            $min = 500;
            $max = 1500;

        foreach ($stocks as $s) {
            $s->lastprice = $s->price;
            $s->price = rand($s->lastprice - $diff, $s->lastprice + $diff);
            if ($s->price > $max)
                $s->price = $max;
            if ($s->price < $min)
                $s->price = $min;
            $s->save();
        }
    }

    public static function addStock(User $user, $stock, $amount) {
        $owned = UserStock::where('user', $user->id)->where('stock', $stock)->get()->count();
        //adding to an already owned stock
        if ($owned == 1) {
            $stock = UserStock::where('user', $user->id)->where('stock', $stock)->get()->first();
            $stock->amount += $amount;
            $stock->save();
        } else if ($owned == 0) { //new addition
            $stock = UserStock::create([
                'user' => $user->id,
                'stock' => $stock,
                'amount' => $amount,
            ]);
            $stock->save();
        }
    }

    public function removeStock(User $user, $stock, $amount) {
        $owned = UserStock::where('user', $user->id)->where('stock', $stock)->get()->count();
        if ($owned == 0)
            return;

        $stock = UserStock::where('user', $user->id)->where('stock', $stock)->get()->first();

        $current = $stock->amount;
        $current -= $amount;
        if ($current <= 0) {
            $stock->delete();
            return;
        } else {
            $stock->amount = $current;
        }
        $stock->save();
    }

    public static function getStock(User $user, $stocknum) {
        $count = UserStock::where('user', $user->id)->where('stock', $stocknum)->get()->count();

        if ($count == 0)
            return 0;

        if ($count == 1) {
            $stock = UserStock::where('user', $user->id)->where('stock', $stocknum)->get()->first();
            return $stock->amount;
        }

    }

    public function exchangeStock(Request $request) {
        $action = $request->input('action');
        $amount = $request->input('amount');
        $stocknum = $request->input('stocknum');
        $user = Auth::user();

        $maxStock = StocksController::getMaxStock();

        $stock = Stock::where('id', $stocknum)->get()->first();

        if ($amount < 1 && $action != "BUYALL" && $action != "SELLALL") {
            return redirect('stockmarket')->with('fail', 'Invalid amount.');
        }

        if ($stocknum == 9 || $stocknum == 10) {
            if ($user->vip == false) {
                return redirect('stockmarket')->with('fail', 'Only VIPs can buy stock from that company.');
            }
        }

        if ($action == "BUY" || $action == "BUYALL") {

            if ((StocksController::getStock(Auth::user(), $stocknum) == $maxStock))
            return redirect('stockmarket')->with('fail', 'You have reached the limit of '.number_format($maxStock).' on this stock.');

            if ($action == "BUYALL")
                $amount = floor($user->cash/$stock->price);

            //lower amount if needed
            if (StocksController::getStock(Auth::user(), $stocknum)+$amount > $maxStock) {
                $amount = ($maxStock-StocksController::getStock($user, $stocknum));
            }

            $price = $stock->price*$amount;

            //check if the user has enough cash to buy this many
            if ($user->cash < $price) {
                return redirect('stockmarket')->with('fail', 'You do not have enough cash to buy that many!');
            }

            $user->cash -= $price;
            $user->save();
            $this->addStock($user, $stocknum, $amount);
            return redirect('stockmarket')->with('success', 'Bought '.number_format($amount).' stock for $'.number_format($price).'.');
        }

        if ($action == "SELL" || $action == "SELLALL") {

            if ($action == "SELLALL")
                $amount = StocksController::getStock($user, $stocknum);

            //lower amount if needed
            if ($amount > StocksController::getStock($user, $stocknum)) {
                return redirect('stockmarket')->with('fail', 'You do not have that much stock to sell.');
            }

            $price = $stock->price*$amount;

            if ($amount < 1) {
                return redirect('stockmarket')->with('fail', 'Invalid amount.');
            }

            $user->cash += $price;
            $user->save();
            $this->removeStock($user, $stocknum, $amount);
            return redirect('stockmarket')->with('success', 'Sold '.number_format($amount).' stock for $'.number_format($price).'.');
        }

    }

    public static function getMaxStock() {
        return 5000;
    }

}
