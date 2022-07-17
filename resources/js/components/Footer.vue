<template>
    <div class="container-fluid bg-color position-relative py-1">
        <div class="row p-4">

            <ul class="col-12 col-md-3 m-bottom text-center mb-lg-1 d-flex flex-column align-items-center">
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
                    Emergenza COVID-19
                </li>
                <li>
                    Segnala problemi nel quartiere
                </li>
            </ul>

            <ul class="col-12 col-md-3 text-center m-bottom mb-lg-1 d-flex flex-column align-items-center">

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
                    Risorse per host
                </li>
                <li>
                    Forum della community
                </li>
                <li>
                    Ospitare responsabilmente
                </li>
            </ul>

            <ul class="col-12 col-md-3 text-center m-bottom mb-lg-1 d-flex flex-column align-items-center">

                <li class="font-weight">
                    BoolB&B
                </li>
                <li>
                    Nuove funzionalit&agrave;
                </li>
                <li>
                    Lettera dai nostri fondatori
                </li>
                <li>
                    Opportunit&agrave; di lavoro
                </li>
                <li>
                    Iscrizion Newsletter
                </li>
                <li>
                    Lista Investitori
                </li>
                <li>
                    Gift card
                </li>
            </ul>

            <ul class="col-12 col-md-3  text-center m-bottom  mb-lg-1 d-flex flex-column align-items-center">
                <li class="font-weight">
                    Contatti
                </li>
                <li>
                    Domande frequenti
                </li>
                <li>
                    Chat
                </li>
                <li>
                    Numeri utili
                </li>
                <li>
                    Termini e condizioni generali
                </li>
                <li>
                    Informativa sulla privacy
                </li>

            </ul>







            <!-- wave
                    <div class="wave">
                        <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                    </div>
            -->

        </div>

        <div class="text-center mb-5">
            <h5 class="pb-3">Trovaci sui nostri social!</h5>
            <img class="icon mx-md-4 ml-2" src="/img/icon-social/facebook.png" alt="facebook icon link">
            <img class="icon mx-md-4 ml-2" src="/img/icon-social/instagram.png" alt="instagram icon link">
            <img class="icon mx-md-4 ml-2" src="/img/icon-social/twitter.png" alt="twitter icon link">
            <img class="icon mx-md-4 ml-2" src="/img/icon-social/youtube.png" alt="youtube icon link">
            <img class="icon mx-md-4 ml-2" src="/img/icon-social/whatsapp.png" alt="whatsup icon link">
        </div>

        <div class="position-absolute scrollTop">
            <button @click="scrollToTop" type="button"
                class="btn btn-outline-dark shadow-none"><strong>&#8892;</strong></button>
        </div>


        <div class="text-center" style="font-size: 0.7rem">
            <p>&copy;Copyright 2022-2022 | Theme by Boolean | All Rights Reserved | Powered by Booleans</p>
        </div>
    </div>

</template>



<script>
export default {
    name: "Footer",
    methods: {
        scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        }
    },
}


</script>

<style lang="scss" scoped>
li {
    list-style: none;
    padding: 10px;

    margin-bottom: -10px !important;

    font-size: 0.8rem;
    color: rgb(44, 44, 44);

    &:hover {
        text-decoration: underline;
        cursor: pointer;
    }


}

.font-weight {
    font-weight: bold;
}

.bg-color {
background: rgb(144, 190, 171);
    background: linear-gradient(0deg, rgba(144, 190, 171, 1) 0%, rgba(85, 185, 143, 1) 35%, rgba(68, 189, 138, 1) 100%);
    
}

.icon {
    width: 20px;

    &:hover {
        cursor: pointer;
        transition: 0.3s;
        opacity: 0.6;
    }
}

.scrollTop {
    right: 1em;
    bottom: 5em;
}


.btn-outline-secondary {
    border-radius: 50%;

    border: 2px solid;
    width: 50px;
    height: 50px;

    &:active {
        color: #488d7f;
    }

}

    @media screen and (min-width: 100px) and (max-width: 767px){
        .m-bottom{
             margin-bottom: 20px;
        
    }
    }

</style>

