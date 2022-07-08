<template>
    <div>


        <HabitationSponsored/>

        <!-- <h1 class="my-5 py-5 text-center">Sito in costruzione</h1> -->
        <HomeSearch/>

    </div>

</template>

<script>
import HabitationSponsored from "../habitations/HabitationSponsored.vue";
import HomeSearch from "../includes/HomeSearch.vue";


export default {
    name: 'HomePage',
     components: {
        HabitationSponsored,
         HomeSearch
    },


}
</script>

<style scoped>

</style>
