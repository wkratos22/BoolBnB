<template>
     <div class="containers d-flex align-items-center">
         <div class="box rounded-lg">
             <div class="box-2 d-flex flex-column align-items-center text-center">
                <h1 class="h1-404">404</h1>
                <h2 class="h2-404">OPS! PAGINA NON TROVATA</h2>
                <p class="p-404 pt-4">Spiacenti, la pagina che stai cercando non esiste.<br>Ritorna alla home.</p> 
                <a class="btn color_button_404 mt-5 p-3 rounded-pill" @click="$router.go(-1)">Torna alla Home</a>
             </div>
            
         </div>
        
        
        
        
    </div>

</template>

<script>
export default {
    name: 'NotFoundPage'
}
</script>

<style lang="scss" scoped>
.containers{
    height: 100vh;
    background: rgb(93,232,205);
    background: linear-gradient(45deg, rgba(93,232,205,0.4) 0%, rgba(27,200,166,0.9) 50%, rgba(21,157,130) 100%);
}
.box{
    width: 70%;
    height: 70%;
    margin: auto;
    background-color: white;
}
.h1-404{
    font-size: 8em;
    font-weight: bolder;
    background: -webkit-linear-gradient(200deg, rgba(93,232,205,0.8) 0%, rgba(27,200,166) 50%, rgba(21,157,130) 100%);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.h2-404{
    font-size: 3em;
    font-weight: bolder;
    color: #5e7772;
}
.p-404{
    font-size: 1.8em;
    font-weight:300;
}
.box-2{
    width: 70%;
    margin: 0 auto;
}
.color_button_404{
    border: 3px solid #409584;
    font-weight: bolder;
}
.color_button_404:hover{
   background-color: #409584;
}

@media screen and (max-width: 821px) {
    .h1-404{
        font-size: 5em;
    }
    .h2-404{
        font-size: 1.8em;
    }
    .p-404{
        font-size: 1.2em;
    }
 }
 @media screen and (max-width: 601px) {
    .h1-404{
        font-size: 4em;
    }
    .h2-404{
        font-size: 1.5em;
    }
    .p-404{
        font-size: 1em;
    }
    a{
        font-size: 0.8em;
        padding: 0.7rem !important;
    }
 }
 @media screen and (min-width: 200px) and (max-width: 600px) {
    .h1-404{
        font-size: 4em;
    }
    .h2-404{
        font-size: 1.5em;
    }
    .p-404{
        font-size: 1em;
    }
    a{
        font-size: 0.8em;
        padding: 0.7rem !important;
    }
 } 



</style>