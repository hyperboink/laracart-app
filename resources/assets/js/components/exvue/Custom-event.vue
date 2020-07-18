<template>


    <div>
        Custom Event here
        <custom-child-event v-on:woo="wee"></custom-child-event>
        <slot></slot>
    </div>

    
</template>

<script>
    export default {
        mounted() {
            console.log('custom event');
        },

        data(){
            return{
                isClicked: false
            }
        },

        created(){
           
        },

        methods:{
            wee(){
                Event.$emit('woo');
            },

        }
     

    }
</script>
