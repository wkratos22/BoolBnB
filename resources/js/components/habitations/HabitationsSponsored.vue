<template>

    <div>
        <h2 class="text-center mb-3">In Evidenza</h2>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-3 justify-content-center">
            <div class="col card m-2 position-relative" v-for="habitation in sortedArray" :key="habitation.id">
                <!-- <img src="..." class="card-img-top" alt="..."> -->

                <div class="sponsorCrown position-absolute">
                    <img src="/img/corona.png" alt="corona sponsor premium" width="20px"  v-if="habitation.sponsorships[0].id == 3">
                    <img src="/img/corona-silver.png" alt="corona sponsor medium" v-else-if="habitation.sponsorships[0].id == 2">
                    <img src="/img/corona-rame.png" alt="corona sponsor basic" v-else-if="habitation.sponsorships[0].id == 1">
                </div>

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
import axios from 'axios';

    export default {
        name: "HabitationsSponsored",

        data(){
            return{
                sponsoredHabs: [],
                firstImage: "",
            }
        },

        methods: {
            getHabitation() {
            axios.get(`http://127.0.0.1:8000/api/habitations/sponsor`)
                .then((res)=>{

                    this.sponsoredHabs = res.data.sponsoredHabs;
                    console.log(res.data.sponsoredHabs);

                })
                .catch(err => console.error('Impossibile caricare i dati', err))
            }
        },

        computed: {
            sortedArray: function() {
                function compare(a, b) {

                    if (a.sponsorships[0].id > b.sponsorships[0].id)
                        return -1;

                    if (a.sponsorships[0].id < b.sponsorships[0].id)
                        return 1;
                        return 0;
                }

                return this.sponsoredHabs.sort(compare);
            }
        },

        mounted(){
            this.getHabitation()
        }
    }


</script>

<style lang="scss" scoped>

    .sponsorCrown {
        top: 5px;
        right: 10px;
    }

</style>