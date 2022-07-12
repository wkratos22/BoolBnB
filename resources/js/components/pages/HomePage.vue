<template>
    <div>

        <h1 class="my-5 py-5 text-center">Sito in costruzione</h1>

        <div class="height_100vh flex_between">

            <div class="align-self-center">

                <h1 class="text_gray font_size_3">Scegli una meta.. Goditi il viaggio!</h1>

                </div>
                    <!-- <h1 class="my-5 py-5 text-center">Sito in costruzione</h1> -->
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
</style>
