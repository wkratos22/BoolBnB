<template>

    <div :class="($route.name === 'home') ? 'bg_img_casual' : '' ">

        <header>

          <Header @locationData="getLocationData"/>

        </header>


        <main>
          <router-view :locationData="this.positionInput"></router-view>
        </main>

        <Footer />

    </div>

</template>

<script>
import Header from "./Header.vue";
import Footer from "./Footer.vue";


export default {
  name: "App",

  components: {
    Header,
    Footer,
  },

  data(){
    return {
      positionInput: {},
    }
  },

  methods: {
    getLocationData(locationData){
      this.positionInput = locationData;
    }
  }
}


</script>

<style lang="scss">

    .bg_img_casual {
        background-image: url('/images/bg-home.jpg');
        background-position: center;
        background-size: cover;
    }

    .bg_white{
        background-color: blue;
    }

</style>
