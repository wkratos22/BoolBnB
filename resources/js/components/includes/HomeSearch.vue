<template>
    <div class="w-100 d-flex flex-column justify-content-center">
        
        <form class="d-flex justify-content-center align-items-center">
          <div class="form-group mb-0 text-light text-center">
            <!-- <label for="destination">Dove vuoi andare?</label> -->
            <input
              class="form-control mr-sm-2"
              type="search"
              id="destination"
              placeholder="Dove vuoi andare?"
              aria-label="Search"
              minlength="3"
              v-model="positionInput.destination"
            />
          </div>


          <div class="form-group mb-0 ml-4 mr-2">
            <!-- <label for="formControlRange">Raggio di ricerca?</label> -->
            <input type="range" class="form-control-range" id="formControlRange" min="1000" max="500000" step="1000" value="20000" v-model="positionInput.radius">
          </div>

          <span class="text-light radiusValue">
            {{positionInput.radius / 1000}}km
          </span>

        </form>

          <router-link class="btn btn-primary align-self-center mt-3" :to="{ name: 'advancedSearch', params: { destination: positionInput.destination, radius: positionInput.radius, roomsNumber: positionInput.roomsNumber, bedsNumber: positionInput.bedsNumber, services: positionInput.checkedService },  }">
            Search
          </router-link >

      </div>
</template>

<script>
export default {
    name: 'HomeSearch',

    data(){
        return {
            positionInput: {
              destination: "",
              radius: 20000,
              latitude: "",
              longitude:"",
              roomsNumber: 1,
              bedsNumber: 1,
              checkedService: []
            },
        }
    },

    methods: {

        getLocation() {

          let encodeLocation = encodeURI(this.destination);

          let url = `https://api.tomtom.com/search/2/search/${encodeLocation}.json?limit=5&radius=${this.radius}&minFuzzyLevel=1&maxFuzzyLevel=2&view=Unified&relatedPois=off&key=${this.api_key}`
          console.log(url)


              axios.get(url)
                    .then((res)=>{
                      let position = res.data.results[0].position;
                      this.positionInput.latitude = position.lat
                      this.positionInput.longitude = position.lon
                      this.$emit('search', this.positionInput);
                    })
                    .catch(err => console.error('Impossibile caricare i dati', err))

        },


  },

}
</script>

<style lang="scss" scoped>

.radiusValue {
  min-width: 4em;
}

</style>
