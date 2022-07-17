<template>
<div>
    <div class="containerDue">

        <div class="align-middle">

            <div class="d-flex mt-80 mb-8">
                <div class="d-flex align-items-center py-2 align-middle mr-16">
                    <img :src="'/img/icons/types/' + type.icon" :alt="'tipologia' + type.label" id="typeHab" width="25px">
                </div>
                <h2 class="align-middle">{{habitation.title}}</h2>
            </div>

            <div class="d-flex mt-24 mb-8">
                <span class="align-middle mr-16">
                    <img src="/img/icons8-euro-48.png" width="25px" alt="">
                </span>
                <span class="text-dark">{{habitation.price}}<span>/notte</span></span>
            </div>

            <div class="mt-24 mb-8 d-flex align-items-center flex-wrap">
                <div v-for="tag in tags" :key="tag.id">
                    <router-link :to="{ name: 'advancedSearch' }" class="gray-20 gray-20-hover mr-32 d-flex align-items-center my-2 my-md-0" role="button">
                        <img :src="'/img/icons/tags/' + tag.icon" class="align-middle mr-16" :alt="'icona di' + tag.label" width="25px"  role="button">
                        <label  role="button" class="align-middle">{{tag.label}}</label>
                    </router-link>
                </div>
            </div>

        </div>

        <!-- <div class="align-middle mt-80"> -->
            <!-- Button trigger modal -->

            <!-- <a class="gray-20 gray-20-hover mr-32 align-middle" role="button" data-toggle="modal" data-target="#exampleModal">
                <span class="underline align-middle">Condividi</span>
            </a> -->

            <!-- Modal
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="containerDue b-1 modal-content d-flex flex-column justify-content-between">
                        <div class="align-self-start m-8">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-header m-24">
                            <h5 class="modal-title" id="exampleModalLabel">Condividi questo luogo con amici e familiari</h5>
                        </div>
                        <div class="d-flex m-24 align-items-center">
                            <div class="align-middle b-left-radius b-right-radius m-8" v-for="(image, i) in images" :class="{ active: i==0 }" :key="image.id">
                                <img :src="'/storage/' + image.image_url" class="align-middle b-left-radius b-right-radius align-middle" width="70px" height="70px" :alt="'immagine di' + habitation.title">
                            </div>
                            <div class="align-middle ml-24">
                                <span class="align-middle">{{habitation.title}}</span>
                            </div>
                            <div>
                                <router-link id="testo-da-copiare" class="d-none btn btn-primary" :to="{name: 'habitationDetails', params: { slug: habitation.slug} }">

                                </router-link>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between m-24">
                            <button href="" id="pulsante-da-premere" class="btn shadow-none p-16 b-1 btn-hover">
                                Copia il link
                            </button>
                        </div>
                    </div>
                </div>
            </div> -->
        <!-- </div> -->


        <div class="imgMapWrapper d-flex justify-content-between align-items-center b-left-radius b-right-radius mt-4">

            <div class="imgWrapper mt-2 mt-md-0">

                <div class="position-relative b-left-radius h-100">
                    <div id="carouselExampleControls" class="carousel slide b-left-radius b-right-radius h-100" data-ride="carousel">
                        <div class="carousel-inner b-left-radius b-right-radius h-100">
                            <div class="carousel-item b-left-radius h-100" v-for="(image, i) in images" :class="{ active: i==0 }" :key="image.id">
                                <img :src="'/storage/' + image.image_url" class="b-left-radius b-right-radius hab-img w-100 h-100" :alt="'immagine di' + habitation.title">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" style="filter: invert(1);" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" style="filter: invert(1);" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>


                    <!-- LABEL METRI QUADRI -->
                    <div class="text-center position-absolute habSquare p-1 bg-green-custom rounded">
                        <p class="text-dark font-weight-bold">
                            {{habitation.square_meters}} &#13217;
                        </p>
                    </div>

                </div>

            </div>

            <!-- MAPPA -->
            <div class="mapWrapper mt-2 mt-md-0">
                <div class="b-right-radius b-left-radius w-100 h-100" id='map'></div>
            </div>
        </div>

        <!-- <div class="b-2 mt-5 mt-80"></div> -->
    </div>

    <div class="w-100 text-center mb-80 mt-80 bg-green p-40">
        <h3 class="text-white">
            Sempre in contatto con ogni singolo Host.
        </h3>
    </div>

    <div>

        <div class="d-flex containerDue containerCustomS">

            <div class="w-75 mb-56">

                <div>
                    <div class="d-flex justify-content-between garanziaWrapper">
                        <div class="boolCover">
                            <div class="mb-24">
                                <h2 class="greenAndBorder">
                                    Solo Boolbnb ti offre BoolCover
                                </h2>
                            </div>

                            <h5>
                                Ogni prenotazione include una protezione gratuita
                                in caso di cancellazione da parte dell'host, di
                                inesattezze dell'annuncio e di altri problemi come
                                le difficoltà in fase di check-in.
                            </h5>
                        </div>

                        <table class="table table-borderless table-hover table-responsive-sm table-responsive-md table-responsive-lg w-50">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>
                                        <h5>
                                            Boolbnb
                                        </h5>
                                    </th>
                                    <th>
                                        <h5>
                                            Concorrenti
                                        </h5>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="align-middle">
                                    <td>
                                        <h5>
                                            Garanzia di prenotazione
                                        </h5>
                                    </td>
                                    <td class="text-center">
                                        <img src="/img/icons8-check-mark-48.png" class="w_25" alt="">
                                    </td>
                                    <td class="text-center">
                                        <img src="/img/icons8-close-48.png" class="w_25" alt="">
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td>
                                        <h5>Garanzia di check-in</h5>
                                    </td>
                                    <td class="text-center">
                                        <img src="/img/icons8-check-mark-48.png" class="w_25" alt="">
                                    </td>
                                    <td class="text-center">
                                        <img src="/img/icons8-close-48.png" class="w_25" alt="">
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td>
                                        <h5>Garanzia di conformità</h5>
                                    </td>
                                    <td class="text-center">
                                        <img src="/img/icons8-check-mark-48.png" class="w_25" alt="">
                                    </td>
                                    <td class="text-center">
                                        <img src="/img/icons8-close-48.png" class="w_25" alt="">
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td>
                                        <h5>Supporto sicurezza H24</h5>
                                    </td>
                                    <td class="text-center">
                                        <img src="/img/icons8-check-mark-48.png" class="w_25" alt="">
                                    </td>
                                    <td class="text-center">
                                        <img src="/img/icons8-close-48.png" class="w_25" alt="">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="d-flex justify-content-center mt-5 mb-80">
                        <span>
                            Vantaggi di BoolCover rispetto alle protezioni complete offerte gratuitamente dai nostri concorrenti più diretti.
                        </span>
                    </div> -->
                </div>

                <div class="py-6 border-top d-flex align-items-center" style="border-width: 2px;">
                    <h3 class="mr-40 mb-16 contactText">
                        Cosa aspetti? Contatta l'Host e prepara la valigia!
                    </h3>
                    <div class="ml-120 contactArrow">
                        <img src="/img/icons8-destra-80.png" alt="">
                    </div>
                </div>


                <div class="py-6 border-top" style="border-width: 2px;">
                    <div class="b-left-radius-2 b-right-radius-2 ">
                        <h2 class="align-middle">Descrizione</h2>
                    </div>
                    <div class="mt-16 b-left-radius-2 b-right-radius-2">
                        <p class="text-dark">
                            {{habitation.description}}
                        </p>
                    </div>
                </div>


                <div class="py-6 border-top" style="border-width: 2px;">
                    <div class="b-left-radius-2 b-right-radius-2 ">
                        <h2 class="align-middle">Caratteristiche</h2>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <div class="d-flex mt-5 align-items-center">
                                <img class="align-middle" src="/img/icons/pageShow/people.png" alt="people icon">
                                <span class="text-dark ml-8 align-middle"> {{habitation.guests_number}}</span>
                                <label class="align-middle ml-8">Ospiti</label>
                            </div>
                            <div class="mt-5 d-flex align-items-center">
                                <img class="align-middle" src="/img/icons/pageShow/room.png" alt="room icon">
                                <span class="text-dark ml-8 align-middle"> {{habitation.rooms_number}}</span>
                                <label class="align-middle ml-8">Stanze</label>
                            </div>
                        </div>
                        <div class="justify-self-center">
                            <div class="mt-5 d-flex align-items-center">
                                <img class="align-middle" src="/img/icons/pageShow/bed.png" alt="bed icon">
                                <span class="text-dark ml-8 align-middle"> {{habitation.beds_number}}</span>
                                <label class="align-middle ml-8">Posti letto</label>
                            </div>
                            <div class="mt-5 d-flex align-items-center">
                                <img class="align-middle" src="/img/icons/pageShow/bathroom.png" alt="bathroom icon">
                                <span class="text-dark ml-8 align-middle"> {{habitation.bathrooms_number}}</span>
                                <label class="align-middle ml-8">Bagni</label>
                            </div>
                        </div>
                        <div>

                        </div>
                    </div>
                </div>


                <div class="py-6 border-top" style="border-width: 2px;">

                    <h2>Cosa troverai</h2>

                    <div class="row row-cols-2 servicesWrapper">
                        <div v-for="service in services" :key="service.id" class="col d-flex align-items-center mt-5">
                            <img :src="'/img/icons/services/' + service.icon" :alt="'icona di' + service.label" width="25px">
                            <span class="text-dark ml-8">{{service.label}}</span>
                        </div>
                    </div>
                </div>


            </div>

            <!-- CONTACT FORM -->
            <div class="sidenav w-25 mb-80 ml-24 mb-32 b-left-radius-2 b-right-radius-2">
                <div class="mt-16 mb-16 b-left-radius-2 b-right-radius-2 w-75 mx-auto">
                    <ContactForm :userId="habitation.user_id" :habitationId="habitation.id"/>
                </div>
            </div>
        </div>
    </div>
