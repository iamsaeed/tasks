window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
import Dashboard from "./components/Dashboard";

import { createApp } from "vue";

const app = createApp({
    components : {
        Dashboard
    }
}).mount("#app");
