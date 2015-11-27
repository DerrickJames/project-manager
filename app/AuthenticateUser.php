<?php namespace App;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Guard;
use Laravel\Socialite\Contracts\Factory as Socialite;

class AuthenticateUser {

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var Socialite
     */
    private $socialite;

    /**
     * @var Authenticator
     */
    private $auth;

    /**
     * @param UserRepository $users
     * @param Socialite $socialite
     * @param Authenticator $auth
     */
    public function __construct(UserRepository $users, Socialite $socialite, Guard $auth)
    {
        $this->users = $users;
        $this->socialite = $socialite;
        $this->auth = $auth;
    }    

	public function execute($hasCode, $listener)
	{
		if(! $hasCode) return $this->getAuthorizationFirst();

		$user = $this->users->findByUsernameOrCreate($this->getSocialUser());

		$this->auth->login($user, true);

		return $listener->userHasLoggedIn($user);
	}

	private function getAuthorizationFirst()
	{	
		return $this->socialite->driver('github')->redirect();
	}

	private function getSocialUser()
	{
		return $this->socialite->driver('github')->user();
	}
}