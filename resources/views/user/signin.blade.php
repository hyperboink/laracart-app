@extends('layouts.main')


@section('title')
	Laracart
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">

				@if(Session::get('message'))
					<div class="alert alert-success">{{Session::get('message')}}	</div>
				@endif

				@if(Session::get('login_message'))
					<div class="alert alert-danger">{{Session::get('login_message')}}	</div>
				@endif
				
				@if(count($errors) > 0)
					<div class="alert alert-danger">
					@foreach($errors->all() as $error)
						<p>{{$error}}</p>
					@endforeach
					</div>
				@endif

				<div class="panel panel-default">
					<div class="panel-body">
						<form action="{{route('user.signin')}}" method="post">
							{{csrf_field()}}
							<div class="form-group">
								<label for="email">Email</label>
								<input type="text" class="form-control" name="email">
							</div>

							<div class="form-group">
								<label for="email">Password</label>
								<input type="password" class="form-control" name="password">
							</div>

							<input type="submit" name="submit" class="btn btn-primary pull-left" value="Sign In">

							<a class="pull-right" href="{{route('user.signup')}}">Create an account?</a>

						</form>
					</div>

				</div>

				
			</div>
			
		  
		</div>
	</div>
@endsection