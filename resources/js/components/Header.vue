<template>
  <nav>
    <ul class="nav d-flex justify-content-between m-1">
      <li class="nav-item">
        <router-link class="navbar-brand" :to="{ name: 'home' }"
          >Home</router-link
        >
      </li>

      <SearchHab @search="searchFunction"/>

      <li class="nav-item d-flex">
        <!--Button per diventare un'host(aggiungi abitazioni)-->
        <!-- <a class="nav-link m-1" href="/admin.habitations.create">Diventa un host</a> -->

        <!--Button per entrare nel back-end per l'utente loggato-->
        <router-link class="nav-link m-1" :to="{ name: 'advancedSearch' }">Annunci</router-link >
        <a class="nav-link m-1" href="/admin">Passa alla modalità host</a>

        <a class="nav-link m-1" href="/register">Registrati</a>
        <a class="nav-link m-1" href="/login">Accedi</a>

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

  data() {
    return {
        positionInput: {latitudine: "", longitudine: ""},
    }
  },

  methods: {
    searchFunction(positionInput) {
      this.positionInput.latitudine = positionInput.latitudine;
      this.positionInput.longitudine = positionInput.longitudine;

      console.log('RESPONSE-Header', this.positionInput);

      this.$emit('search-data', this.positionInput)
    }
  },

};
</script>
