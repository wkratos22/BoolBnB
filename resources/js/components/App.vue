<template>

    <div :class="($route.name === 'home') ? 'bg_black' : '' ">
    <!-- v-if="HomePage ? 'bg_black' : '' "  -->

        <header>

          <Header/>

        </header>

        <!-- <AdvancedSearch  /> -->

        <div class="container d-flex justify-content-center align-items-center " style="height: 100vh">

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

    .bg_black {
        background-color: lightseagreen;
    }

</style>
