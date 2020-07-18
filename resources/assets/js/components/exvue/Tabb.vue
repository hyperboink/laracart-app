<template>


    <div v-show="isActive">
        <slot></slot>
    </div>

    
</template>

<script>
    export default {
       

        props: {
            title: { required: true },
            selected: false
        },

        data(){ 	
        	return{
        		isActive:false
        	}
        },

        mounted(){
        	this.isActive = this.selected;
        },
        computed: {
            href(){
                return '#'+this.title.toLowerCase().replace(/ /g,'-');
            }
        },


        


    }
</script>
