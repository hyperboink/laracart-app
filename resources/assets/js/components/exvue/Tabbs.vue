<template>


    <div>
        
        <ul class="tabsMenu">
            <li v-for="tab in tabs">
                <a :href="tab.href" @click="selectTab(tab)" :class="{'is-active':tab.isActive}">{{tab.title}}</a>
            </li>
        </ul>

        <slot></slot>

    </div>

    
</template>

<script>
    export default {
        mounted() {
            console.log(this.$children);
        },

        data(){
            return{
                tabs: []
            }
        },

        created(){
            this.tabs = this.$children;
        },

        

        methods: {
            selectTab(selectedTab){
                this.tabs.forEach(function(tab){
                    tab.isActive = (tab.title == selectedTab.title);
                });
            }
        }


    }
</script>
