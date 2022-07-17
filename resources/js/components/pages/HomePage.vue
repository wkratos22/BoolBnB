<template>

    <div class="containerHome">

        <div class="text-center">

            <h1 class="text_gray font_size_3">Scegli una meta.. Goditi il viaggio!</h1>

        </div>

        <HomeSearch @locationData="getLocationData" />
        


    </div>
</template>



<script>
import HomeSearch from "../includes/HomeSearch.vue";


export default {
    name: 'HomePage',
     components: {
        HomeSearch,
       
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

.containerHome {
    height: 87vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    h1 {
        margin-bottom: 6rem;
    }
}

 @media screen and (min-width: 821px) {
     .text_gray {
         color: #ffffff;
     }
 }
 @media screen and (min-width: 601px) {
     .font_size_3 {
         font-size: 2.5rem;
     }
     .text_gray {
         color: #ffffff;
     }
 }
 @media screen and (min-width: 200px) and (max-width: 600px) {
     .font_size_3 {
         font-size: 1.5rem;
     }
     .text_gray {
         color: #ffffff;
     }
 }
</style>