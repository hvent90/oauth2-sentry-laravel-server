<?php

use App\Models\OauthClient;
use App\Models\OauthClientEndpoint;

class SentryController extends BaseController {
	/*
	Adds some m'fin users
	*/

	public function getRegister()
	{
		return View::make('sentry.register');
	}

	public function postRegister()
	{
		try
		{
			$user = Sentry::createUser(array(
				'first_name' => Input::get('first_name'),
				'last_name' => Input::get('last_name'),
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'activated' => true
				));
		}

		catch(Cartalyst\SentryUsers\UserExistsException $e)
		{
			echo 'This user already exists.';
		}

		return Redirect::to('/');
	}

	public function getLogin()
	{
		return View::make('sentry.login');
	}

	public function postLogin()
	{
		$credentials = array(
			'email' => Input::get('email'),
			'password' => Input::get('password')
			);

		try
		{
			$user = Sentry::authenticate($credentials, false);

			if($user)
			{
				return Redirect::to('admin');
			}
		}
		catch(\Exception $e)
		{
			return Redirect::to('login')->withErrors(array('login' => $e->getMessages()));
		}
	}

	public function logout()
	{
		Sentry::logout();

		return Redirect::to('/');
	}
}