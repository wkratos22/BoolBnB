

<template>
  <div class="w-100 d-flex flex-column justify-content-center mb-5">

    <div class="d-flex justify-content-center display-flex-column align-items-center">
      <div class="form-group text-light text-center">
        <!-- <label for="destination">Dove vuoi andare?</label> -->
        <input class="form-control mr-sm-2" type="search" id="destination" placeholder="Dove vuoi andare?"
          aria-label="Search" minlength="3" v-model="positionInput.destination" />
      </div>


      <div class="form-group radiusGroup">
        <!-- <label for="formControlRange">Raggio di ricerca?</label> -->
        <input type="range" class="form-control-range" id="formControlRange" min="1000" max="500000" step="1000"
          value="20000" v-model="positionInput.radius">
      </div>

      <span class="text-light radiusValue">
        {{ positionInput.radius / 1000 }}km
      </span>

    </div>

      <router-link v-show="positionInput.destination.length >= 3" class="btn btn-primary align-self-center mt-4"
        role="button"
        :to="{ name: 'advancedSearch', params: { destination: positionInput.destination, radius: positionInput.radius, roomsNumber: positionInput.roomsNumber, bedsNumber: positionInput.bedsNumber, services: positionInput.checkedService }, }">
        Search
      </router-link>

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
  },
}
</script>

<style lang="scss" scoped>

.form-group {
  margin-bottom: 0;
}

.radiusGroup {
  margin: 0 1em;
  .form-control-range {
    width: 190px;
  }
}

@media screen and (min-width: 821px) {
  .radiusValue {
    min-width: 4em;
  }
}

@media screen and (min-width: 200px) and (max-width: 600px) {

  .radiusGroup {
    margin: 0;
    
    .form-control-range {
      margin: 1em 0;
    }
  }

  .display-flex-column {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
}

</style>