import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import HomePage from './components/pages/HomePage.vue';
import AdvancedSearch from './components/pages/AdvancedSearch.vue';
import HabitationDetails from './components/pages/HabitationDetails.vue';
import ContactForm from './components/includes/ContactForm.vue';
import NotFoundPage from './components/pages/NotFoundPage.vue';





const router = new VueRouter({

    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        { path: '/', component: HomePage, name: 'home' },
        { path: '/habitations', component: AdvancedSearch, name: 'advancedSearch' },
        { path: '/habitations/:slug', component: HabitationDetails, name: 'habitationDetails' },
        // { path: '/messages', component: ContactForm, name: 'contacts'},
        { path: '*', component: NotFoundPage, name: 'notFound' }
    ]


});

export default router;
