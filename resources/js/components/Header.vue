<template>
  <nav>
    <ul class="nav d-flex justify-content-between m-1">
      <li class="nav-item">
        <router-link class="navbar-brand" :to="{ name: 'home' }"
          >Home</router-link
        >
      </li>
      <li class="d-flex flex-nowrap">
        <form class="d-flex">
          <div>
            <div>Dove vuoi andare?</div>
            <input
              class="form-control mr-sm-2"
              type="search"
              placeholder="Cerca località"
              aria-label="Search"
            />
          </div>
          <div>
            <div>Per quante persone?</div>
            <div
              class="value-button"
              d="decrease"
              onclick="decreaseValue()"
              value="Decrease Value"
            ></div>
            <input type="number" id="number" min="1" />
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
      <li class="nav-item d-flex">
        <!--Button per diventare un'host(aggiungi abitazioni)-->
        <!-- <a class="nav-link m-1" href="/admin.habitations.create">Diventa un host</a> -->

        <!--Button per entrare nel back-end per l'utente loggato-->
        <a class="nav-link m-1" href="/admin">Passa alla modalità host</a>

        <a class="nav-link m-1" href="/register">Registrati</a>
        <a class="nav-link m-1" href="/login">Accedi</a>

        <!-- Dropdown sul button in alto a destra utente non loggato -->
        <!-- <div>
                    <a class="nav-link m-1" href="/login">Diventa un host</a>
                    <a class="nav-link m-1" href="/create">Proponi un'esperienza</a>
                    <a class="nav-link m-1" href="/help-page">Assistenza</a>
                </div> -->

        <!-- Dropdown sul button in alto a destra utente loggato -->
        <!-- <div>
                    <a class="nav-link m-1" href="/messages">Messaggi</a>
                    <a class="nav-link m-1" href="/messages">Notifiche</a>
                    <a class="nav-link m-1" href="/habitations">Viaggi</a>
                    <a class="nav-link m-1" href="/prefers">Preferiti</a>
                    <a class="nav-link m-1" href="/annunci">Gestisci gli annunci</a>
                    <a class="nav-link m-1" href="/condividi">Proponi un'esperienza</a>
                    <a class="nav-link m-1" href="/login">Account</a>
                    <a class="nav-link m-1" href="/help-page">Assistenza</a>
                    <a class="nav-link m-1" href="/logout">Esci</a>
                </div> -->
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "Header",

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
};
</script>
