<template>

    <div :class="($route.name === 'home') ? 'bg_img_casual' : '' ">

      <Header/>

      <main>
        <router-view></router-view>
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

</style>
