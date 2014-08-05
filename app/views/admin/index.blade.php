@extends('layouts.default')

@section('content')

<h2>Admin Section</h2>
{{ $user->email }}
{{ $user->id }}
{{ HTML::link('oauth/register', 'New Client', array('class' => 'btn btn-warning')) }}
{{ HTML::link('logout', 'Logout', array('class' => 'btn btn-warning')) }}
<br />
@foreach ($clients as $client)
<div style="display: inline-block; margin:10px; padding: 5px; border: 1px solid black;">
	<h2>{{ $client->name }}</h2>
	<li>ID: {{ $client->id }}</li>
	<li>Secret: {{ $client->secret }}</li>
	<li>Redirect URI:{{ $client->endpoint->redirect_uri }}</li>
</div>
@endforeach

@stop

http://localhost:8000/oauth/authorize?client_id=W0U1f&redirect_uri=http://test.com&response_type=code