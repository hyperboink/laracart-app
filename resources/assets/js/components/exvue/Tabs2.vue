<template>


    <div>
        <ul class="tabsMenu">
            <li v-for="tab in tabs" >
                <a :href="tab.href" :class="{'is-active':tab.isActive}" @click="selectTab(tab)">{{tab.title}}</a>
            </li>
        </ul>

        <div class="tab-content">
            <slot></slot>
        </div>
    </div>
    

    
</template>

<script>
    export default {


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
                    tab.isActive = (tab.title==selectedTab.title);
                });
            }
        }

     



    }
</script>

