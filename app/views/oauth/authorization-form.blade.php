@extends('layouts.default')

@section('content')

<div class="col-md-4 col-md-offset-4">
	<div class="panel panel-info">Grant Access</div>
	<div class="panel-body">
		{{ Form::open() }}
		@if($errors->has('login'))
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				{{ $errors->first('login', ':message') }}
			</div>
		@endif
		{{ Form::text('client_id', $params['client_id']) }}
		{{ Form::text('redirect_uri', $params['redirect_uri']) }}
		{{ Form::text('response_type', $params['response_type']) }}
		<input type="hidden" name="approve" value="true" />
		<div class="form-group">
			<h2>Do you grant permission for the application to authenticate?</h2>
		</div>
		<div class="form-group">
			{{ Form::submit('Grant', array('class' => 'btn btn-success')) }}
		</div>
		{{ Form::close() }}
	</div>
</div>

@stop