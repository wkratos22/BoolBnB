<template>
    <div class="container-custom">


        <div class="d-flex">

            <div class="w-50">

                <!-- <div>
                    <h2 class="mt-24 mb-32">{{habitation.title}}</h2>
                </div> -->

                <div class="position-relative">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item" v-for="(image, i) in images" :class="{ active: i==0 }" :key="image.id">
                            <img :src="'/storage/' + image.image_url" class="w-100 hab-img" :alt="'immagine di' + habitation.title">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    </div>
                    <!-- <img :src="'/storage/' + image.image_url" class="w-100 hab-img" :alt="'immagine di' + habitation.title" v-if="index == 0"> -->

                    <!-- LABEL METRI QUADRI -->
                    <div class="text-center position-absolute habSquare p-1 bg-light rounded">
                        <p class="text-dark font-weight-bold">
                            {{habitation.square_meters}} &#13217;
                        </p>
                    </div>

                </div>

            </div>

            <!-- MAPPA -->
            <div class="w-50">
                <!-- <div>
                    <h2 class="mt-24 mb-32">Ci troviamo qui..</h2>
                </div> -->
                <div class="w-100" id='map'></div>
            </div>
        </div>

        <div class="px-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="firstCapitalize text-dark w-75">{{habitation.title}}</h3>

                <div class="d-flex align-items-center w-25 py-2">
                    <img :src="'/img/icons/types/' + type.icon" :alt="'tipologia' + type.label" id="typeHab" width="35px">
                    <label for="typeHab" class="ml-1">{{type.label}}</label>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-around my-3">

                <div class="text-center">
                    <div>
                        <span class="text-dark font-weight-bold"> {{habitation.price}} &#8364;</span>
                    </div>

                    <div>
                        <span>/ notte</span>
                    </div>
                </div>

                <div class="text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="text-dark font-weight-bold mr-1"> {{habitation.guests_number}}</span>
                        <img src="/img/icons/pageShow/people.png" alt="people icon">
                    </div>

                    <span>
                        Capacità
                    </span>
                </div>

                <div class="text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="text-dark font-weight-bold mr-1"> {{habitation.bathrooms_number}}</span>
                        <img src="/img/icons/pageShow/bathroom.png" alt="bathroom icon">
                    </div>

                    <span>
                        Bagni
                    </span>
                </div>

                <div class="text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="text-dark font-weight-bold mr-1"> {{habitation.rooms_number}}</span>
                        <img src="/img/icons/pageShow/room.png" alt="room icon">
                    </div>

                    <span>
                        Stanze
                    </span>
                </div>

                <div class="text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="text-dark font-weight-bold mr-1"> {{habitation.beds_number}}</span>
                        <img src="/img/icons/pageShow/bed.png" alt="bed icon">
                    </div>

                    <span>
                        Letti
                    </span>
                </div>
            </div>

            <p class="text-dark my-2">
                {{habitation.description}}
            </p>

            <div class="my-5">
                <h4 class="text-dark text-center my-3">Servizi presenti nella struttura:</h4>
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex flex-column align-items-center w-25 my-2" v-for="service in services" :key="service.id">
                        <img :src="'/img/icons/services/' + service.icon" :alt="'icona di' + service.label" width="25px">
                        <span>{{service.label}}</span>
                    </div>
                </div>
            </div>

            <div class="my-5">
                <h4 class="text-dark text-center my-3">Altre caratteristiche della struttura:</h4>
                <div class="d-flex justify-content-start align-items-center flex-wrap">
                    <div class="d-flex flex-column align-items-center w-25 my-2" v-for="tag in tags" :key="tag.id">
                        <img :src="'/img/icons/tags/' + tag.icon" :alt="'icona di' + tag.label" width="25px">
                        <span>{{tag.label}}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- CONTACT FORM -->
        <div>
            <ContactForm :userId="habitation.user_id" :habitationId="habitation.id"/>
        </div>

    </div>
</template>

<script>
import ContactForm from '../includes/ContactForm.vue';
import tt from '@tomtom-international/web-sdk-maps';

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
                        minZomm: 5,
                        theme: {
                            style: 'buildings',
                            layer: 'basic',
                            source: 'vector'
                        },
                        dragPan: !isMobileOrTablet()

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

                function isMobileOrTablet(){var i,a=!1;return i=navigator.userAgent||navigator.vendor||window.opera,(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(i)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(i.substr(0,4)))&&(a=!0),a}window.isMobileOrTablet=window.isMobileOrTablet||isMobileOrTablet;
            }

        },

        mounted() {
            this.getHabitation()
        }

    }
</script>

<style lang="scss" scoped>

    .firstCapitalize::first-letter {
        text-transform: uppercase;
    }

    .habSquare {
        top: 1em;
        right: 1em;
    }

    #map,
    .hab-img {
        height: 70vh;
    }

</style>
