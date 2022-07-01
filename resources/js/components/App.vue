<template>
  <main>
    <Header />
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <HomePage />
        </div>
      </div>
    </div>

    <Footer />
  </main>
</template>

<script>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
import HomePage from "./pages/HomePage.vue";

export default {
  name: "App",
  components: {
    Header,
    Footer,
    HomePage,
  },
};
</script>