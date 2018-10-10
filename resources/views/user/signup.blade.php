@extends('layouts.main')


@section('title')
	Laracart
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">

				<div class="panel panel-default">
					<div class="panel-heading">Register</div>
					<div class="panel-body">
						<form action="{{route('user.signup')}}" method="post">
							{{csrf_field()}}
							<div class="form-group">
								<label for="email">Email</label>
								<input type="text" class="form-control" name="email">
							</div>

							<div class="form-group">
								<label for="email">Password</label>
								<input type="password" class="form-control" name="password">
							</div>

							<input type="submit" name="submit" class="btn btn-primary" value="Register">


						</form>
					</div>

				</div>

				
			</div>
			
		  
		</div>
	</div>
@endsection