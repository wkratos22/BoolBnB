<template>
    <div>
        <!-- INPUT PER RICERCA AVANZATA -->
        <div class="searchContainer mx-auto my-4">
            <form class="w-100 d-flex justify-content-around align-items-center display-flex-column "
                @submit.prevent="getHomeSearch(positionInput.destination, positionInput.radius, positionInput.bedsNumber, positionInput.roomsNumber, positionInput.checkedService)">
                <div class="form-group margin">
                    <input class="form-control mr-sm-2" type="search" placeholder="Dove vuoi andare?"
                        aria-label="Search" minlength="3" v-model="positionInput.destination" />
                </div>

                <form>
                    <div class="form-group margin text-center ">
                        <label for="formControlRange">Raggio di ricerca?</label>
                        <input  type="range" class="form-control-range" id="formControlRange"
                            min="1000" max="500000" step="1000" value="20000" v-model="positionInput.radius"
                            @keyup.enter="getHomeSearch(positionInput.destination, positionInput.radius, positionInput.bedsNumber, positionInput.roomsNumber, positionInput.checkedService)">
                        

                        {{positionInput.radius / 1000}}km
                    </div>
                </form>

                <button @click.prevent="getShow()" class="btn btn-secondary dropdown-toggle margin" type="button">
                    Ulteriori Filtri
                </button>

                <div v-if="active" class="addFilters form-group position-absolute bg-dark py-5">
                    <div class="container margin">

                        <!-- gruppo input ULTERIORI FILTRI -->
                        <form>
                            <!-- numero minimo di stanze -->
                            <div class="form-group my-4">
                                <label class="text-light" for="roomsNumber">Numero minimo di stanze</label>
                                <input type="number" class="form-control" id="roomsNumber"
                                    v-model="positionInput.roomsNumber" min="1" max="99">
                            </div>

                            <!-- numero minimo di letti -->
                            <div class="form-group my-4">
                                <label class="text-light" for="bedsNumber">Numero minimo di letti</label>
                                <input type="number" class="form-control" id="bedsNumber"
                                    v-model="positionInput.bedsNumber" min="1" max="99">
                            </div>

                            <!-- checkboxes per servzi obbligatori -->
                            <h3 class="text-light text-center mb-4">Servizi desiderati:</h3>
                            <div class="form-group row row-cols-2 row-cols-md-3 row-cols-xl-4 m-0">
                                <div class="form-check col flex-column justify-content-center my-2 w-25"
                                    v-for="service in services" :key="service.id">
                                    <input class="form-check-input mr-0" type="checkbox" :value="service.id"
                                        :id="'service-'+service.id" v-model="positionInput.checkedService">
                                    <label class="form-check-label text-light" :for="'service-'+service.id">
                                        {{service.label}}
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">
                    Search
                </button>

            </form>
        </div>
        <!-- LISTA DI ANNUNCI TROVATI -->
        <div class="py-4 row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 justify-content-center">
            <div class="card col px-0 m-3" v-for="habitation in habitations" :key="habitation.id">
                <!-- <div  v-for="(image, i) in habitation.images" :key="image.id" > 
                    <img class="card-img-top" :src="'/storage/' + image.image_url" alt="Card image cap" width="280px" height="350px" v-if="i == 0">
                </div> -->
                <div :id="'carouselControls' + habitation.id" class="carousel slide" data-ride="carousel"
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
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{habitation.title}}</h5>
                    <p class="card-text">{{habitation.address}}</p>
                    <router-link class="btn btn-primary"
                        :to="{name: 'habitationDetails', params: { slug: habitation.slug} }">Vedi appartamento
                    </router-link>
                </div>
            </div>

        </div>



    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "AdvancedSearch",

        props: {
            filteredHabs: String,
        },

        data() {
            return {
                active: false,
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
            getShow() {
                this.active = !this.active
            },

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
                axios.get('http://127.0.0.1:8000/api/search?lat=' + latitudine + '&lon=' + longitudine +
                        '&radius=' + radius + '&minBeds=' + minBeds + '&minRooms=' + minRooms + '&services=' +
                        services)
                    .then((res) => {
                        this.habitations = res.data.filteredHab
                        console.log(this.habitations)
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

 @media screen and (min-width: 821px) {

 .searchContainer {
        width: 60%;
    }

    .addFilters {
        z-index: 9999;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        height: 60vh;
        width: 60vw;
    }

 }

   @media screen and (min-width: 601px) and (max-width: 820px) {

       .searchContainer {
           width: 90%;
       }


       .addFilters {
           z-index: 9999;
           top: 50%;
           left: 50%;
           transform: translate(-50%, -50%);
           height: 60vh;


       }
           
   }

 @media screen and (min-width: 200px) and (max-width: 600px) { 
  

        .margin{
            margin-bottom: 20px;
        }

                 .searchContainer {
                     width: 100%;
                 }

                 .display-flex-column{
                    display: flex;
                    flex-direction: column;
                 }
                                   input {
                                       width: 220px;
                                       height: 40px;
                                   }

 }

</style>