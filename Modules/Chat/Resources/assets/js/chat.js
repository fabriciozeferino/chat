require('./bootstrap');


console.log('chat.js running')

import Vue from 'vue';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const chat = new Vue({
    el: '#chat',
    data: {
        messages: []
    },

    created() {
        this.fetchMessages();

        Echo.private('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user,
                    created_at: e.message.created_at,
                });
            });
    },

    methods: {

        fetchMessages() {

            axios.get('/messages').then(response => {
                this.messages = response.data;

                console.log(response.data);
            }).catch($err => {
                console.log($err);
            });
        },

        addMessage(message) {
            this.messages.push(message);

            axios.post('/message', message).then(response => {
                console.log(response.data);
            }).catch($err => {
                console.log($err);
            });
        }
    }
});
