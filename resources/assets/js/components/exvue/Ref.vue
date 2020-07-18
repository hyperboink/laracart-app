
<template>


	<div>
		<input type="text" :value="hehe" @input="rawr($event.target.value)" ref="input">
	</div>


</template>


<script>
	


export default{
	

	mounted(){
		console.log('woo');
	},


	props:['hehe'],

	methods:{
		rawr(hehe){
			alert(this.$refs.input.value);
		}
	}


}



</script>
