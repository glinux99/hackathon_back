import axios from "axios";
import { reactive, ref } from "vue";

// import instance from "../api/index.js";
// import { useCookie } from "@vue-composable/cookie";
export default function usePreview() {
    const code = ref("");
    const car = reactive({});
    const customer = reactive({});
    const getCardData = async (id) => {
        await axios
            .get("/previewData/" + id)
            .then((resp) => {
                code.value = resp.data.code;
                const resp2 = resp.data.car;
                for (const [key, value] of Object.entries(resp2)) {
                    car[key] = value;
                }
                const resp3 = resp.data.customer;
                for (const [key, value] of Object.entries(resp3)) {
                    customer[key] = value;
                }
                console.log(resp.data);
            })
            .catch((errr) => {
                console.log(errr);
            });
    };
    return {
        getCardData,
        customer,
        code,
        car,
    };
}
