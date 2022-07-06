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
          <div>
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
          </div>
          <div>
            <div>Che alloggio stai cercando?</div>
            <select class="custom-select" id="inputGroupSelect01">
              <option selected>Scegli il tipo di alloggio</option>
              <option value="1">Appartamento</option>
              <option value="2">Hotel</option>
              <option value="3">Casa</option>
              <option value="3">Pensione</option>
            </select>
          </div>
          <div class="mt-3">
          <router-link class="btn btn-primary" :to="{ name: 'advancedSearch' }">Search</router-link >
          </div>
        </form>
      </li>
</template>

<script>
export default {
    name: 'SearchHab',

    data(){
        return {
            destination: "",
            guestsNumber: null,
        }
    },

    methods: {
        increaseValue() {
        var value = parseInt(document.getElementById("number").value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById("number").value = value;
        },

        decreaseValue() {
        var value = parseInt(document.getElementById("number").value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? (value = 1) : "";
        value--;

        document.getElementById("number").value = value;
        },
  },
}
</script>