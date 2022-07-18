
<template>
  <div class="containers">
    <div class="box d-flex align-items-center justify-content-around">
        <div class="left d-flex flex-column">
            <img class="w-50 ml-5" src="/img/banner-img/lufthansa.png" alt="">
            <h3 class="">Say yes to the world</h3>
        </div>
        <div class="right">
            <h3 class="mb-4">Non avete motivo per andare a Milano? Peccato</h3>
            <h5>Lufthansa Italia per volare a Malpensa a partire da 99€ tutto incluso. Tutto l'anno.</h5>
        </div>
    </div>

  </div>
</template>

<script>
export default {
    name: 'Banner',
}
</script>

<style lang="scss" scoped>

.containers{
    width: 100%;

}
.box{
    height: 300px;
    background: rgb(3,135,237);
    background: linear-gradient(0deg, rgba(3,135,237,1) 0%, rgba(27,71,102,1) 100%);
    /* background-image: url(../../../../public/img/banner-img/aereo.jpeg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: left; */

}

.left{
    width: 50%;
}
.left h3{
    margin-left: 5em;
    color: rgb(182, 182, 26);
}

.right{
    width: 40%;
}
.right h3{
    color: rgb(182, 182, 26)
}
.right h5{
    color: black
}

@media screen and (max-width: 640px) {
    .box{
    height: 300px;
    background: rgb(3,135,237);
    background: linear-gradient(0deg, rgba(3,135,237,1) 0%, rgba(27,71,102,1) 100%);
    display: none!important;
    }
}


@media screen and (max-width: 560px) {
    .box{
    height: 300px;
    background: rgb(3,135,237);
    background: linear-gradient(0deg, rgba(3,135,237,1) 0%, rgba(27,71,102,1) 100%);
    display: none!important;
    }
}


@media screen and (max-width: 480px) {
    .box{
    height: 300px;
    background: rgb(3,135,237);
    background: linear-gradient(0deg, rgba(3,135,237,1) 0%, rgba(27,71,102,1) 100%);
    display: none!important;
    }
}

@media screen and (max-width: 400px) {
    .box{
    height: 300px;
    background: rgb(3,135,237);
    background: linear-gradient(0deg, rgba(3,135,237,1) 0%, rgba(27,71,102,1) 100%);
    display: none!important;
    }
}



</style>
