<template>
    <div v-show="isActive">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.isActive = this.selected;
        
        },

        props: {
            name: { required:true },
            selected: false
        },

        data(){
            return{
                isActive:false
            }
        },

        computed: {
            href(){
                return '#'+this.name.toLowerCase().replace(/ /g, '-');
            }
        }

    }
</script>