</div>

</template>

<script>
import ContactForm from '../includes/ContactForm.vue';


    export default {
        name: "HabitationDetails",

        components: {
            ContactForm
        },

        data() {
            return {
                // habitation data
                habitation: [],
                images: [],
                type: {},
                services: [],
                tags: [],

                // TomTom Map data
                map: null,
                location: [],
                style: 'https://api.tomtom.com/style/1/style/*?map=2/basic_street-satellite&poi=2/poi_dynamic-satellite&key=k87agPGYuyeyzMn0ZPCv6AGAxV0dI4UZ',
            }
        },

        methods: {
            getHabitation() {

                axios.get(`http://127.0.0.1:8000/api/habitations/${ this.$route.params.slug }`)
                    .then((res) => {

                        this.habitation = res.data;

                        this.images = res.data.images;

                        this.services = res.data.services;

                        this.type = res.data.habitation_type;

                        this.tags = res.data.tags;

                        this.location = [this.habitation.longitude, this.habitation.latitude];

                        this.getMap();

                    })
                    .catch((err) => {
                        console.log(err);
                    })
            },

            getMap(){

                this.map = tt.map({
                        key: 'k87agPGYuyeyzMn0ZPCv6AGAxV0dI4UZ',
                        container: 'map',
                        basePath: 'sdk/',
                        center: this.location,
                        zoom: 15,
                        minZoom: 5,
                        // theme: {
                        //     style: `https://api.tomtom.com/style/1/style/*?map=2/basic_street-satellite&poi=2/poi_dynamic-satellite&key=${this.api_key}`,
                        //     layer: 'basic',
                        //     source: 'vector'
                        // },
                        style: this.style,
                        // dragPan: !isMobileOrTablet()

                    });

                this.map.addControl(new tt.FullscreenControl());
                this.map.addControl(new tt.NavigationControl());

                var popupOffsets = {
                    top: [0, 0],
                    bottom: [0, -30],
                    'bottom-right': [0, -30],
                    'bottom-left': [0, -30],
                    left: [25, -35],
                    right: [-25, -35]
                }

                var marker = new tt.Marker().setLngLat(this.location).addTo(this.map);
                var popup = new tt.Popup({ offset: popupOffsets }).setHTML(this.habitation.title + '<br>' + this.habitation.address);
                marker.setPopup(popup).togglePopup();

                // function isMobileOrTablet(){var i,a=!1;return i=navigator.userAgent||navigator.vendor||window.opera,(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(i)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(i.substr(0,4)))&&(a=!0),a}window.isMobileOrTablet=window.isMobileOrTablet||isMobileOrTablet;
            },

            // getCopyText(){
            //     document.querySelector("#pulsante-da-premere").onclick = function() {
            //         selezione del contenuto
            //         document.querySelector("#testo-da-copiare").select();
            //         copia negli appunti
            //         document.execCommand('copy');
            //     };
            // }

        },

        mounted() {
            this.getHabitation()

            // this.getCopyText()
        }

    }
