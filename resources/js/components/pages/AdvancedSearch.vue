<template>
<div>
    <div class="py-4 row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 justify-content-center">
        <div class="card col m-3" v-for="habitation in habitations" :key="habitation.id">
            <img class="card-img-top" :src="require(`../../../../public/storage/${firstImage}`)" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{habitation.title}}</h5>
                <p class="card-text">{{habitation.address}}</p>
                <router-link class="btn btn-primary" :to="{name: 'habitationDetails', params: { slug: habitation.slug} }">Vedi appartamento</router-link>
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
        locationData: Object,
    },

    data() {
        return {
            habitations: [],
            firstImage: "",
            api_key: "oXUZAxmXyTAodB2lLDjVxMGJQhcbFGUl",
        }
    },
    methods: {
        getHabitation() {
            axios.get(`http://127.0.0.1:8000/api/habitations`)
                .then((res)=>{

                    this.habitations = res.data.habitations
                    console.log('STATUS CALL API', res.data.habitations)



                    this.habitations.forEach(element => {
                        let images = element.images
                        console.log(images)

                        if (images.length) {


                            console.log('STATUS CALL IMG', element.images[0].image_url)
                            this.firstImage = images[0].image_url

                        }
                    });

                    // images = this.habitations.images[0]
                    // console.log(images)

                })
        },

        getLocation() {

            let destinationParam = this.$route.params.destination;

            if (destinationParam != "" && destinationParam != null && destinationParam != undefined) {
                let encodeLocation = encodeURI(this.$route.params.destination);
        
                let url = `https://api.tomtom.com/search/2/search/${encodeLocation}.json?limit=5&radius=${this.$route.params.radius}&minFuzzyLevel=1&maxFuzzyLevel=2&view=Unified&relatedPois=off&key=${this.api_key}`
                console.log(url)


                axios.get(url)
                        .then((res)=>{
                        let position = res.data.results[0].position;

                            let coordinates = {
                                latitude : position.lat,
                                longitude : position.lon,
                                radius: this.$route.params.radius,
                                minBeds: this.$route.params.bedsNumber,
                                minRooms: this.$route.params.roomsNumber,
                                services: this.$route.params.services
                            }

                            if (coordinates.latitude != null && coordinates.latitude != undefined && coordinates.longitude != null && coordinates.longitude != null) {

                                this.sendQuery(coordinates.latitude, coordinates.longitude, coordinates.radius, coordinates.minBeds, coordinates.minRooms, coordinates.services);
                            }
                        })
                        .catch(err => console.error('Impossibile caricare i dati', err))
            }

        },

        sendQuery(latitudine, longitudine, radius, minBeds, minRooms, services){
            axios.get('http://127.0.0.1:8000/api/search?lat='+latitudine+'&lon='+longitudine+'&radius='+radius+'&minBeds='+minBeds+'&minRooms='+minRooms+'&services='+services)
            .then( (res) => {
                console.log(res.data.filteredHab)
            })
            .catch(err => console.error('Impossibile caricare i dati', err))
        }
    },


    mounted() {
        this.getLocation();
    },

}
</script>
