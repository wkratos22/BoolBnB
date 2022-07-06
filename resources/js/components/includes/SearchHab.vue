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
              minlength="2"
              v-model="destination"
            />
          </div>

          <!-- <div>
            <div>Per quante persone?</div>
            <div
              class="value-button"
              id="decrease"
              onclick="decreaseValue()"
              value="Decrease Value"

            ></div>
            <input type="number" v-model="guestsNumber" id="number" min="1" />
            <div
              class="value-button"
              id="increase"
              onclick="increaseValue()"
              value="Increase Value"
            ></div>
          </div> -->

          <form>
            <div class="form-group mb-0">
                <label for="formControlRange">Raggio di ricerca?</label>
                <input type="range" class="form-control-range" id="formControlRange" min="1000" max="500000" step="1000" value="20000" v-model="radius">
                {{radius / 1000}}km
            </div>
          </form>

            <button @click.prevent="getShow()" class="btn btn-secondary dropdown-toggle" type="button">
                Ulteriori Filtri
            </button>

            <div v-if="active" class="addFilters form-group position-absolute bg-dark py-5">
                <div class="w-75 mx-auto">

                  <form>
                      <div class="form-group my-4">
                          <input type="number" class="form-control" v-model="roomsNumber" min="1" max="99" placeholder="Numero minimo di stanze?">
                      </div>
                      <div class="form-group my-4">
                          <input type="number" class="form-control" v-model="bedsNumber" min="1" max="99" placeholder="Numero minimo di letti?">
                      </div>
                      <div class="form-check form-check-inline my-3">
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                              <label class="form-check-label" for="defaultCheck1">
                                  <!-- {{habitation.title}} -->
                              </label>
                      </div>
                  </form>
                </div>
            </div>

            <!-- <router-link class="btn btn-primary" :to="{ name: 'advancedSearch' }">Search</router-link > -->
            <button class="btn btn-primary" @click.prevent="getLocation()">Search</button >
        </form>
      </li>
</template>

<script>
import axios from 'axios';
export default {
    name: 'SearchHab',

    data(){
        return {
            destination: "",
            roomsNumber: "",
            bedsNumber: "",
            guestsNumber: "",
            radius: 20000,
            active: false,
            api_key: "oXUZAxmXyTAodB2lLDjVxMGJQhcbFGUl",
            latitudeSearch: "",
            longitudeSearch: "",
        }
    },

    methods: {
        // increaseValue() {
        // var value = parseInt(document.getElementById("number").value, 10);
        // value = isNaN(value) ? 0 : value;
        // value++;
        // document.getElementById("number").value = value;
        // },

        // decreaseValue() {
        // var value = parseInt(document.getElementById("number").value, 10);
        // value = isNaN(value) ? 0 : value;
        // value < 1 ? (value = 1) : "";
        // value--;

        // document.getElementById("number").value = value;
        // },

        getShow() {
            this.active = !this.active
        },

        getLocation() {

          let encodeLocation = encodeURI(this.destination);

          let url = `https://api.tomtom.com/search/2/search/${encodeLocation}.json?limit=5&radius=${this.radius}&minFuzzyLevel=1&maxFuzzyLevel=2&view=Unified&relatedPois=off&key=${this.api_key}`
          console.log(url)
          
            axios.get(url)
                  .then((res)=>{

                    let position = res.data.results[0].position;
                    this.latitudeSearch = position.lat;
                    this.longitudeSearch = position.lon;
                    console.log(this.latitudeSearch);
                    console.log(this.longitudeSearch);
                  })
                  .catch(err => console.error('Impossibile caricare i dati', err))

        }
  },

    mounted() {
      
    }
}
</script>

<style lang="scss" scoped>

  .searchContainer {
    width: 40%;
  }

  .addFilters{
    z-index: 9999;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    height: 60vh;
    width: 60vw;
  }

</style>
