<template>
  <nav>
    <ul class="nav d-flex justify-content-between m-1">
      <li class="nav-item">
        <router-link class="navbar-brand" :to="{ name: 'home' }"
          >Home</router-link
        >
      </li>

      <SearchHab />
      
      <li class="nav-item d-flex">
        <!--Button per diventare un'host(aggiungi abitazioni)-->
        <!-- <a class="nav-link m-1" href="/admin.habitations.create">Diventa un host</a> -->

        <!--Button per entrare nel back-end per l'utente loggato-->
        <a class="nav-link m-1" href="/admin">Passa alla modalità host</a>

        <a class="nav-link m-1" href="/register">Registrati</a>
        <a class="nav-link m-1" href="/login">Accedi</a>

        <!-- Dropdown sul button in alto a destra utente non loggato -->
        <!-- <div>
                    <a class="nav-link m-1" href="/login">Diventa un host</a>
                    <a class="nav-link m-1" href="/create">Proponi un'esperienza</a>
                    <a class="nav-link m-1" href="/help-page">Assistenza</a>
                </div> -->

        <!-- Dropdown sul button in alto a destra utente loggato -->
        <!-- <div>
                    <a class="nav-link m-1" href="/messages">Messaggi</a>
                    <a class="nav-link m-1" href="/messages">Notifiche</a>
                    <a class="nav-link m-1" href="/habitations">Viaggi</a>
                    <a class="nav-link m-1" href="/prefers">Preferiti</a>
                    <a class="nav-link m-1" href="/annunci">Gestisci gli annunci</a>
                    <a class="nav-link m-1" href="/condividi">Proponi un'esperienza</a>
                    <a class="nav-link m-1" href="/login">Account</a>
                    <a class="nav-link m-1" href="/help-page">Assistenza</a>
                    <a class="nav-link m-1" href="/logout">Esci</a>
                </div> -->
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
  }

};
</script>
