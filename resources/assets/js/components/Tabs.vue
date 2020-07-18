<template>


    <div>
        
        <ul class="tabsMenu">
            <li v-for="tab in tabs" >
                <a :href="tab.href" v-text="tab.name" @click="selectTab(tab)" :class="{'is-active':tab.isActive}"></a>
            </li>
        </ul>


        <div class="tab-content">
            <slot></slot>
        </div>


    </div>

    
</template>

<script>
    export default {
        mounted() {
            console.log(this.$children);
        },

        data(){
            return {
                tabs: []
            }
        },

        created(){
            this.tabs = this.$children;
        },

        methods: {
            selectTab(selectedTab){
                this.tabs.forEach(tab => {
                    tab.isActive = (tab.name==selectedTab.name);
                });
            }
        }
     



    }
</script>
