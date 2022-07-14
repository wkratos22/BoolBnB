<template>
<header>

  <nav class="navbar navbar-expand-lg" :class="($route.path != '/' ? 'bg-secondary' : '')">

    <!-- Home -->
    <router-link class="navbar-brand m-1" :to="{ name: 'home' }">
      <img class="w-50" src="/images/logo_header.png" alt="">
    </router-link>

    <!-- Button menu mobile -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">

        <li class="nav-item">
            <router-link class="nav-link m-1 font-size-1 text-white" :to="{ name: 'dashboard' }">Annunci</router-link>
        </li>

        <li class="nav-item">
          <a class="nav-link m-1 font-size-1 text-white" href="/login">Passa alla modalità host</a>
        </li>

        <li class="nav-item">
          <a class="nav-link m-1 font-size-1 text-white" href="/register">Registrati</a>
        </li>

      </ul>
    </div>
  </nav>

</header>
</template>

<script>
import axios from 'axios';

export default {
  name: "Header",

  data(){
    return{
        users: [],
        name: [],
        surname: [],
        email: [],
        token: [],
        xxsrftoken: [],
    }
  },

  methods: {

    getToken(){
        axios.get('/sanctum/csrf-cookie').then(response => {

            console.log('TOTALSANCTUM', response)
            console.log('SANCTUM', response.config.headers)

        });
    },

    getUser(){
        axios.get('http://127.0.0.1:8000/api/users')
        .then(res => {
            console.log('USER', res.data)
            this.users = res.data

            this.users.forEach(element => {

            this.name = element.name;
            this.surname = element.surname;
            this.email = element.email;

            console.log('NAME', this.name);
            console.log('SURNAME', this.surname);
            console.log('EMAIL', this.email);
            });
        })
    },

    getTokenUser(){
                axios.get('http://127.0.0.1:8000/api/token')
                .then(res => {
                        this.token = res.data.token;
                        console.log('UT', this.token);
                    });


        },
    },



    mounted(){
        this.getToken();

        this.getUser();

        this.getTokenUser()
    }

}



</script>

<style scoped>

    .font-size-1{
        font-size: 1.2rem;
    }

    .text_gray{
        color: rgb(190, 182, 182);
    }


</style>
