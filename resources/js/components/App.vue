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

// import axios from 'axios';

export default {
  name: "App",
  components: {
    Header,
    Footer,
    HomePage,
  },


//   data() {
//         return {
//             habitations: [],
//             isLoading: true,
//         }
//     }, 

//     methods: {
//         getHabitation() {
//             axios.get("http://127.0.0.1:8000/api/habitations")
//                 .then((res)=>{
//                     console.log(res.data)
//                 })
//         }
//     }
};
</script>
