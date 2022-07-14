<template>
   <div class="container-fluid bg-color">
     <div class="d-flex row justify-content-md-around p-4 pt-2 p-sm-3 p-lg-5">
        <div class=" ">
             <div>
                <div class="d-flex justify-content-end d-md-none">
                    <button @click="scrollToTop" type="button" class="btn btn-outline-dark"><strong>&#8892;</strong></button>
                </div>
            </div>
             <ul class="">
                <li class="font-weight">
                    Assistenza
                </li>
                <li>
                    Centro Assistenza 
                </li>
                <li>
                    AirCover
                </li>
                <li>
                    Informazioni di sicurezza 
                </li>
                <li>
                    Accessibilit&agrave; per tutti
                </li>
                <li>
                    Opzioni di cancellazione
                </li>
                <li>
                    La nostra risposta all'emergenza COVID-19
                </li>
                <li>
                    Segnala problemi ne quartiere
                </li>
            </ul>
        </div>
        <div>
             <ul>
                <li class="font-weight">
                    Ospitare
                </li>
                <li>
                    Prova a ospitare
                </li>
                <li>
                    AirCover per gli host
                </li>
                <li>
                    Esplora le risorse per host 
                </li>
                <li>
                    Vai al forum della community
                </li>
                <li>
                    Come ospitare responsabilmente 
                </li>
            </ul>
        </div>
        <div>
             <ul>
                <li class="font-weight">
                    BoolB&B
                </li>
                <li>
                    Newsroom
                </li>
                <li>
                    Scopri le nuova funzionalit&agrave;
                </li>
                <li>
                    Lettera dai nostri fondatori  
                </li>
                <li>
                    Opportunit&agrave; di lavoro 
                </li>
                <li>
                    Investori  
                </li>
                <li>
                    Gift card  
                </li>
            </ul>
        </div>
        <div>
            <div class=" text-center pt-2 pt-md-4">
                <h3 class="pb-3">Trovaci sui nostri social!</h3>
                <img class="icon mx-md-4 ml-2" src="/img/icon-social/facebook.png" alt="facebook icon link">
                <img class="icon mx-md-4 ml-2" src="/img/icon-social/instagram.png" alt="instagram icon link">
                <img class="icon mx-md-4 ml-2" src="/img/icon-social/twitter.png" alt="twitter icon link">
                <img class="icon mx-md-4 ml-2" src="/img/icon-social/youtube.png" alt="youtube icon link">
                <img class="icon mx-md-4 ml-2" src="/img/icon-social/whatsapp.png" alt="whatsup icon link">
            </div>
        </div>
    <div>
        <div class="d-md-flex justify-content-end d-none">
            <button @click="scrollToTop" type="button" class="btn btn-outline-dark"><strong>&#8892;</strong></button>
        </div>
    </div>
        <div class="container-fluid d-flex justify-content-center pt-5">
            <div>
                <p class="text-center">&copy;Copyright 2022-2022 | Theme by Boolean | All Rights Reserved | Powered by Booleans</p>
            </div>
        </div>

<!-- wave
        <div class="wave">
            <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
 -->
        
    </div>
    
     

   </div>

</template>



<script>
export default {
    name: "Footer",
    methods :{
            scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
                });
            }
    },
}


</script>

<style>
    li{
        list-style: none;
        padding: 2px;
        font-size: 0.9em;
    }

    li:hover{
        text-decoration: underline;
        cursor: pointer;
    }

    .font-weight{
        font-weight: bolder;
        font-size: 1.2em;
    }

    .inline{
        display: inline-flex;
        justify-content: space-around;

    }

    .bg-color{
        background-color: #488d7f ;
    }

    .icon{
        width: 30px;
    }

    .icon:hover{
        cursor: pointer;
        transition: 0.3s;
        opacity: 0.6;

    }

    .btn-outline-dark{
        border-radius: 50%;
        border: 2px solid;
        width: 50px;
        height: 50px;
    }

    

    
</style>
