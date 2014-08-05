<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('register', 'SentryController@getRegister');
Route::post('register', 'SentryController@postRegister');

Route::get('login', 'SentryController@getLogin');
Route::post('login', 'SentryController@postLogin');

Route::group(array('before' => 'auth'), function()
{
	Route::get('admin', function()
		{
			$user = Sentry::getUser();

			$clients = OauthClient::all();

			return View::make('admin.index', array('user' => $user, 'clients' => $clients));
		});
	Route::get('logout', 'SentryController@logout');
});

Route::get('/oauth/authorize', array('before' => 'check-authorization-params|auth', function()
{
    // get the data from the check-authorization-params filter
    $params = Session::get('authorize-params');

    // get the user id
    $sentryUser = Sentry::getUser();
    $params['user_id'] = $sentryUser->id;

    // display the authorization form
    return View::make('oauth.authorization-form', array('params' => $params));
}));
Route::post('/oauth/authorize', array('before' => 'check-authorization-params|auth|csrf', function()
{
    // get the data from the check-authorization-params filter
    $params = Session::get('authorize-params');

    // get the user id
    $sentryUser = Sentry::getUser();
    $params['user_id'] = $sentryUser->id;


    // check if the user approved or denied the authorization request
    if (Input::get('approve') !== null) {

       $code = AuthorizationServer::newAuthorizeRequest('user', $params['user_id'], $params);

        Session::forget('authorize-params');

        return Redirect::to(AuthorizationServer::makeRedirectWithCode($code, $params));
    }

    if (Input::get('deny') !== null) {

        Session::forget('authorize-params');

        return Redirect::to(AuthorizationServer::makeRedirectWithError($params));
    }
}));

Route::get('oauth/register', 'OauthController@getClientRegistration');
Route::post('oauth/register', function()
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
	$client->secret = $clientSecretRandom;
	$client->name = $clientName;
	$client->save();

	$endpoint = new OauthClientEndpoint;
	$endpoint->client_id = $clientIDRandom;
	$endpoint->redirect_uri = $redirectURI;
	$endpoint->save();

	return Redirect::to('admin');
});