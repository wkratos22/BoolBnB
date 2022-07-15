<template>
<div class="carouselContainer position-relative mx-auto" ref="carouselCustom">
    <div class="carouselInner overflow-hidden">
        <div class="trackCust d-flex" ref="track" :style="[trackNext ? {'transform': `translateX(-${carouselWidth}px)`} : {}, trackPrev ? {'transform': `translateX(-${0}px)`} : {}]">
            <div class="cardCust pr-3" v-for="habitation in sortedArray" :key="habitation.id">
                <router-link class="text-dark" :to="{name: 'habitationDetails', params: { slug: habitation.slug} }">
                    <div class="wrapper w-100 h-100">
                        <!-- Cover -->
                        <div v-for="(image, i) in habitation.images" :key="image.id">
                            <img :src="'/storage/' + image.image_url" v-if="i === 0" width="495px" height="350px"
                                :alt="'immagine di' + habitation.title">
                        </div>

                        <!-- Effetto hover con titolo, prezzo e max ospiti -->
                        <div class="data">
                            <div class="content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h2 class="title">{{habitation.title}}</h2>

                                    <!-- Corona Sponsorizzazione -->
                                    <div>
                                        <img src="/img/corona.png" alt="corona sponsor premium" width="30px" v-if="habitation.sponsorships[0].id == 3">
                                        <img src="/img/corona-silver.png" alt="corona sponsor medium" width="30px" v-else-if="habitation.sponsorships[0].id == 2">
                                        <img src="/img/corona-rame.png" alt="corona sponsor basic" width="30px" v-else-if="habitation.sponsorships[0].id == 1">
                                    </div>

                                </div>
                                <div class="text d-flex justify-content-between align-items-center">
                                    <p>
                                        <span>{{habitation.price}} €</span> /notte
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

    <div class="navCust">
        <button class="btn shadow-none prevCust position-absolute" @click.prevent="prev()">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" fill="#409584" viewBox="0 0 122.88 122.88" style="enable-background:new 0 0 122.88 122.88" xml:space="preserve"><g><path d="M84.93,4.66C77.69,1.66,69.75,0,61.44,0C44.48,0,29.11,6.88,18,18C12.34,23.65,7.77,30.42,4.66,37.95 C1.66,45.19,0,53.13,0,61.44c0,16.96,6.88,32.33,18,43.44c5.66,5.66,12.43,10.22,19.95,13.34c7.24,3,15.18,4.66,23.49,4.66 c8.31,0,16.25-1.66,23.49-4.66c7.53-3.12,14.29-7.68,19.95-13.34c5.66-5.66,10.22-12.43,13.34-19.95c3-7.24,4.66-15.18,4.66-23.49 c0-8.31-1.66-16.25-4.66-23.49c-3.12-7.53-7.68-14.29-13.34-19.95C99.22,12.34,92.46,7.77,84.93,4.66L84.93,4.66z M72.88,47.13 c2.48-2.52,2.45-6.58-0.08-9.05s-6.58-2.45-9.05,0.08L45.08,57.13c-2.45,2.5-2.45,6.49,0,8.98l18.32,18.62 c2.48,2.52,6.53,2.55,9.05,0.08c2.52-2.48,2.55-6.53,0.08-9.05l-13.9-14.13L72.88,47.13L72.88,47.13z M80.02,16.55 c5.93,2.46,11.28,6.07,15.76,10.55c4.48,4.48,8.09,9.83,10.55,15.76c2.37,5.71,3.67,11.99,3.67,18.58c0,6.59-1.31,12.86-3.67,18.58 c-2.46,5.93-6.07,11.28-10.55,15.76c-4.48,4.48-9.83,8.09-15.76,10.55C74.3,108.69,68.03,110,61.44,110s-12.86-1.31-18.58-3.67 c-5.93-2.46-11.28-6.07-15.76-10.55c-4.48-4.48-8.09-9.82-10.55-15.76c-2.37-5.71-3.67-11.99-3.67-18.58 c0-6.59,1.31-12.86,3.67-18.58c2.46-5.93,6.07-11.28,10.55-15.76c4.48-4.48,9.83-8.09,15.76-10.55c5.71-2.37,11.99-3.67,18.58-3.67 C68.03,12.88,74.3,14.19,80.02,16.55L80.02,16.55z"/></g></svg>
        </button>

        <button class="btn shadow-none nextCust position-absolute" @click.prevent="next()">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" fill="#409584" viewBox="0 0 122.88 122.88" style="enable-background:new 0 0 122.88 122.88" xml:space="preserve"><g><path d="M37.95,4.66C45.19,1.66,53.13,0,61.44,0c16.96,0,32.33,6.88,43.44,18c5.66,5.66,10.22,12.43,13.34,19.95 c3,7.24,4.66,15.18,4.66,23.49c0,16.96-6.88,32.33-18,43.44c-5.66,5.66-12.43,10.22-19.95,13.34c-7.24,3-15.18,4.66-23.49,4.66 c-8.31,0-16.25-1.66-23.49-4.66c-7.53-3.12-14.29-7.68-19.95-13.34C12.34,99.22,7.77,92.46,4.66,84.93C1.66,77.69,0,69.75,0,61.44 c0-8.31,1.66-16.25,4.66-23.49C7.77,30.42,12.34,23.66,18,18C23.65,12.34,30.42,7.77,37.95,4.66L37.95,4.66z M50,47.13 c-2.48-2.52-2.45-6.58,0.08-9.05c2.52-2.48,6.58-2.45,9.05,0.08L77.8,57.13c2.45,2.5,2.45,6.49,0,8.98L59.49,84.72 c-2.48,2.52-6.53,2.55-9.05,0.08c-2.52-2.48-2.55-6.53-0.08-9.05l13.9-14.13L50,47.13L50,47.13z M42.86,16.55 c-5.93,2.46-11.28,6.07-15.76,10.55c-4.48,4.48-8.09,9.83-10.55,15.76c-2.37,5.71-3.67,11.99-3.67,18.58 c0,6.59,1.31,12.86,3.67,18.58c2.46,5.93,6.07,11.28,10.55,15.76c4.48,4.48,9.83,8.09,15.76,10.55c5.72,2.37,11.99,3.67,18.58,3.67 c6.59,0,12.86-1.31,18.58-3.67c5.93-2.46,11.28-6.07,15.76-10.55c4.48-4.48,8.09-9.82,10.55-15.76c2.37-5.71,3.67-11.99,3.67-18.58 c0-6.59-1.31-12.86-3.67-18.58c-2.46-5.93-6.07-11.28-10.55-15.76c-4.48-4.48-9.83-8.09-15.76-10.55 c-5.71-2.37-11.99-3.67-18.58-3.67S48.58,14.19,42.86,16.55L42.86,16.55z"/></g></svg>
        </button>
    </div>
