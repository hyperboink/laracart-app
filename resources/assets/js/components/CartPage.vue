<template>
	<div class="tableDiv">

		<cart-items :products="allItems"></cart-items>
	</div>

</template>

 
<script>
	
export default{
	mounted(){

        console.log('weeeee ');
      
	},


	data(){
        return{
   			allItems:[]
        }
	},

	created(){

   		var self = this;
		axios.get('/api/cart').then(function(res){
			self.allItems = res.data;
		});
       
	},

    computed: {
        
    },

    methods:{

    }
}

</script>