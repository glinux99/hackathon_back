// import './bootstrap';

import { createApp } from "vue/dist/vue.esm-bundler";
import Welcome from "./Welcome.vue";
import mapView from "./maps/mapView.vue";
import cardView from "./pdf/cardView.vue";
import QrcodeVue from "qrcode.vue";
const app = createApp({});

app.component("cardView", cardView).default;
app.component("mapView", mapView);
app.component("QrcodeVue", QrcodeVue);
app.component("Welcome", Welcome);
app.mount("#app");