</script>

<style lang="scss" scoped>

    .firstCapitalize::first-letter {
        text-transform: uppercase;
    }

    .py-6 {
        padding: 4rem 0;
    }

    .imgMapWrapper {
        height: 50vh;

        .carousel-item {
            height: 100%;

        }
    }

    .imgMapWrapper > div {
        height: 100%;
        width: 49%;

        // #map {
        //     height: 100%;
        // }
    }

    .habSquare {
        top: 1em;
        right: 1em;
    }

    .boolCover {
        width: 50%;

        h5 {
            width: 75%;
        }
    }

    @media screen and (max-width:1180px) {
        .containerCustomS {
            flex-direction: column-reverse;
            align-items: center;

            .sidenav {
                position: static;
                width: 100% !important;
                margin-left: 0;
            }

            .garanziaWrapper {
                padding-bottom: 4rem;
    
                .boolCover {
                    width: 100%;

                    h5 {
                        font-size: 1.1em;
                        width: 100%;
                    }
                }
    
                table {
                    display: none;
                }
            }

            .contactArrow {
                display: none;

            }

            .contactText {
                margin: 0;
            }
        }
    }

    @media screen and (max-width:768px) {

        h2 {
            font-size: 1.5em;
        }

        h3 {
            font-size: 1.3em;
        }

        .imgMapWrapper {
            height: 100vh;
            flex-direction: column-reverse;
        }

        .imgMapWrapper > div {
            width: 75%;
            margin: 0 auto;
        }

        .servicesWrapper {
            height: 250px;
            overflow-y: auto;
        }

        .servicesWrapper::-webkit-scrollbar,
        .servicesWrapper::-webkit-scrollbar {
            width: 0.4em;
        }

        .servicesWrapper::-webkit-scrollbar-track,
        .servicesWrapper::-webkit-scrollbar-track {

            box-shadow: inset 0 0 2px grey;
            border-radius: 1em;
        }
        
        .servicesWrapper::-webkit-scrollbar-thumb,
        .servicesWrapper::-webkit-scrollbar-thumb {
            background: #26af94; 
            border-radius: 1em;
        }

        .servicesWrapper::-webkit-scrollbar-thumb:hover,
        .servicesWrapper::-webkit-scrollbar-thumb:hover {
            background: #409584; 
        }
    }

    @media screen and (max-width:575px) {
        .servicesWrapper {
            span {
                font-size: 0.8em;
            }
        }
    }

</style>
