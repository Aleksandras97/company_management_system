require('./bootstrap');


import App from './vue/App.vue';

import {createApp} from 'vue';


const app = createApp({});
app.component('App', App);
app.mount('#app')
