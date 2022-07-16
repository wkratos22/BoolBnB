<template>
    <li class="d-flex flex-nowrap searchContainer">
        <form class="w-100 d-flex justify-content-around align-items-center">
            <div class="form-group mb-0">
                <div></div>
                <label for="destination">Dove vuoi andare?</label>
                <input class="form-control mr-sm-2" type="search" id="destination" placeholder="Cerca località"
                    aria-label="Search" minlength="3" v-model="positionInput.destination" />
            </div>

            <form>
                <div class="form-group mb-0">
                    <label for="formControlRange">Raggio di ricerca?</label>
                    <input type="range" class="form-control-range" id="formControlRange" min="1000" max="500000"
                        step="1000" value="20000" v-model="positionInput.radius">
                    {{positionInput.radius / 1000}}km
                </div>
            </form>

            <button @click.prevent="getShow()" class="btn btn-secondary dropdown-toggle" type="button">
                Ulteriori Filtri
            </button>

            <div v-if="active" class="addFilters form-group position-absolute bg-dark py-5">
                <div class="container">

                    <!-- gruppo input ULTERIORI FILTRI -->
                    <form>
                        <!-- numero minimo di stanze -->
                        <div class="form-group my-4">
                            <label class="text-light" for="roomsNumber">Numero minimo di stanze</label>
                            <input type="number" class="form-control" id="roomsNumber"
                                v-model="positionInput.roomsNumber" min="1" max="99">
                        </div>

                        <!-- numero minimo di letti -->
                        <div class="form-group my-4">
                            <label class="text-light" for="bedsNumber">Numero minimo di letti</label>
                            <input type="number" class="form-control" id="bedsNumber" v-model="positionInput.bedsNumber"
                                min="1" max="99">
                        </div>

                        <!-- checkboxes per servzi obbligatori -->
                        <h3 class="text-light text-center mb-4">Servizi presenti nella struttura:</h3>
                        <div class="form-group row row-cols-2 row-cols-md-3 row-cols-xl-4 m-0">
                            <div class="form-check col flex-column justify-content-center my-2 w-25"
                                v-for="service in services" :key="service.id">
                                <input class="form-check-input mr-0" type="checkbox" :value="service.id"
                                    :id="'service-'+service.id" v-model="positionInput.checkedService">
                                <label class="form-check-label text-light" :for="'service-'+service.id">
                                    {{service.label}}
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <button class="btn btn-primary">
                Search
            </button>

        </form>
    </li>
</template>

<script>


  export default {

    name: 'SearchHab',


    data() {
          return {
              active: false,

              api_key: "oXUZAxmXyTAodB2lLDjVxMGJQhcbFGUl",

              positionInput: {
                  destination: "",
                  radius: 20000,
                  roomsNumber: 1,
                  bedsNumber: 1,
                  checkedService: [],
              },

              services: [],

              habitations: [],
          }
    },

    methods: {
      getShow() {
          this.active = !this.active
      },

        getServices() {
          axios.get('http://127.0.0.1:8000/api/services')
              .then((res) => {
                  console.log(res.data)
                  this.services = res.data.services;
              })
              .catch(err => console.error('Impossibile caricare i dati', err))
        },

      getFilteredLocation() {
        if (this.positionInput.destination != "" && this.positionInput.destination != null && this.positionInput
              .destination != undefined) {
              let encodeLocation = encodeURI(this.positionInput.destination);

              let url =
                  `https://api.tomtom.com/search/2/search/${encodeLocation}.json?limit=5&radius=${this.positionInput.radius}&minFuzzyLevel=1&maxFuzzyLevel=2&view=Unified&relatedPois=off&key=${this.api_key}`

              axios.get(url)
                  .then((res) => {
                      let position = res.data.results[0].position;

                      let latitude = position.lat
                      let longitude = position.lon

                      if (latitude != null && latitude != undefined && longitude != null && longitude != null) {
                          this.sendQuery(latitude, longitude, this.positionInput.radius, this.positionInput.bedsNumber, this.positionInput.roomsNumber, this.positionInput.checkedService);
                      }
                  })
                  .catch(err => console.error('Impossibile caricare i dati', err))
        }
      },

      sendQuery(latitudine, longitudine, radius, minBeds, minRooms, services){
        axios.get('http://127.0.0.1:8000/api/search?lat=' + latitudine + '&lon=' + longitudine +
                '&radius=' + radius + '&minBeds=' + minBeds + '&minRooms=' + minRooms + '&services=' +
                services)
            .then((res) => {
                this.habitations = res.data.filteredHab
                console.log('chiamata api SEARCH', this.habitations)

            })
            .catch(err => console.error('Impossibile caricare i dati', err))
      }
    },

    mounted() {
      this.getServices();
    },

  }

</script>

<style lang="scss" scoped>
    .searchContainer {
        width: 40%;
    }

    .addFilters {
        z-index: 9999;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        height: 60vh;
        width: 60vw;
    }

</style>
