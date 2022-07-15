<template>
<header class="fixed-top scrollTop">

  <nav class="navbar navbar-expand-lg align-items-lg-center navbar-dark" :class="($route.path != '/' ? 'bg-secondary' : '')">

    <!-- Home -->
    <router-link class="navbar-brand m-1" :to="{ name: 'home' }">
      <img class="w-50" src="/images/logo_header.png" alt="">
    </router-link>

    <!-- Button menu mobile -->
    <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

export default {
  name: "Header",

    methods: {

  }
};

</script>

<style lang="scss" scoped>

    nav {
      height: 15vh;
    }

    .font-size-1{
        font-size: 1.2rem;
    }

    .text_gray{
        color: rgb(190, 182, 182);
    }


</style>
