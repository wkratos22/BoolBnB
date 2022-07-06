<template>
    <div>


        <HabitationSponsored/>


        <h1>Sito in costruzione</h1>

        <div class="m-3 d-flex" v-for="habitation in habitations" :key="habitation.id">
            <div>
                <h2>Titolo</h2>
                {{habitation.title}}
            </div>

            <div>
                <h2>Indirizzo</h2>
                {{habitation.address}}
            </div>

        </div>


    </div>

</template>

<script>

import HabitationSponsored from "../habitations/HabitationSponsored.vue";
import axios from 'axios';

export default {
    name: 'HomePage',
     components: {
        HabitationSponsored
    },

     data() {
        return {
            habitations: [],
        }
    },
    methods: {
        getHabitation() {
            axios.get(`http://127.0.0.1:8000/api/habitations`)
                .then((res)=>{
                    console.log('STATUS CALL', res.data.habitations)
                    this.habitations = res.data.habitations
                })
        }
    },


    mounted() {
        this.getHabitation();
    }


}
</script>
