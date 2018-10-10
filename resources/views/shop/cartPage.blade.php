@extends('layouts.main')


@section('title')
	Laracart
@endsection

@section('content')
	<div class="container">
	@if(Session::has('cart'))
	<div class="panel panel-default cart-panel">

		<div class="panel-body">
			<h3>Your Cart</h3>
			<form action="{{route('payment')}}" method="post">
				{{csrf_field()}}
				
				<table class="table table-hover">
		            <thead>
		                <tr>
		                    <th>Product</th>
		                    <th>Quantity</th>
		                    <th class="text-center">Price</th>
		                    <th class="text-center">Total</th>
		                    <th>&nbsp;</th>
		                </tr>
		            </thead>
		            <tbody>

						@foreach($products as $i=>$product)
							
							<input type="hidden" name="product[{{$i}}]" value="{{$product['item']['title']}}">
							<input type="hidden" name="qty[{{$i}}]" value="{{$product['qty']}}">
							<input type="hidden" name="price[{{$i}}]" value="{{$product['item']['price']}}">
						

		                <tr>
		                    <td class="col-sm-8 col-md-6">
		                    <div class="media">
		                        <a class="thumbnail thumbnail-cartpage pull-left" href="#"> <img class="media-object" src="http://placehold.it/72x72" style="width: 72px; height: 72px;"> </a>
		                        <div class="media-body">
		                            <h4 class="media-heading"><a href="#">{{$product['item']['title']}}</a></h4>
		                            <h5 class="media-heading"> by <a href="#">Brand name</a></h5>
		                            <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
		                        </div>
		                    </div></td>
		                    <td class="col-sm-1 col-md-1" style="text-align: center">
		                   		
		                   		<div class="input-group">
	                                <span class="input-group-btn">
	                                    <a href="{{route('product.reduceByOne',['id'=>$product['item']['id']])}}" class="btn btn-default btn-number" min="0" step="1">
	                                        <i class="glyphicon glyphicon-minus"></i>
	                                    </a>
	                                </span>
	                                <input type="text" class="form-control qty-input" name="qtyItem[{{$i}}]" value="{{$product['qty']}}"  required="">
	                                <span class="input-group-btn">
	                                    <a href="{{route('product.addByOne',['id'=>$product['item']['id']])}}" class="btn btn-default btn-number" >
	                                        <i class="glyphicon glyphicon-plus"></i>
	                                    </a>
	                                </span>
	                            </div>
		                    </td>
		                    <td class="col-sm-1 col-md-1 text-center"><strong>${{$product['item']['price']}}</strong></td>
		                    <td class="col-sm-1 col-md-1 text-center"><strong>${{$product['price']}}</strong></td>
		                    <td class="col-sm-1 col-md-1">
			                    <a href="{{route('product.removeCart',['id'=>$product['item']['id']])}}" class="btn btn-danger">
			                        <span class="glyphicon glyphicon-remove"></span>
			                         Remove
			                    </a>
		                    </td>
		                </tr>
		                @endforeach
		                
		                <tr>
		                    <td> &nbsp; </td>
		                    <td> &nbsp; </td>
		                    <td> &nbsp; </td>
		                    <td></td>
		                    <td class="text-right">
		                    	<button type="button" class="btn btn-success update-cart">Update Cart</button>
		                    </td>
		                </tr>

		                <tr>
		                    <td> &nbsp; </td>
		                    <td> &nbsp; </td>
		                    <td> &nbsp; </td>
		                    <td><h5>Subtotal</h5></td>
		                    <td class="text-right"><h5><strong>${{$totalPrice}}</strong></h5></td>
		                </tr>
		                
		                <tr class="totalPrice">
		                    <td> &nbsp; </td>
		                    <td> &nbsp; </td>
		                    <td> &nbsp; </td>
		                    <td><h3>Total</h3></td>
		                    <td class="text-right"><h3><strong>${{$totalPrice}}</strong></h3></td>
		                </tr>
		                <tr>
		                    <td> &nbsp; </td>
		                    <td> &nbsp; </td>
		                    <td> &nbsp; </td>
		                    <td>
								<h4>Payment Method</h4>
								<label class="payment-radio">
									<input id="radio-paypal" name="payment-method" type="radio" checked="checked" class="custom-control-input" value="paypal">
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description">Pay via Paypal</span>
								</label>
								<label class="payment-radio">
									<input id="radio-creditcard" name="payment-method" type="radio" class="custom-control-input" value="creditcard">
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description">Credit Card</span>
								</label>
		                    </td>
		                    <td>
		                    
		                    </td>
		                </tr>
		                <tr>
		                    <td> &nbsp; </td>
		                    <td> &nbsp; </td>
		                    <td> &nbsp; </td>
		                    <td>
			                    <a type="button" href="{{route('shop.index')}}" class="btn btn-default">
			                        <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
			                    </a>
		                    </td>
		                    <td>
			                    <input type="hidden" name="totalPrice" value="{{$totalPrice}}">
			                    <button type="submit" class="btn checkout-btn btn-success">
			                        Checkout <span class="glyphicon glyphicon-chevron-right"></span>
		                  		</button>
		                  		<a href="{{route('cc.checkout')}}"  class="btn checkout-btn btn-success">
		                  			 Checkout <span class="glyphicon glyphicon-chevron-right"></span>
		                  		</a>
		                    </td>
		                </tr>

		            </tbody>
		        </table>

		       </form>

	    </div>
	</div>


	@else
		There's no products on your cart.
	@endif
	</div>
@endsection

@section('js')
	<script type="text/javascript"  src="{{URL::to('js/script.js')}}"></script>
	
@endsection