<template>

    <div>

        <header>

          <Header />

        </header>

        <!-- <AdvancedSearch  /> -->

        <main class="container">

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


};
</script>