</div>
    <!-- <div>
        <h2 class="text-center mb-3">In Evidenza</h2>
        <div class="container-fluid grid_responsive_index" :class="(sortedArray.length > 0) ? 'py-5' : ''">
            
            <div class="hab-card card-cust" v-for="habitation in sortedArray" :key="habitation.id">
                <router-link class="text-dark" :to="{name: 'habitationDetails', params: { slug: habitation.slug} }">
                    <div class="wrapper"> -->
                        <!-- Cover -->
                        <!-- <div v-for="(image, i) in habitation.images" :key="image.id">
                            <img :src="'/storage/' + image.image_url" class="w-100" v-if="i === 0" height="350px"
                                :alt="'immagine di' + habitation.title">
                        </div> -->

                        <!-- Effetto hover con titolo, prezzo e max ospiti -->
                        <!-- <div class="data">
                            <div class="content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h2 class="title">{{habitation.title}}</h2> -->

                                    <!-- Corona Sponsorizzazione -->
                                    <!-- <div>
                                        <img src="/img/corona.png" alt="corona sponsor premium" width="30px" v-if="habitation.sponsorships[0].id == 3">
                                        <img src="/img/corona-silver.png" alt="corona sponsor medium" width="30px" v-else-if="habitation.sponsorships[0].id == 2">
                                        <img src="/img/corona-rame.png" alt="corona sponsor basic" width="30px" v-else-if="habitation.sponsorships[0].id == 1">
                                    </div>

                                </div>
                                <div class="text d-flex justify-content-between align-items-center">
                                    <p>
                                        <span>{{habitation.price}} €</span> /notte
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
    </div> -->

</template>


<script>
import axios from 'axios';

    export default {
        name: "HabitationsSponsored",

        components: {
        },

        data(){
            return{
                sponsoredHabs: [],

                // carousel 
                trackNext: false,
                trackPrev: false,
                carouselWidth: '',

            }
        },

        mounted () {
            this.getHabitation();
            
        },

        methods: {
            getHabitation() {
            axios.get(`http://127.0.0.1:8000/api/habitations/sponsor`)
                .then((res)=>{

                    this.sponsoredHabs = res.data.sponsoredHabs;
                    console.log(res.data.sponsoredHabs);

                    if (this.sponsoredHabs.length > 1) {
                        this.carouselWidth = this.$refs.carouselCustom.offsetWidth;
                        console.log(this.carouselWidth)
                    }

                })
                .catch(err => console.error('Impossibile caricare i dati', err))
            },

            next(){
                this.trackNext = true;

                // const track = this.$refs.track;

                // track.style.transform = `translateX(-${this.carouselWidth}px)`;
            },

            prev(){
                this.trackPrev = true;

                setTimeout(() => {
                    this.trackPrev = false
                }, 500);

                // const track = this.$refs.track;

                // track.style.transform = `translateX(-${0}px)`;
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

    }


</script>

<style lang="scss" scoped>

    .border-gold {
        border: 2px solid #f6d027;
    }

    .border-silver {
        border: 2px solid #96a5a6;
    }

    .border-rame {
        border: 2px solid #d16e23;
    }

    .carouselContainer {
        width: 1280px;

        // .carouselInner {

        // }

        .trackCust {
            transition: transform 0.5s;
        }

        .cardCust {
            flex-shrink: 0
            // width: ;
        }

        .navCust {
            button {
                top: 50%;
                transform: translateY(-50%);
            }

            .prevCust {
                left: -100px;
            }

            .nextCust {
                right: -100px;
            }
        }
    }
   
</style>