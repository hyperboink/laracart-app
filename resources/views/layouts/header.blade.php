<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{route('shop.index')}}">Laracart</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
       <li><a href="{{route('product.cartPage')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge">{{Session::has('cart')?Session::get('cart')->totalQty:''}}</span></a></li>

         
        @if(Auth::guest())
          <li><a href="{{ route('user.signin') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Sign In</a></li>
        @else 
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{route('user.profile')}}">User Profile</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{route('user.logout')}}">Logout</a></li>
            </ul>
          </li>
        @endif
            
            
            
          
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>