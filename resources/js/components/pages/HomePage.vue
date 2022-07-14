<template>
    <div>
        

        

        <div class="height_100vh flex_between">

            <div class="align-self-center">

                <h1 class="text_gray font_size_3 margin-top">Scegli una meta.. Goditi il viaggio!</h1>

                </div>
                   
                    <HomeSearch @locationData="getLocationData"/>

                <div>

            </div>

        </div>
    </div>

</template>

<script>
import HomeSearch from "../includes/HomeSearch.vue";

export default {
    name: 'HomePage',
     components: {
        HomeSearch
    },

    data(){
        return {
            positionInput: {}
        }
    },

    methods: {
        getLocationData(locationData){
          this.positionInput = locationData;

          this.$emit('locationData', this.positionInput)
        }
    }

}
</script>

<style lang="scss" scoped>

@media screen and (min-width: 821px){


    .height_100vh {
        height: 100vh
    }

    .flex_between {
        display: flex;
        flex-direction: column;
        justify-content: space-around;
    }

    .font_size_3 {
        font-size: 3rem;
    }

    .text_gray {
        color: rgb(190, 182, 182);
    }
    }

        @media screen and (min-width: 601px) {
    
    
            .height_100vh {
                height: 85vh
            }
    
            .flex_between {
                display: flex;
                flex-direction: column;
                
            }
    
            .font_size_3 {
                font-size: 2.5rem;
            }
    
            .text_gray {
                color: rgb(190, 182, 182);
            }

            .margin-top{
                margin-top: 200px;
                margin-bottom:150px;
            }

            
        }

     @media screen and (min-width: 200px) and (max-width: 600px) {
                    .height_100vh {
                            height: 80vh
                        }
                    
                        .flex_between {
                            display: flex;
                            flex-direction: column;
                            justify-content: space-around;
                    
                        }
                    
                        .font_size_3 {
                            font-size: 1.5rem;
                        }
                    
                        .text_gray {
                            color: rgb(190, 182, 182);
                        }
                    
                       
                }
</style>
