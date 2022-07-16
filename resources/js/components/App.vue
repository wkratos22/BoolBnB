<template>

    <div :class="($route.name === 'home') ? 'bg_img_casual' : '' ">

      <Header/>

      <main>
        <router-view></router-view>

          <div v-if="$route.name === 'home'" class="p-4 bg-light">
            <HabitationsSponsored/>
          </div>
      </main>

      <Footer />

    </div>

</template>

<script>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
import HabitationsSponsored from './habitations/HabitationsSponsored.vue'


export default {
  name: "App",

  components: {
    Header,
    Footer,
    HabitationsSponsored,
  },

}


</script>

<style lang="scss">

    .bg_img_casual {
      background-image: url('/images/bg-home.jpeg');
      background-position: center;
      background-size: cover;
    }

    .bg_white{
      background-color: blue;
    }

    main {
      padding-top: 15vh;
    }

</style>
