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

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch(Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch(Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch(Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

    private function findOrCreateUser($user)
    {
        $authUser = User::where('github_id', $user->id)->first();

        if($authUser) {
            return $authUser;
        }

        return User::create([
            'username'  => $user->name,
            'nickname'  => $user->nickname,
            'email'     => $user->email,
            'github_id' => $user->id,
            'avatar'    => $user->avatar
        ]);
    }	

	private function generateToken($user)
	{
		return JWTAuth::fromUser($user);
	}
}
