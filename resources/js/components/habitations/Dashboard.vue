<template>
    <div class="container-fluid">
        <HabitationsSponsored/>

        <EasyBooking />

        <div class="container-fluid grid_responsive_index sponsor-gradient pb-5 pt-3">
            
            <div class="hab-card cardCust" v-for="habitation in habsNotSponsor" :key="habitation.id">
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

        <Banner/>

    </div>
</template>

<script>
import HabitationsSponsored from "./HabitationsSponsored.vue";
import EasyBooking from "../includes/EasyBooking.vue";
import Banner from "../includes/Banner.vue";

export default {
    name: 'Dashboard',

    components: {
        HabitationsSponsored,
        EasyBooking, 
        Banner
    },

    data(){
        return {
            habsNotSponsor: [],
        }
    },

    methods: {
        getHabsNoSponsor() {
        axios.get('http://127.0.0.1:8000/api/habitations')
            .then((res) => {
                console.log(res.data.habsNoSponsor)
                this.habsNotSponsor = res.data.habsNoSponsor;
            })
            .catch(err => console.error('Impossibile caricare i dati', err))
        },
    },

    mounted(){
        this.getHabsNoSponsor();
    }

}
</script>
