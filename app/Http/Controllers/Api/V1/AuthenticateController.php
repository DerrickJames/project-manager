<?php 

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Laravel\Socialite\Facades\Socialite;

class AuthenticateController extends Controller
{
	public function authenticate(Request $request)
	{
		if($request->has('redirectUri')) {
			config()->set("services.github.redirect", $request->get('redirectUri'));
		}

		$provider = Socialite::driver('github');
		$provider->stateless();

		$user = $provider->user();

		if(! $user) {
			return response()->json(['error' => 'invalid_user'], 401);
		}
		
        $providerUser = $this->findOrCreateUser($user);

        Auth::login($providerUser, true);

        $token = $this->generateToken($providerUser);

        return response()->json(compact('token'));	
	}

    private function findOrCreateUser($user)
    {
        $authUser = User::where('github_id', $user->id)->first();

        if($authUser) {
            return $authUser;
        }

        return User::create([
            'username'  => $user->name,
            'email' => $user->email,
            'github_id' => $user->id,
            'avatar' => $user->avatar
        ]);
    }	

	private function generateToken($user)
	{
		return JWTAuth::fromUser($user);
	}
}