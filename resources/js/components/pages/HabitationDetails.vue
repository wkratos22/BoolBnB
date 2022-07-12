<template>
    <div class="container-custom">

        <div>
            <h1 class="mt-24 mb-32">Scopri di più..</h1>
        </div>

        <div class="d-flex flex-wrap justify-content-between">

            <div>

                <div>
                    <h2 class="mt-24 mb-32">{{habitation.title}}</h2>
                </div>

                <div v-for="(image, index) in images" :key="index" class="position-relative">

                    <img :src="'/storage/' + image.image_url" class="hab-img border-custom rounded" :alt="'immagine di' + habitation.title" v-if="index == 0">
                    <div class="text-center position-absolute habSquare p-1 bg-light rounded" v-if="index == 0">
                        <p class="text-dark font-weight-bold">
                            {{habitation.square_meters}} &#13217;
                        </p>
                    </div>

                </div>

                <div class="px-3 border-custom rounded">
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

                <div class="text-center">
                    <button class="btn btn-primary" @click="$router.back()">Torna alla ricerca</button>
                </div>

            </div>

            <!-- MAPPA -->
            <div class="w-50">
                <div>
                    <h2 class="mt-24 mb-32">Ci troviamo qui..</h2>
                </div>
                <div class="map-div border-custom rounded" id='map'></div>
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
                habitation: [],
                images: [],
                type: {},
                services: [],
                tags: [],
                latitude: '',
                longitude: '',
                isError: false,
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

                        this.latitude = parseFloat(res.data.latitude);

                        this.longitude = parseFloat(res.data.longitude);
                    })
                    .catch((err) => {
                        console.log(err);
                        this.isError = true;
                    })
            },

            getMap(){
                var map = tt.map({
                        key: 'k87agPGYuyeyzMn0ZPCv6AGAxV0dI4UZ',
                        container: 'map',
                        basePath: 'sdk/',
                        center: [41.9109, 12.4818],
                        zoom: 15,
                        theme: {
                            style: 'buildings',
                            layer: 'basic',
                            source: 'vector'
                        }
                    });
                    map.addControl(new tt.NavigationControl());
            }

        },

        mounted() {
            this.getHabitation(),

            this.getMap()
        }

    }
</script>

<style lang="scss" scoped>

    .container-custom{
        width: 90%;
        margin: 0 auto;
    }

    .firstCapitalize::first-letter {
        text-transform: uppercase;
    }

    .habSquare {
        top: 1em;
        right: 1em;
    }

    .map-div {
        width: 650px;
        height: 650px;
    }

    .hab-img{
        width: 650px;
        height: 650px;
    }

    .border-custom{
        border: 2px solid black;
    }

</style>
