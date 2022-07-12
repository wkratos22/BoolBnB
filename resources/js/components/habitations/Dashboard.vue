<template>
    <div class="container-fluid">
        <HabitationsSponsored/>

        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-3 justify-content-center">
            <div class="col card m-2 position-relative" v-for="habitation in habsNotSponsor" :key="habitation.id">
                <!-- <img src="..." class="card-img-top" alt="..."> -->

                <div class="card-body">
                    <h5 class="card-title">{{habitation.title}}</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                    <router-link class="btn btn-primary"
                        :to="{name: 'habitationDetails', params: { slug: habitation.slug} }">Vedi appartamento
                    </router-link>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
import HabitationsSponsored from "./HabitationsSponsored.vue";

export default {
    name: 'Dashboard',

    components: {
        HabitationsSponsored
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
