<template>

    <div>

        <header>

          <Header @locationData="getLocationData"/>

        </header>

        <!-- <AdvancedSearch  /> -->

        <main class="container">

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
      positionInput: {

      },
    }
  },

  methods: {
    getLocationData(locationData){
      this.positionInput = locationData;
    }
  }

};
</script>
