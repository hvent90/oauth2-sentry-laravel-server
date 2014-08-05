@extends('layouts.default')

@section('content')

<div class="col-md-4 col-md-offset-4">
	<div class="panel panel-info">Sync a Curator Server</div>
	<div class="panel-body">
		{{ Form::open(array('url' => 'oauth/register')) }}
		<div class="form-group">
			{{ Form::label('name', 'Name of Curator Server') }}
			{{ Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Curator Server #x')) }}
		</div>
		<div class="form-group">
			{{ Form::label('redirect_uri', 'Redirect URI') }}
			{{ Form::text('redirect_uri', '', array('class' => 'form-control', 'placeholder' => 'local.curator.com/x')) }}
		</div>
		<div class="form-group">
			{{ Form::submit('Register', array('class' => 'btn btn-success')) }}
		</div>
		{{ Form::close() }}
	</div>
</div>

@stop