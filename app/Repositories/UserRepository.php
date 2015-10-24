<?php namespace App\Repositories;

use App\User;

class UserRepository {

	public function findByUsernameOrCreate($data)
	{
		return User::firstOrCreate([
			'username'	=> $data->nickname,
			'email'		=> $data->email,
			'avatar'	=> $data->avatar
		]);
	}
}