<?php
namespace Illuminate\Foundation\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\StartPeriod;
trait RegistersUsers
{
    use RedirectsUsers;
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $time = date("d-m-y");
        $user->started = $time;
        $user->lastlogin = $time;
        $user->cash = 200000;//first login bonus + default cash
        $user->location = rand(1, 3);
        $user->save();
        //setting the start period (preventing instantly sending cash)
        $UNIXHOUR = 3600;
        //amount of hours
        $hours = 24;
        StartPeriod::create([
            'user' => $user->id,
            'end' => time() + ($hours * $UNIXHOUR)
        ]);
    }
}