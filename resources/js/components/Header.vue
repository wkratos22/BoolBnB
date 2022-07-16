<template>
  <header class="fixed-top scrollTop">

    <nav class="navbar navbar-expand-lg align-items-lg-center navbar-dark" :class=" { 'onScroll' :
      !view.topOfPage}">

      <!-- Home -->
      <router-link class="navbar-brand m-1" :to="{ name: 'home' }">
        <img class="w-50" src="/images/logo_header.png" alt="">
      </router-link>

      <!-- Button menu mobile -->
      <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">

          <li class="nav-item">
            <router-link class="nav-link btn  m-1 font-size-1" :class="($route.path == '/') ? 'text-white btn1' : 'text-dark btn2'"
              :to="{ name: 'dashboard' }">Annunci</router-link>
          </li>

          <li class="nav-item">
            <a class="nav-link m-1 btn font-size-1" :class="($route.path == '/') ? 'text-white btn1' : 'text-dark btn2'"
              href="/login">Passa alla modalità host</a>
          </li>

          <li class="nav-item">
            <a class="nav-link m-1 btn font-size-1" :class="($route.path == '/') ? 'text-white btn1' : 'text-dark btn2'"
              href="/register">Registrati</a>
          </li>

        </ul>
      </div>
    </nav>

  </header>
</template>

<script>

export default {
  name: "Header",

  el: '#navbar',
  data() {
    return {
      view: {
        topOfPage: true
      }
    }
  },
  beforeMount() {
    window.addEventListener('scroll', this.handleScroll)
  },
  methods: {
    handleScroll() {
      if (window.pageYOffset > 0) {
        if (this.view.topOfPage) this.view.topOfPage = false
      } else {
        if (!this.view.topOfPage) this.view.topOfPage = true
      }
    }
  }
};

</script>

<style lang="scss" scoped>

 

    .font-size-1{
        font-size: 1.2rem;
    }

    .text_gray{
        color: rgb(190, 182, 182);
    }


         nav {
           position: fixed;
           width: 100%;
          height: 15vh;
           background-color: transparent;
           display: flex;
           align-items: center;
           transition: all .2s ease-in-out;
    
           &.onScroll {
            
             box-shadow: 0 0 10px #aaa;
            background: linear-gradient(0deg, rgb(157, 207, 187) 0%, rgb(93, 202, 155) 35%, rgb(73, 200, 145) 50%, rgb(73, 207, 133) 100%);
           }

            .btn1, .btn2{
              border-radius: 20px;
            }
           .btn1:hover{
              background-color: rgba(96, 214, 227, 0.398);
              border: 1px solid white;
              border-radius: 20px;
             
              
           }

           .btn2:hover{
            background-color: rgba(96, 214, 227, 0.398);
              border: 1px solid rgb(0, 0, 0);
              border-radius: 20px;
           }
         }

</style>
