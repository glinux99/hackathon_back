// import './bootstrap';

import { createApp } from "vue/dist/vue.esm-bundler";
import Welcome from "./Welcome.vue";
import mapView from "./maps/mapView.vue";
import cardView from "./pdf/cardView.vue";
import QrcodeVue from "qrcode.vue";
const app = createApp({
    components: {
        // Welcome,
        mapView,
        cardView,
        QrcodeVue,
    },
});

// app.component("Welcome", Welcome);
app.mount("#app");
