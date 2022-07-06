<template>
    <li class="d-flex flex-nowrap">
        <form class="d-flex">
          <div>
            <div>Dove vuoi andare?</div>
            <input
              class="form-control mr-sm-2"
              type="search"
              placeholder="Cerca località"
              aria-label="Search"
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
            <div class="form-group">
                <label for="formControlRange">Raggio di ricerca?</label>
                <input type="range" class="form-control-range" id="formControlRange" min="1000" max="50000" step="1000" value="20000" v-model="radius">
                {{radius / 1000}}km
            </div>
          </form>

          <div class="mt-3">
            <div class="">
                <button @click.prevent="getShow()" class="btn btn-secondary dropdown-toggle" type="button">
                    Filtri
                </button>
                <div v-if="active" class="form-group">
                    <form>
                        <div class="form-group">
                            <input type="number" class="form-control" v-model="roomsNumber" placeholder="Numero minimo di stanze?">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" v-model="bedsNumber" placeholder="Numero minimo di letti?">
                        </div>
                        <label for="tags">Attributi</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    <!-- {{habitation.title}} -->
                                </label>
                        </div>
                    </form>
                </div>
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
