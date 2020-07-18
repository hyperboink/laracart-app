<template>
	<div>
		

       
			<div class="tableDiv">

				<div class="tableRow">
					<div class="tableData col-sm-8 col-md-6"><strong>Product</strong></div>
					<div class="tableData col-sm-1 col-md-2 text-center"><strong>Quantity</strong></div>
					<div class="tableData col-sm-1 col-md-1 text-center"><strong>Price</strong></div>
					<div class="tableData col-sm-1 col-md-1 text-center"><strong>Total</strong></div>
					<div class="tableData col-sm-1 col-md-2"></div>

				</div>

				<form action="/update-cart-all" method="post">
					<input type="hidden" name="_token" :value="csrf">
					<input name="_method" type="hidden" value="PUT">
					<div class="tableRow" v-for="(product, index) in products.items">
				   		<cart-item :prod="product" :key="product" :index="index" @remove="removeProduct"></cart-item>
					</div>
					
					<div class="tableRow">

						<div class="tableData col-sm-1 col-md-12 text-right"><button type="submit" class="btn btn-success update-cart">Update Cart</button></div>
					</div>
				</form>

				<div class="tableRow">
					<div class="tableData col-sm-1 col-md-8"></div>
					<div class="tableData col-sm-1 col-md-1"></div>
					<div class="tableData col-sm-1 col-md-1">SubTotal</div>
					<div class="tableData col-sm-1 col-md-2 text-right"><strong> ${{total}}</strong></div>
				</div>

				<div class="tableRow">
					<div class="tableData col-sm-1 col-md-8"></div>
					<div class="tableData col-sm-1 col-md-1"></div>
					<div class="tableData col-sm-1 col-md-1"><h3>Total</h3></div>
					<div class="tableData col-sm-1 col-md-2 text-right"><h3><strong>${{total}}</strong></h3></div>
				</div>

				<div class="tableRow">
					<div class="tableData col-sm-1 col-md-8"></div>
					<div class="tableData col-sm-1 col-md-1"></div>	
					<div class="tableData col-sm-1 col-md-2">
						<h4>Payment Method</h4>
						<label class="payment-radio">
							<input id="radio-paypal" type="radio" name="paymentTypeBox" class="custom-control-input"  v-model="paymentType" value="0">
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">Pay via Paypal</span>
						</label>
						<label class="payment-radio">
							<input id="radio-creditcard" type="radio" name="paymentTypeBox" class="custom-control-input" v-model="paymentType" value="1">
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">Credit Card</span>
						</label>
						{{paymentMethod}}
					</div>
					<div class="tableData col-sm-1 col-md-1 text-right"></div>
				</div>

				<div class="tableRow">
					<div class="tableData col-sm-1 col-md-6"></div>
					<div class="tableData col-sm-1 col-md-2">
						
					</div>
					<div class="tableData col-sm-1 col-md-4 text-right">
			      		<a type="button" href="/" class="btn btn-default">
			                <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
			            </a>
			      		<a :href="paymentLink"  class="ppBtn btn checkout-btn btn-success">
			      			 Checkout <span class="glyphicon glyphicon-chevron-right"></span>
			      		</a>
					</div>
				</div>

				

			</div>

	</div>
	

</template>

 
<script>
	
export default{
	mounted(){
		console.log('cart page is ready.sdsf');
        this.csrf = window.Laravel.csrfToken   
      	
	},



	data(){
        return{
        	csrf:'',
        	productsw: [], 
        	products:[],
        	paymentType:'',
        	paymentLink:'/',
        	wee:[]
        }
	},

	created(){
		var self = this;

		axios.get('/api/cart').then(function(res){

			self.products = res.data;
			
		});


   		
       
	},

    computed: {

    	paymentMethod(){
    		( this.paymentType == 0 )
    			? this.paymentLink = '/paypalCheckout'
    			: this.paymentLink = '/checkout';
    	},

    	total(){

    		let total = [];

    		if(this.products.items){

    			Object.entries(this.products.items).forEach(([k, o])=>{
    				total.push(o.qty * o.item.price);
    			});

    			return total.reduce(function(a,b){
    				return a+b;
    			}, 0);
    			

    		}




    	}
    },

    methods:{
    	removeProduct(product){

    		console.log(product);
    		
    		//this.products.items.splice(id, 1);
    		Vue.delete(this.products.items, product.index);
          	axios.get('/remove/'+product.id);

        },

    },

  
}

</script>