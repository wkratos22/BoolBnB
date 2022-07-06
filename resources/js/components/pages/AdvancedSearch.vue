<template>
<div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 justify-content-center">
    <div class="card col m-3" v-for="habitation in habitations" :key="habitation.id">
        <img class="card-img-top" :src="require(`../../../../public/storage/${firstImage}`)" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{habitation.title}}</h5>
            <p class="card-text">{{habitation.address}}</p>
            <router-link class="btn btn-primary" :to="{name: 'habitationDetails', params: { slug: habitation.slug} }">Vedi appartamento</router-link>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import SearchHab from '../includes/SearchHab.vue'

export default {
    name: "AdvancedSearch",

    components: {
        SearchHab,
    },

    data() {
        return {
            habitations: [],
            firstImage: "",
        }
    },
    methods: {
        getHabitation() {
            axios.get(`http://127.0.0.1:8000/api/habitations`)
                .then((res)=>{
                    // console.log('STATUS CALL', res.data.habitations)
                    this.habitations = res.data.habitations


                    
                    this.habitations.forEach(element => {
                        let images = element.images
                        console.log(images)
               
                        if (images.length) { 
                            
                            
                            console.log('STATUS CALL', element.images[0].image_url)
                            this.firstImage = images[0].image_url
                        
                        }
                    });

                    // images = this.habitations.images[0]
                    console.log(images)

                })
        }
    },


    mounted() {
        this.getHabitation();
    }

}
</script>
