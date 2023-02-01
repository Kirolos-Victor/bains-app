import './bootstrap';
import {createApp} from 'vue';


const app = createApp({});

import ApplicationPage from './sections/Application.vue';

app.component('application-page', ApplicationPage);

app.mount('#app');
