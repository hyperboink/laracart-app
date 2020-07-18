<template>
    <div class="container">
        <div class="row">
            woo this is a component. hahaha---- {{rawr}}
        </div> 
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return {
                 rawr: 'asfd'
            }
           
        }
    }
</script>
