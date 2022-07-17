<template>
  <header class="fixed-top scrollTop container-fluid">
    <div class="row">
      <nav
        class="navbar navbar-expand align-items-center"
        :class="{ onScroll: !view.topOfPage }"
      >
        <!-- Home -->

        <router-link
          class="navbar-brand m-1 col-lg-2 col-md-2 col-sm-2 col-xs-2"
          :to="{ name: 'home' }"
        >
          <img class="w-50 logo" src="/images/logo_header.png" alt="" />
        </router-link>

        <!-- Button menu mobile -->
        <!-- <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button> -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
        <div
          v-if="$route.path == '/dashboard'"
          class="justify-content-center col-lg-2 col-md-2 col-sm-2 col-xs-2"
          id="navbarNav"
        >
          <ul class="">
            <li class="nav-item">
              <router-link
                class="nav-link btn m-1 font-size-1 btn-annunci text-dark btn2"
                :to="{ name: 'advancedSearch' }"
                >Ricerca Avanzata
              </router-link>
            </li>
          </ul>
        </div>
        <div
          v-else
          class="justify-content-center col-lg-2 col-md-2 col-sm-2 col-xs-2"
          id="navbarNav"
        >
          <ul class="">
            <li
              class="nav-item"
              :class="$route.path == '/dashboard' ? 'd-none' : ''"
            >
              <router-link
                class="nav-link btn m-1 font-size-1 btn-annunci"
                :class="
                  $route.path == '/' ? 'text-white btn1' : 'text-dark btn2'
                "
                :to="{ name: 'dashboard' }"
                >Esplora
              </router-link>
            </li>
          </ul>
        </div>

        <!-- <div class="collapse navbar-collapse justify-content-end col-5" id="navbarNav">
          <ul class="navbar-nav">



            <li class="nav-item">
              <a class="nav-link m-1 btn font-size-1"
                :class="($route.path == '/') ? 'text-white btn1' : 'text-dark btn2'" href="/login">Passa alla modalità
                host</a>
            </li>

            <li class="nav-item">
              <a class="nav-link m-1 btn font-size-1"
                :class="($route.path == '/') ? 'text-white btn1' : 'text-dark btn2'" href="/register">Registrati</a>
            </li>

          </ul>
        </div> -->

        <div
          class="
            dropdown
            d-flex
            justify-content-end
            col-lg-5 col-md-5 col-sm-5 col-xs-5
          "
        >
          <button
            class="btn position-relative"
            type="button"
            id="dropdownMenuButton"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <img
              v-if="$route.path == '/'"
              src="../../../public/img/icons/user.png"
              alt=""
            />

            <img v-else src="../../../public/img/icons/user-black.png" alt="" />
          </button>
          <div
            class="dropdown-menu my-drop-menu position-absolute"
            aria-labelledby="dropdownMenuButton"
          >
            <a
              class="dropdown-item nav-link m-1 btn font-size-1"
              :class="$route.path == '/' ? 'text-white btn1' : 'text-dark btn2'"
              href="/login"
              >Accedi</a
            >
            <a
              class="dropdown-item nav-link m-1 btn font-size-1"
              :class="$route.path == '/' ? 'text-white btn1' : 'text-dark btn2'"
              href="/register"
              >Registrati</a
            >
          </div>
        </div>
      </nav>
    </div>
  </header>
</template>

<script>
export default {
  name: "Header",

  el: "#navbar",
  data() {
    return {
      view: {
        topOfPage: true,
      },
    };
  },
  beforeMount() {
    window.addEventListener("scroll", this.handleScroll);
  },
  methods: {
    handleScroll() {
      if (window.pageYOffset > 0) {
        if (this.view.topOfPage) this.view.topOfPage = false;
      } else {
        if (!this.view.topOfPage) this.view.topOfPage = true;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.font-size-1 {
  font-size: 1.2rem;
}

.text_gray {
  color: rgb(190, 182, 182);
}

nav {
  position: fixed;
  width: 100%;
  height: 15vh;
  background-color: transparent;
  display: flex;
  align-items: center;
  transition: all 0.2s ease-in-out;

  &.onScroll {
    box-shadow: 0 0 10px #aaa;
    background: linear-gradient(
      0deg,
      rgb(157, 207, 187) 0%,
      rgb(93, 202, 155) 35%,
      rgb(73, 200, 145) 50%,
      rgb(73, 207, 133) 100%
    );
  }

  .btn1:hover {
    background-color: rgba(35, 200, 218, 0.563);
    // border: 1px solid white;
  }

  .btn2:hover {
    background-color: rgba(96, 214, 227, 0.398);
    // border: 1px solid rgb(0, 0, 0);
  }

  .btn-annunci {
    font-weight: bold;
    border-radius: 20px;
  }

  @media screen and (min-width: 0px) and (max-width: 1200px) {
    .logo {
      width: 80px !important;
      margin-right: 20%;
    }
  }

  .my-drop-menu {
    // transform: translate3d(270%, -10%, 0) !important;
    background-color: rgba(35, 200, 218, 0.563) !important;
    border: none !important;
    box-shadow: 10px 10px 5px #0000003d;
  }

  @media screen and (min-width:  1001px) {
    .position-absolute {
      right: 0%;
      left: 70%;
    }
  }

  @media screen and (min-width:  821px) and (max-width: 1000px) {
    .position-absolute {
      right: 10%;
      left: 50%;
    }
  }
  @media screen and (min-width:  664px) and (max-width: 820px) {
    .position-absolute {
      right: 10%;
      left: 40%;
    }
  }

  @media screen and (min-width:  500px) and (max-width: 663px) {
    .position-absolute {
      right: 50%;
      left: 20%;
    }
  }

  @media screen and (min-width:  200px) and (max-width: 499px) {
    .position-absolute {
      right: 50%;
      left: -20%;
    }
  }
}
</style>
