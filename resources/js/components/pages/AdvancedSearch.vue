<template>
    <div>
        <!-- NOTE INPUT PER RICERCA AVANZATA -->
        <div class="w-100 search-gradient py-5 position-relative">

            <p class="position-absolute" v-show="!loading && habitations.length == 1" style="top: 0.5em; right: 0.5em;">
                La tua ricerca ha prodotto <strong>{{habitations.length}}</strong> risultato
            </p>

            <p class="position-absolute" v-show="!loading && habitations.length > 1" style="top: 0.5em; right: 0.5em;">
                La tua ricerca ha prodotto <strong>{{habitations.length}}</strong> risultati
            </p>

            <div class="searchContainer mx-auto py-4">


                <h2 class="text-center">Cerca l'alloggio perfetto per te!</h2>

                <form class="w-100 d-flex flex-column flex-sm-row justify-content-between justify-content-md-around align-items-center mt-5"
                    @submit.prevent="getHomeSearch(positionInput.destination, positionInput.radius, positionInput.bedsNumber, positionInput.roomsNumber, positionInput.checkedService)">
                    <div class="form-group m-0">
                        <input class="form-control mr-sm-2 shadow-none" type="search" placeholder="Dove vuoi andare?"
                            aria-label="Search" minlength="3" v-model="positionInput.destination" />
                    </div>

                    <!-- NOTE Button che attiva il modal -->
                    <button type="button" class="btn btn-light btn-filters d-flex align-items-center shadow-none my-3 my-sm-0" data-toggle="modal" data-target="#exampleModal">
                        <img src="/img/filter-icon.png" alt="icona ulteriori filtri" class="mr-1" width="25px">
                        <span>Filtri</span>
                    </button>

                    <div class="form-group m-0 text-center">
                        <input  type="range" class="form-control-range shadow-none" id="formControlRange"
                            min="1000" max="500000" step="1000" value="20000" v-model="positionInput.radius"
                            @keyup.enter="getHomeSearch(positionInput.destination, positionInput.radius, positionInput.bedsNumber, positionInput.roomsNumber, positionInput.checkedService)">
                            <span>
                                {{positionInput.radius / 1000}}km
                            </span>
                    </div>

                    <!-- NOTE Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Filtri opzionali</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <!-- numero minimo di stanze -->
                                    <div class="form-group my-4">
                                        <label for="roomsNumber">Numero minimo di stanze</label>
                                        <input type="number" class="form-control shadow-none" id="roomsNumber"
                                            v-model="positionInput.roomsNumber" min="1" max="99">
                                    </div>

                                    <!-- numero minimo di letti -->
                                    <div class="form-group my-4">
                                        <label for="bedsNumber">Numero minimo di letti</label>
                                        <input type="number" class="form-control shadow-none" id="bedsNumber"
                                            v-model="positionInput.bedsNumber" min="1" max="99">
                                    </div>

                                    <!-- checkboxes per servzi obbligatori -->
                                    <h3 class="text-left text-sm-center mb-4">Servizi desiderati:</h3>
                                    <div class="form-group row row-cols-1 row-cols-sm-2 row-cols-xl-4 m-0">
                                        <div class="d-flex align-items-center col my-2"
                                            v-for="service in services" :key="service.id">
                                            <input class="mr-2" type="checkbox" :value="service.id"
                                                :id="'service-'+service.id" v-model="positionInput.checkedService">
                                            <label class="" :for="'service-'+service.id">
                                                {{service.label}}
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn_outline_green shadow-none" type="submit">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>

        <Loader v-if="loading" />

        <!-- NOTE LISTA DI ANNUNCI TROVATI -->
        <div v-else class="container-fluid grid_responsive_index" :class="(habitations.length > 0) ? 'py-5' : ''">
            
            <div class="hab-card cardCust" v-for="habitation in habitations" :key="habitation.id">
                <router-link class="text-dark" :to="{name: 'habitationDetails', params: { slug: habitation.slug} }">
                    <div class="wrapper">
                        <div v-for="(image, i) in habitation.images" :key="image.id">
                            <img :src="'/storage/' + image.image_url" class="w-100" v-if="i === 0" height="350px"
                                :alt="'immagine di' + habitation.title">
                        </div>
                        <div class="data">
                            <div class="content">
                                <h2 class="title">{{habitation.title}}</h2>
                                <div class="text d-flex justify-content-between align-items-center">
                                    <p>
                                        <span>{{habitation.price}} €</span>  /notte
                                    </p>

                                    <div class="d-flex align-items-center">
                                        <span>{{habitation.guests_number}}</span>
                                        <img src="/img/icons/pageShow/people.png" alt="icona persone" class="ml-2">
                                    </div>

                                </div>
                                
                            </div>
                        </div>
                    </div>
                </router-link>
            </div>

        </div>
    </div>
                        <!-- <div :id="'carouselControls' + habitation.id" class="carousel slide" data-ride="carousel"
                        data-interval="false">
                        <div class="carousel-inner">
                            <div class="carousel-item" v-for="(image, i) in habitation.images" :class="{ active: i==0 }"
                                :key="image.id">
                                <img :src="'/storage/' + image.image_url" class="w-100 hab-img" width="280px" height="350px"
                                    :alt="'immagine di' + habitation.title">
                            </div>
                        </div>
                        <a class="carousel-control-prev" :href="'#carouselControls' + habitation.id" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" :href="'#carouselControls' + habitation.id" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div> -->
