<template>
  <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <router-link class="btn btn-primary" :to="{name: 'habitationDetails', params: { slug: habitation.slug} }">Vedi appartamento</router-link>
  </div>
</div>
</template>

<script>
export default {
    name: "AdvancedSearch"
}
</script>