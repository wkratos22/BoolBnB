<template>
    <div>
        <div class="w-50">

            <div class="position-relative" v-for="(image, index) in images" :key="index">
                <img :src="'/storage/' + image.image_url" class="w-100" :alt="'immagine di' + habitation.title" v-if="index == 0">

                <div class="text-center position-absolute habSquare p-1 bg-light rounded" v-if="index == 0">
                    <p class="text-dark font-weight-bold">
                        {{habitation.square_meters}} &#13217;
                    </p>

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

            <div class="text-center">
                <button class="btn btn-primary" @click="$router.back()">Torna alla ricerca</button>
            </div>
        </div>

        <div class="w-50">
            <!-- INSERIRE COMPONENTE MAPPA -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "HabitationDetails",

        data() {
            return {
                habitation: [],
                images: [],
                type: {},
                services: [],
                tags: [],
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
                    })
                    .catch((err) => {
                        console.log(err);
                        this.isError = true;
                    })
            }
        },

        mounted() {
            this.getHabitation();
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
</style>
