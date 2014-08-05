<?php

use App\Models\OauthClient;
use App\Models\OauthClientEndpoint;

class OauthController extends BaseController {

	public function getClientRegistration()
	{
		return View::make('oauth.register');
	}

	public function postClientRegistration()
	{
		$clientIDRandom = str_random(5);
		$clientSecretRandom = str_random(8);
		$clientName = Input::get('name');
		$redirectURI = Input::get('redirect_uri');

		// $client = OauthClient::create(array(
		// 	'id' => $clientIDRandom,
		// 	'secret' => $clientSecretRandom,
		// 	'name' => $clientName
		// 	));

		// $endpoint = OauthClientEndpoint::create(array(
		// 	'client_id' => $clientIDRandom,
		// 	'redirect_uri' => $redirectURI
		// 	));

		$client = new OauthClient;
		$client->id = $clientIDRandom;
		$client->secret->$clientSecretRandom;
		$client->name->$clientName;

		$endpoint = new OauthClientEndpoint;
		$endpoint->client_id->$clientIDRandom;
		$endpoint->redirect_uri->$redirectURI;

		return Redirect::to('admin');
	}
}