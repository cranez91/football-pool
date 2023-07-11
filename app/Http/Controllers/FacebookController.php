<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
    
class FacebookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
          
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('/comenzar');
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'profile_photo' => $user->avatar,
                    'facebook_id'=> $user->id,
                    'type'=> 'G',
                    'password' => encrypt('2468DuMmmy')
                ]);
                Auth::login($newUser);
                return redirect()->intended('/comenzar');
            }
        
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}