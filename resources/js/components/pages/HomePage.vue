<template>
    <div>
        

        <HabitationSponsored/>


        <h1>Sito in costruzione</h1>


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
            axios.get("http://127.0.0.1:8000/api/habitations")
                .then((res)=>{
                    console.log(res.data.habitations)
                    this.habitations = res.data.habitations
                })
        }
    },

    
    mounted() {
        this.getHabitation();
    }


}
</script>
