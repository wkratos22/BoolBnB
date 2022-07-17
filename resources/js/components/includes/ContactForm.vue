<template>

    <div>
        <h2 class="text-center">Contact area</h2>

        <Alert type="success" :message="this.alertMessage" v-if="sentMessage">

        </Alert>

        <form class="w-100" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name">* Nome</label>

                <input
                    type="text"
                    class="form-control shadow-none"
                    id="name"
                    placeholder="Inserisci il tuo nome"
                    v-model="form.name"
                    required>

                <!-- testo che spiega l'errore -->
                <small class="form-text text-danger">{{errors.name}}</small>
            </div>
                <div class="form-group">

                    <label for="email">* Email</label>

                    <input
                        type="email"
                        class="form-control shadow-none"
                        id="email"
                        placeholder="Enter email"
                        v-model="form.email"
                        required>

                    <!-- testo che spiega l'errore -->
                    <small class="form-text text-danger">{{errors.email}}</small>
                </div>

            <div class="form-group">
                <label for="message">* Messaggio</label>
                <textarea class="form-control shadow-none" v-model="form.message" id="message" rows="3" required></textarea>

                <!-- testo che spiega l'errore -->
                <small class="form-text text-danger">{{errors.message}}</small>
                <div class="mt-32 mb-32 text-center">
                    <button class="btn btn_outline_green shadow-none" @click.prevent="sendForm()">Invia</button>
                </div>
            </div>

        </form>
    </div>

</template>

<script>
import axios from 'axios';
import Alert from '../Alert.vue';

export default {
    name: 'ContactForm',

    components: {
        Alert
    },

    props: {
        userId: Number,
        habitationId: Number,
    },

    data() {
        return {
            form: {
                name: '',
                email: '',
                message: '',
                idUser: '',
                idHabitation: '',
            },

            errors: {
                name: null,
                email: null,
                message: null,
            },

            sentMessage: false,
            alertMessage: '',
        }
    },

    methods: {
        sendForm(){
            this.form.idUser = this.userId
            this.form.idHabitation = this.habitationId

            this.getErrors();

            axios.post('http://127.0.0.1:8000/api/messages', this.form)
            .then( (res) => {

                if (this.form.name && this.form.email && this.form.message && this.validEmail(this.form.email)) {
                    this.sentMessage = true

                    this.hideAlert();
                }

            })
            .then((res) => {
                this.form.name = ''
                this.form.email = '',
                this.form.message = '',
                this.alertMessage = 'Il messaggio è stato inviato con successo!'
            })
            .catch(err => console.error('Impossibile caricare i dati', err));


        },

        getErrors(){

            if (!this.form.name) {
                this.errors.name = "Il nome è obbligatorio!"
            }

            if (!this.validEmail(this.form.email)) {
                this.errors.email = "Inserisci un'email valida!"
            }

            if (!this.form.email) {
                this.errors.email = "L'email è obbligatoria!"
            }

            if (!this.form.message) {
                this.errors.message = "Inserisci il testo per contattare l'host!"
            }

            setTimeout(() => {
                this.errors.name = null
                this.errors.email = null
                this.errors.message = null
            }, 25000)
        },

        validEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },

        hideAlert(){
            setTimeout(() => {
                this.sentMessage = false;
            }, 5000);
        }
    },

    mounted(){
        console.log(this.$route);
    }
}

</script>

