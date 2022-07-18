<template>
  <header class="scrollTop container-fluid">
    <div class="row">
        <nav
            class="navbar navbar-expand align-items-center"
            :class="{ onScroll: !view.topOfPage }">
            <!-- Home -->

            <router-link
                class="navbar-brand m-1 col-lg-2 col-md-2 col-sm-2 col-xs-2"
                :to="{ name: 'home' }">
                <img class="w-img logo" src="/images/BoolBnb (2).png" alt="" />
            </router-link>

            <!-- Button menu mobile -->
            <!-- <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button> -->
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
                <div
                    v-if="$route.path == '/dashboard'"
                    class="justify-content-center display-none-search-header col-lg-2 col-md-2 col-sm-2 col-xs-2"
                    id="navbarNav">
                    <ul class="">
                        <li class="nav-item justify-content-center d-flex">
                        <router-link
                            class="nav-link shadow-none btn m-1 font-size-1 btn-annunci text-dark myButton2"
                            :to="{ name: 'advancedSearch' }"
                            >Cerca
                        </router-link>
                        </li>
                    </ul>
                </div>
                <div
                    v-else
                    class="justify-content-center col-lg-2 col-md-2 col-sm-2 col-xs-2"
                    id="navbarNav">
                    <ul>
                        <li
                        class="nav-item justify-content-center d-flex"
                        :class="$route.path == '/dashboard' ? 'd-none' : '' " >
                        <router-link
                            class="nav-link btn shadow-none m-1 font-size-1 btn-annunci"
                            :class="
                            $route.path == '/' ? 'myButton1' : 'myButton2'
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

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>

                <div class="dropdown
                            d-flex
                            justify-content-center
                            col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <button
                        class="btn shadow-none"
                        type="button"
                        id="dropdownMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        <img
                        v-if="$route.path == '/'"
                        src="../../../public/img/icons/user.png"
                        alt=""/>

                        <img v-else src="../../../public/img/icons/user-black.png" alt="" />
                    </button>
                    <div
                        class="dropdown-menu my-drop-menu "
                        aria-labelledby="dropdownMenuButton">
                        <a
                            class="dropdown-item nav-link m-1 btn font-size-1"
                            :class="$route.path == '/' ? 'text-white btn1' : 'text-dark btn2'"
                            href="admin/habitations">
                            Dashboard
                        </a>
                        <a
                            class="dropdown-item nav-link m-1 btn font-size-1"
                            :class="$route.path == '/' ? 'text-white btn1' : 'text-dark btn2'"
                            href="/login">
                            Accedi
                        </a>
                        <a
                            class="dropdown-item nav-link m-1 btn font-size-1"
                            :class="$route.path == '/' ? 'text-white btn1' : 'text-dark btn2'"
                            href="/register">
                            Registrati
                        </a>
                    </div>

            </div>
        </nav>
    </div>
    </header>
</template>

<script>
export default {
  name: "Header",

  // el: "#navbar",
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
.w-img{
  width: 80%;
}

.navbar-expand {
    flex-flow: row nowrap;
    justify-content: space-between!important;
}

nav {
  position: fixed;
  width: 100%;
  height: 15vh;
  background-color: transparent;
  display: flex;
  align-items: center;
  justify-content: space-between!important;
  transition: all 0.2s ease-in-out;
  z-index: 1000;

  &.onScroll {
    box-shadow: 0 0 10px #aaa;
    background: linear-gradient(
      0deg, rgba(65,154,136,1) 0%, rgba(20,102,83,1) 100%
    );
  }

@media screen and (max-width: 2766px) {
    .logo {
        width: 80px !important;
    }
}

@media screen and (max-width: 1920px) {
    .logo {
        width: 80px !important;
    }

    .w-img{
    width: 90%;
    }
}

@media screen and (max-width: 1440px) {
    .logo {
        width: 80px !important;
    }

    .w-img{
        width: 100%;
    }
}

@media screen and (max-width: 1248px) {
    .logo {
        width: 80px !important;
    }

    .w-img{
        width: 100%;
    }
}

@media screen and (max-width: 1128px) {
    .logo {
        width: 80px !important;
    }

    .w-img{
        width: 100%;
    }
}

@media screen and (max-width: 1024px) {
    .logo {
        width: 80px !important;
    }

    .w-img{
        width: 100%;
    }
}

@media screen and (max-width: 950px) {
    .logo {
        width: 80px !important;
    }

    .w-img{
        width: 100%;
    }
}


@media screen and (max-width: 768px) {
    .display-none-search-header{
            display: none!important;
    }

    .logo {
        width: 90px !important;
    }

    .w-img{
        width: 100%;
    }
}

@media screen and (max-width: 744px) {
    .display-none-search-header{
            display: none!important;
    }

    .logo {
        width: 100px !important;
    }

    .w-img{
        width: 100%;
    }
}

@media screen and (max-width: 640px) {
    .display-none-search-header{
            display: none!important;
    }

    .logo {
        width: 100px !important;
    }

    .w-img{
        width: 100%;
    }
}


@media screen and (max-width: 560px) {
    .display-none-search-header{
            display: none!important;
    }

    .logo {
        width: 95px !important;
    }


}


@media screen and (max-width: 480px) {
    .display-none-search-header{
            display: none!important;
        }

        .logo {
        width: 90px !important;
    }

}

@media screen and (max-width: 400px) {
        .display-none-search-header{
            display: none!important;
        }

        .logo {
        width: 90px !important;
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

  .myButton1 {
	box-shadow: 3px 5px 8px 0px rgba(26, 155, 170, 0.563);
	background-color:rgba(35, 200, 218, 0.563);
	border-radius:27px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:20px;
	font-weight:bold;
	padding:10px 30px;
	text-decoration:none;
	text-shadow:2px 1px 3px #000000;

}
.myButton1:hover {
	background-color:rgba(26, 155, 170, 0.563);
}
.myButton1:active {
	position:relative;
	top:1px;
}

  .myButton2 {
	// box-shadow: 3px 5px 8px 0px rgba(26, 155, 170, 0.563);
	// background-color:rgba(35, 200, 218, 0.563);
	border-radius:27px;
	display:inline-block;
	cursor:pointer;
	color:#000000;
	font-family:Arial;
	font-size:20px;
	font-weight:bold;
	padding:10px 30px;
	text-decoration:none;

}
.myButton2:hover {
	background-color:rgba(26, 155, 170, 0.563);
}
.myButton2:active {
	position:relative;
	top:1px;
}


}
</style>
