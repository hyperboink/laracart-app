<template>
	<div>
		1. {{products.items}}<br><br>
		<ul>
			<li v-for="product in products.items">
				2. {{product.item.title}}
				3. {{products.qty}}
				
				
			</li>
		</ul>

        <input type="text" v-model="wee">
         {{wee}}
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


				
					
				
			     
                <cart-items v-for="items in item" :items="products"></cart-items>
               <!--  <tr  v-for="(product, key) in products.items">
                    <td class="col-sm-8 col-md-6">
     
                        <input type="hidden"  :product="'product['+key+']'" v-model="product.item.title">
                        <input type="hidden"  :qty="'qty['+key+']'" v-model="product.qty">
                        <input type="hidden"  :price="'price['+key+']'" v-model="product.item.price">

	                    <div class="media">
	                        <a class="thumbnail thumbnail-cartpage pull-left" href="#"> <img class="media-object" src="http://placehold.it/72x72" style="width: 72px; height: 72px;"> </a>
	                        <div class="media-body">
	                            <h4 class="media-heading"><a href="#">{{product.item.title}}</a></h4>
	                            <h5 class="media-heading"> by <a href="#">Brand name</a></h5>
	                            <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
	                        </div>
	                    </div>
                    </td>
                    <td class="col-sm-1 col-md-1" style="text-align: center">
                   		

                   		<div class="input-group">
                            <span class="input-group-btn">
                                <a :href="'/reduce/'+product.item.id" class="btn btn-default btn-number" min="0" step="1">
                                    <i class="glyphicon glyphicon-minus"></i>
                                </a>
                            </span>
                            <input type="text" class="form-control qty-input" :data-id="key" :name="'qtyItem['+key+']'"  v-model="product.qty" required=""/>
                            <span class="input-group-btn">
                                <a :href="'/add/'+product.item.id" class="btn btn-default btn-number" >
                                    <i class="glyphicon glyphicon-plus"></i>
                                </a>
                            </span>
                        </div>
                    </td>
                    <td class="col-sm-1 col-md-1 text-center">
                    	<strong>${{product.item.price}}</strong></td>
                    <td class="col-sm-1 col-md-1 text-center">
                        <strong>${{product.item.price * product.qty}}</strong>
                    </td>
                    <td class="col-sm-1 col-md-1">
	                    <a href="" class="btn btn-danger">
	                        <span class="glyphicon glyphicon-remove"></span>
	                         Remove
	                    </a>
                        <a :href="'/update-cart/'+product.item.id" :id="product.item.id" class="btn btn-success update-cart" @click.prevent="updateCart(product.item.id)">Update Cart</a>
                    </td>
                </tr> -->
              
                
                <tr>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td></td>
                    <td class="text-right">
                    	<a href="/update-cart/" class="btn btn-success update-cart">Update Cart</a>
                    </td>
                </tr>

                <tr>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td><h5>Subtotal</h5></td>
                    <td class="text-right"><h5><strong>${{products.totalPrice}} 

                        <slot v-for="(product, key) in products.items">{{product.price * product.qty}}</slot>

                    </strong></h5></td>
                </tr>
                
                <tr class="totalPrice">
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td><h3>Total</h3></td>
                    <td class="text-right"><h3><strong>${{products.totalPrice}}</strong></h3></td>
                </tr>
                <tr>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td>
						<h4>Payment Method</h4>
						<label class="payment-radio">
							<input id="radio-paypal" name="payment-method" data-payment="paypal" type="radio" class="custom-control-input" value="paypal">
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">Pay via Paypal</span>
						</label>
						<label class="payment-radio">
							<input id="radio-creditcard" name="payment-method" data-payment="cc" type="radio" class="custom-control-input" value="creditcard">
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
	                    <a type="button" href="/" class="btn btn-default">
	                        <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
	                    </a>
                    </td>
                    <td>
	                    <input type="hidden" name="totalPrice" value="">
	                    <button type="submit" class="btn checkout-btn btn-success">
	                        Checkout <span class="glyphicon glyphicon-chevron-right"></span>
                  		</button>
                  		<a href="/checkout"  class="btn checkout-btn btn-success">
                  			 Checkout <span class="glyphicon glyphicon-chevron-right"></span>
                  		</a>
                    </td>
                </tr>

        </table>	

	</div>
	

</template>

 
<script>
	
export default{
	mounted(){
		console.log('cart page is ready.');
        
      
	},

    prop:['id'],


	data(){
		return{
			woo: 'haha',
            wee: '',
            qtyItem:'',
            paymentSelected: false,
			products:[],
            item: [],
            listItem: [],

		}
	},

	created(){


		var self = this;
		axios.get('/api/cart').then(function(res){
			self.products = res.data;
            self.item = res.data.items;
			//console.log(self);
		});

       // console.log(this.$children);
       
	},

    computed: {
        
    },

    methods:{
      updateCart(id){
        // console.log(id);
        // console.log(this.item);
        this.item.forEach(function(){
            console.log('yey');
        });
      }
    }
}

</script>