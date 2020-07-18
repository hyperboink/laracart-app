<template>


    <div>
        <button @click="$emit('woo')">Click</button>
    </div>

    
</template>

<script>
    export default {
        mounted() {
            console.log('custom child event');
        },

        data(){
        	return{
        		text:'woo'
        	}
        },

        created(){
        	 Event.$on('woo', function(){
                alert('custom event parent here');
                alert(this.text);
            });
        }


     

    }
</script>
