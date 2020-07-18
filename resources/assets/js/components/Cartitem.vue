<template>
	<div>
        <div class="tableData col-sm-8 col-md-6">
            <div class="media">
                <a class="thumbnail thumbnail-cartpage pull-left" href="#"> <img class="media-object" src="http://placehold.it/72x72" style="width: 72px; height: 72px;"> </a>
                <div class="media-body">
                    <h4 class="media-heading"><a href="#">{{product.item.title}}</a> ({{product.item.id}})</h4>
                    <h5 class="media-heading"> by <a href="#">Brand name</a></h5>
                    <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                </div>
            </div>
        </div>
        <div class="tableData col-sm-1 col-md-2 text-center">
            
            <div class="input-group">
                <span class="input-group-btn">
                   <a href="#" class="btn btn-default btn-number" min="0" step="1" @click.prevent="reduceProduct()">
                       <i class="glyphicon glyphicon-minus"></i>
                   </a>
               </span>
                <input  class="form-control qty-input" :name="'qty['+qtyId+']'" v-model="product.qty" v-on:keyup="checkNumber($event)"/>
                <span class="input-group-btn">
                   <a href="#" class="btn btn-default btn-number" @click.prevent="addProduct">
                       <i class="glyphicon glyphicon-plus"></i>
                   </a>
               </span>
            </div>

        </div>
        <div class="tableData col-sm-1 col-md-1 text-center"><strong>${{product.item.price}}</strong></div>
        <div class="tableData col-sm-1 col-md-1 text-center"><strong>${{product.qty * product.item.price}}</strong></div>
        <div class="tableData col-sm-1 col-md-2 text-right">
            <!-- <a :href="'/update-cart/'+prod.item.id+'/'+prod.qty">Save</a> -->
            <a :href="'/remove/'+prod.item.id" @click.prevent="$emit('remove', {index: index, id: prod.item.id})" class="btn btn-danger">
                <span class="glyphicon glyphicon-remove"></span>
                 Remove
            </a>

            </div>  
    </div>
</template>

 
 
<script>
    
export default{
    mounted(){
        console.log('cart page is readyx1.');
    },

    props:['prod','index'],


    data(){
        return{
            product:[],
            qtyId:this.prod.item.id,

        }
    },

    update(){
        alert('woo');
    },

    created(){
        this.product = this.prod;
        this.newTotalPrice = this.totalPrice;


    },

    computed:{

         
         
    },

    methods:{
        
        addProduct(){
            this.product.qty++;
            axios.get('/add/'+this.prod.item.id);

        },

        reduceProduct(){

            if(this.product.qty>1){
                this.product.qty--;
                axios.get('/reduce/'+this.prod.item.id);
            }
            
        },



        checkNumber(e){
            e = e ? e : window.event;
            var charCode = (e.which) ? e.which : e.keyCode;
              
                  
            console.log('woo');
     
            if(charCode > 31 && (charCode < 48 || charCode > 57)){
               
                e.preventDefault();
                
            }
       
            console.log(this.product.qty);
           

        },
        

       

    },

    directives:{
        numbersonly:{
            bind: function(el){
               alert('woo');
            }
        }
    }


}

</script>