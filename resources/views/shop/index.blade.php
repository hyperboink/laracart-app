@extends('layouts.main')


@section('title')
	Laracart
@endsection

@section('content')
	<div class="container">
	
		@if(Session::has('success'))
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success">{{Session::get('success')}}</div>
				</div>
			</div>
		@endif

		<div class="row">
			
			@foreach($products as $product)
				<div class="col-sm-6 col-md-3">
				    <div class="thumbnail">
				      	<img src="{{$product->image_path}}" alt="...">
				     	 <div class="caption text-center">
					        <h3>{{$product->title}}</h3>
					        <p>${{$product->price}}</p>
					        <p><a href="{{route('product.addCart',$product->id)}}" class="btn btn-default" role="button">Add To Cart</a></p>
					      </div>
				    </div>
				 </div>
			@endforeach
		  
		</div>
	</div>
@endsection