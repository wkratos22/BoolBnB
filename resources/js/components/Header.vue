<template>
  <nav class="container-90">
    <ul class="nav d-flex justify-content-between align-items-center">
      <li class="nav-item my_2">
        <router-link class="navbar-brand m-1" :to="{ name: 'home' }">
          <img class="w-50" :src="require('../../../public/images/BoolBnb_logo-removebg-preview.png')" alt="">
        </router-link
        >
      </li>

      <SearchHab v-if="$route.name != 'home'" />

      <li class="nav-item d-flex  my_2">
        <!--Button per diventare un'host(aggiungi abitazioni)-->
        <!-- <a class="nav-link m-1" href="/admin.habitations.create">Diventa un host</a> -->

        <!--Button per entrare nel back-end per l'utente loggato-->
        <!-- <router-link class="nav-link m-1" :to="{ name: 'advancedSearch' }">Annunci</router-link > -->
        <!-- <a class="nav-link m-1" href="/admin">Passa alla modalità host</a> -->

        <a class="nav-link m-1 font-size-1 text_gray" href="/register">Registrati</a>
        <a class="nav-link m-1 font-size-1 text_gray" href="/login">Passa alla modalità host</a>

      </li>
    </ul>
  </nav>
</template>

<script>

import SearchHab from './includes/SearchHab.vue'

export default {
  name: "Header",

  components: {
    SearchHab,
  },


};
</script>

<style scoped>

    .container-90 {
        width: 90%;
        margin: 0 auto;
    }

    .font-size-1{
        font-size: 1.2rem;
    }

    .my_2{
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .text_gray{
        color: rgb(190, 182, 182);
    }


</style>
