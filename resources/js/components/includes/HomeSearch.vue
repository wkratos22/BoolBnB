<template>
    <li class="d-flex flex-nowrap searchContainer">
        
        <form class="w-100 d-flex justify-content-around align-items-center">
          <div class="form-group mb-0">
            <div></div>
            <label for="destination">Dove vuoi andare?</label>
            <input
              class="form-control mr-sm-2"
              type="search"
              id="destination"
              placeholder="Cerca località"
              aria-label="Search"
              minlength="3"
              v-model="positionInput.destination"
            />
          </div>

          <form>
            <div class="form-group mb-0">
                <label for="formControlRange">Raggio di ricerca?</label>
                <input type="range" class="form-control-range" id="formControlRange" min="1000" max="500000" step="1000" value="20000" v-model="positionInput.radius">
                {{positionInput.radius / 1000}}km
            </div>
          </form>

          <router-link class="btn btn-primary" :to="{ name: 'advancedSearch', params: { destination: positionInput.destination, radius: positionInput.radius, roomsNumber: positionInput.roomsNumber, bedsNumber: positionInput.bedsNumber, services: positionInput.checkedService },  }">
            Search
          </router-link >

        </form>
      </li>
</template>

<script>
export default {
    name: 'HomeSearch',

    data(){
        return {
            // active: false,

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

        // getShow() {
        //     this.active = !this.active
        // },

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

//   .searchContainer {
//     width: 40%;
//   }

  .addFilters{
    z-index: 9999;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    height: 60vh;
    width: 60vw;
  }

</style>
