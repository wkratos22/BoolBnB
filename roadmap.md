##Creazione database

    1. creazione della migration 
    2. creazione del model 
    3. creazione del controller 
    4. collegamento del file env 

#relazioni tra tabelle

    1. fare la relazione tra user aprtments 
    2. fatre la relazione tra aprtments ur services
    3. fare la relazione tra user e ur payments
    4. fare la relazione tra ur payment e sponsorship
    5. fare la relazione tra apartments e statistics 
    6. fare la relazione tra apartments e messagges


#Creazione rotte

    1. creazione delle rotte auth
    2. creazione delle rotte guest
    3. creazione cartelle nella view (guest, admin)
    4. modificare il routeservice provider in config (home con admin)
    5. creare la crud 


#vue

    1. creare la cartella guest con all'interno il file home
    2. richiamare l'id root 
    3. creare il file front.js
    4. rinominare il file example in app.vue
    5. scrivere in front.js 
    window.Vue = require('vue');

    import Vue from 'vue';
    import App from './components/App.vue';

    const root = new Vue({
        el: '#root',
        render: h => h(App);
    })
    6. compilare webpackmix 
    .js('resources/js/front.js', 'public/js')
    
    7. inserire lo script di front.js in home.blade.php 
    <script src=" {{asset('js/front.js')}}"></script>

#strutturare i componenti

    1. creare cartella pages in component 
    2. 

