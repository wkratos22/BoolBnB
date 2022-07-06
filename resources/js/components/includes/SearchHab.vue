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

          <!-- <div>
            <div>Numero minimo di stanze?</div>
            <div
              class="value-button"
              id="decrease"
              onclick="decreaseValue()"
              value="Decrease Value"

            ></div>
            <input type="number" v-model="roomsNumber" id="number" min="1" />
            <div
              class="value-button"
              id="increase"
              onclick="increaseValue()"
              value="Increase Value"
            ></div>
          </div> -->

          <!-- <div>
            <div>Numero minimo di letti?</div>
            <div
              class="value-button"
              id="decrease"
              onclick="decreaseValue()"
              value="Decrease Value"

            ></div>
            <input type="number" v-model="bedsNumber" id="number" min="1" />
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

          <!-- <div>
            <div>Che alloggio stai cercando?</div>
            <select class="custom-select" id="inputGroupSelect01">
              <option selected>Scegli il tipo di alloggio</option>
              <option value="1">Appartamento</option>
              <option value="2">Hotel</option>
              <option value="3">Casa</option>
              <option value="3">Pensione</option>
            </select>
          </div> -->


          <div class="mt-3">
            <div class="">
                <button @click="getShow()" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                    Filtri
                </button>
                <div v-if="active" class="form-group" aria-labelledby="dropdownMenuButton">
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
                                    {{habitation.title}}
                                </label>
                        </div>
                        <!-- <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    2
                                </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
                            <label class="form-check-label" for="inlineCheckbox3">3 (disabled)</label>
                        </div> -->
                    </form>
                </div>
            </div>
          </div>
          <router-link class="btn btn-primary" :to="{ name: 'advancedSearch' }">Search</router-link >
        </form>
      </li>
</template>

<script>
export default {
    name: 'SearchHab',

    data(){
        return {
            destination: "",
            roomsNumber: "",
            bedsNumber: "",
            guestsNumber: '',
            radius: '',
            active: false,
            api_key: "oXUZAxmXyTAodB2lLDjVxMGJQhcbFGUl",
            habitations: [],
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

        getHabitation() {
            console.log(encodeURIComponent(this.destination));
            axios.get(`https://api.tomtom.com/search/2/search/via%20roma.json?radius=20000&minFuzzyLevel=1&maxFuzzyLevel=2&view=Unified&relatedPois=off&key=${api_key}`)
                .then((res)=>{
                    this.habitations = res;
                })
        }
  },

    mounted() {

    }
}
</script>
