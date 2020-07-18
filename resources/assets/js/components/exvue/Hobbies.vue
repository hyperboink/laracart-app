<template>


    <div>
        <ul>
            <li v-for="hobby in hobbies">
          
                <ul>
                    <li v-for="items in hobby.items">
                       Items: {{items}}

                        <ul>
                            <li v-for="item in items">
                                Single Item: {{item}}
                                <input type="" name="" value="{{item}}">
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
           
        </ul>
        
    </div>

    
</template>

<script>
    export default {
        mounted() {
            console.log('custom event');
        },

        data(){
            return{
               hobbies: [] 
            }
            
        },

        created(){
            var self = this;
            axios.get('/api/cart').then(function(response){
                //Vue.set(self.hobbies, response);
                self.hobbies = response
                console.log(self.hobbies);
            });
        }

    }
</script>
