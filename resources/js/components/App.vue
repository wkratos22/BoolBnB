<template>

    <div>

        <header>

          <Header @search-data="searchDataFunction" />

        </header>

        <!-- <AdvancedSearch  /> -->

        <main class="container">

          <router-view :position="positionInput"></router-view>

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
        positionInput: {latitudine: "", longitudine: ""},
    }
  },

   methods: {
    searchDataFunction(positionInput) {
      this.positionInput.latitudine = positionInput.latitudine;
      this.positionInput.longitudine = positionInput.longitudine;

      console.log('RESPONSE-App', this.positionInput);
    }
  },

//   mounted() {
//     this.searchDataFunction()
//   }

};
</script>
