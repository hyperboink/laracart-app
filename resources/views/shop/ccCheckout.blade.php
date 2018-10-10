@extends('layouts.main')


@section('title')
  Laracart
@endsection

@section('content')


  <div class="container">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
     
        <div class="panel-body">


               <div class="checkout-error alert alert-danger {{Session::has('error')?'':'hidden'}}">
                 {{Session::get('error')}}
               </div>
   

              <form action="{{route('cc.checkout')}}" accept-charset="UTF-8" id="cc-form" class="clearfix" method="post">
                {{csrf_field()}}
                <div class="form-row">
                  <div class="col-xs-12 form-group">
                    <label class="control-label">Name</label>
                    <input class="form-control" id="name" type="text">
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-xs-12 form-group">
                    <label class="control-label">Name on Card</label>
                    <input class="form-control" id="card-name" size="4" type="text">
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-xs-12 form-group card">
                    <label class="control-label">Card Number</label>
                    <input  id="card-number" class="form-control" size="20" type="text">
                  </div>
                </div>
                <div class="form-row clearfix">
                  <div class="col-xs-4 form-group cvc">
                    <label class="control-label">CVC</label>
                    <input  class="form-control card-cvc" id="card-cvc"  placeholder="ex. 311" size="4" type="text">
                  </div>
                  <div class="col-xs-4 form-group expiration">
                    <label class="control-label">Expiration</label>
                    <input class="form-control card-expiry-month" id="card-expiry-month" placeholder="MM" size="2" type="text">
                  </div>
                  <div class="col-xs-4 form-group expiration">
                    <label class="control-label">&nbsp;</label>
                    <input class="form-control card-expiry-year" id="card-expiry-year" placeholder="YYYY" size="4" type="text">
                  </div>
                </div>
                
                <div class="text-center cc-amount">
                  <hr>
                  <strong>Total: ${{$totalPrice}}</strong> 
                  <hr>
                </div>

                <div class="form-row">
                  <div class="col-md-12 form-group">
                    <button class="form-control btn btn-success submit-button" type="submit">Pay »</button>
                  </div>

              </form>
          </div>
        </div>
    </div>

    
  
   
  </div>




@endsection

@section('js')
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script type="text/javascript" src="{{URL::to('js/checkout.js')}}"></script>

@endsection