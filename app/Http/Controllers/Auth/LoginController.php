<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\Role;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function azure()
    {
        return \Socialite::driver('azure')->redirect();
    }

    public function azureRedirect()
    {
        try {
            $user = \Socialite::driver('azure')->user();
        } catch (Exception $e) {
            return redirect('sign-in/azure');
        }        

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect('/');
    }

    private function findOrCreateUser($azureUser)
    {
    $authUser = User::where('email', $azureUser->email)->first();

    if ($authUser){
        return $authUser;
    }else{
        $createdUser =  User::create([
            'name' => $azureUser->name,
            'azure_id' => $azureUser->id,
            'email' => $azureUser->email
        ]);

        $role = Role::find(2);
        $createdUser->roles()->attach($role);

        return $createdUser;
    }


}
}
