<template>

    <div class="container">
        <h2>Contact area</h2>

        <Alert type="success">

        </Alert>

        <form enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nome</label>

                <input
                        type="text"
                        class="form-control"
                        id="name"
                        placeholder="Inserisci il tuo nome"
                        v-model="form.name">


                <label for="email">Email address</label>

                <input
                        type="email"
                        class="form-control"
                        id="email"
                        placeholder="Enter email"
                        v-model="form.email">

            </div>
            <div class="form-group">
                <label for="message">Example textarea</label>
                <textarea class="form-control" v-model="form.message" id="message" rows="3">

                </textarea>
            </div>

            <button class="btn btn-primary" @click.prevent="sendForm()">Invia</button>
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
    },

    data() {
        return {
            form: {
                name: '',
                email: '',
                message: '',
                idUser: '',
            },
            alertMessage: '',
        }
    },

    methods: {
        sendForm(){
            this.form.idUser = this.userId
            axios.post('http://127.0.0.1:8000/api/messages', this.form)
            .then( (res) => {
                this.form.name = ''
                this.form.email = '',
                this.form.message = '',
                this.alertMessage = 'Il messaggio è stato inviato'
            });
        }
    },

    mounted(){
        console.log(this.$route);
        return this.userId
    }
}

</script>