</template>

<script>
    import axios from 'axios';
    import Loader from '../includes/Loader.vue'

    export default {
        name: "AdvancedSearch",

        props: {
            filteredHabs: String,
        },

        components: {
            Loader,
        },

        data() {
            return {
                loading: false,
                habitations: [],
                services: [],
                api_key: "oXUZAxmXyTAodB2lLDjVxMGJQhcbFGUl",
               
                positionInput: {
                  destination: "",
                  radius: 20000,
                  roomsNumber: 1,
                  bedsNumber: 1,
                  checkedService: [],
                },
            }
        },
        mounted() {
            this.positionInput.destination = this.$route.params.destination;
            
            if (isNaN(this.$route.params.radius)) {
                this.positionInput.radius = 20000;
            } else {
                this.positionInput.radius = this.$route.params.radius;
            }
            this.getHomeSearch(this.$route.params.destination, this.$route.params.radius, this.$route.params.bedsNumber, this.$route.params.roomsNumber, this.$route.params.services);
            this.getServices();
            
        },
        methods: {
            getHomeSearch(location, radius, minBeds, minRooms, services) {
                let destinationParam = location;
                if (destinationParam == "") {
                    this.habitations = [];
                }
                if (destinationParam != "" && destinationParam != null && destinationParam != undefined) {
                    let encodeLocation = encodeURI(location);
                    let url = `https://api.tomtom.com/search/2/search/${encodeLocation}.json?limit=5&radius=${radius}&minFuzzyLevel=1&maxFuzzyLevel=2&view=Unified&relatedPois=off&key=${this.api_key}`
                    // console.log(url)
                    axios.get(url)
                        .then((res) => {
                            let position = res.data.results[0].position;
                            let coordinates = {
                                latitude: position.lat,
                                longitude: position.lon,
                                radiusKey: radius,
                                minBedsKey: minBeds,
                                minRoomsKey: minRooms,
                                servicesKey: services
                            }
                            if (coordinates.latitude != null && coordinates.latitude != undefined && coordinates
                                .longitude != null && coordinates.longitude != null) {
                                this.sendQuery(coordinates.latitude, coordinates.longitude, coordinates.radiusKey,
                                    coordinates.minBedsKey, coordinates.minRoomsKey, coordinates.servicesKey);
                            }
                        })
                        .catch(err => console.error('Impossibile caricare i dati', err))
                }
            },
            sendQuery(latitudine, longitudine, radius, minBeds, minRooms, services) {

                this.loading = true;

                axios.get('http://127.0.0.1:8000/api/search?lat=' + latitudine + '&lon=' + longitudine +
                        '&radius=' + radius + '&minBeds=' + minBeds + '&minRooms=' + minRooms + '&services=' +
                        services)
                    .then((res) => {
                        this.habitations = res.data.filteredHab
                        console.log(this.habitations)

                        this.loading = false;
                    })
                    .catch(err => console.error('Impossibile caricare i dati', err))
            },
            getServices() {
            axios.get('http://127.0.0.1:8000/api/services')
                .then((res) => {
                    console.log(res.data)
                    this.services = res.data.services;
                })
                .catch(err => console.error('Impossibile caricare i dati', err))
            },
         
        }
    }
</script>

<style lang="scss" scoped>

    .btn-filters {

        &:active {
            transform: scale(0.9);
        }
    }

    .search-gradient {
        background: rgb(47,166,143);
        background: linear-gradient(90deg, rgba(47,166,143,0.8463760504201681) 0%, rgba(34,179,151,0.6979166666666667) 30%, rgba(38,175,148,0.4990371148459384) 60%, rgba(25,188,156,0.39539565826330536) 100%);
    }

    @media screen and (min-width: 821px) {
        .searchContainer {
            width: 70%;
        }
    }
   @media screen and (min-width: 601px) and (max-width: 820px) {
       .searchContainer {
           width: 90%;
       }
    }

    @media screen and (min-width: 200px) and (max-width: 600px) {         
        .searchContainer {
            width: 100%;
        }
    }
</style>