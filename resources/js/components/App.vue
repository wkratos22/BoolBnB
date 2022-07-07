<template>

    <div>

        <header>

          <Header @search-data="searchDataFunction" />

        </header>

        <AdvancedSearch :latitude="lat" />

        <main class="container">

          <router-view></router-view>

        </main>

        <Footer />

    </div>

</template>

<script>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
import AdvancedSearch from "./pages/AdvancedSearch.vue";


export default {
  name: "App",
  components: {
    Header,
    Footer,
    AdvancedSearch
  },

  data() {
    return {
        lat: '',
        long: '',
    }
  },

   methods: {
    searchDataFunction() {
      this.lat = this.latitudine;
      this.long =this.longitudine;
      console.log('LATITUDINE', this.lat);
    }
  },

  mounted() {
    this.searchDataFunction()
  }

};
</script>
