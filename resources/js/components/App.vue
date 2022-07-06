<template>

    <div>

        <Header />

        <main class="container">
            <div class="row justify-content-center">
                <div>
                    <HomePage />
                </div>
            </div>
        </main>

        <Footer />

    </div>

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
