<template>

    <div :class="($route.name === 'home') ? 'bg_img_casual' : '' ">
    <!-- v-if="HomePage ? 'bg_black' : '' "  -->

        <header>

          <Header/>

        </header>

        <!-- <AdvancedSearch  /> -->

        <div class="container">

          <router-view></router-view>

        </div>

        <!-- <Footer /> -->

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

  methods: {

  },

  computed: {
    HomePage() {
        return this.$route.name === 'home'
    },

}


};
</script>

<style lang="scss">

    .bg_img_casual {
        background-image: url('../../../public/images/pexels-rachel-claire-5531437.jpg');
        background-position: center;
        background-size: cover;
    }

    .bg_white{
        background-color: blue;
    }

</style>
