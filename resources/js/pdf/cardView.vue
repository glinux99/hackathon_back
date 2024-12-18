<template>
  <div>
    <div class="mx-10 d-flex flex-column">
      <div class="w-100 px-20 card my-5 py-8">
        <div class="d-flex justify-content-between my-5">
          <h3 class="stepper-title mb-5">Information sur le vehicule</h3>
          <div @click="generatePdf" class="btn btn-primary btn-sm me-3">
            <i class="ki-duotone ki-cloud-download fs-2"
              ><span class="path1"></span><span class="path2"></span
            ></i>

            Telecharger le ficher
          </div>
        </div>
        <div class="card rounded shadow-sm" id="print-content">
          <div class="h-10px bg-warning rounded rounded-bottom-0"></div>
          <div class="text-dark text-end me-5">{{ code }}</div>
          <div class="row text-white py-10">
            <div
              class="col-md-3 d-flex align-items-center justify-content-center"
            >
              <div
                class="image-input image-input-outline image-input-circle bg-secondary opacity-60 p-3"
              >
                <img alt="Logo" src="/assets/img/logo.png" class="h-50px" />
              </div>
            </div>

            <div
              class="col-md-7 border-start border-4 border-primary text-dark"
            >
              <h2 class="text-center">Police de Circulation Routiere</h2>
              <div class="my-10 ms-6">
                <div class="fw-bold">
                  {{ customer.name }} {{ customer.l_name }}
                </div>
                <div class="fw-bold text-muted fs-5 mb-2">
                  {{ customer.email }}
                </div>
                <div class="fw-bold fs-6 text-primary"># {{ car.plaque }}</div>
                <div class="fw-bold fs-6 text-primary">
                  {{ car.model }} / {{ car.marque }}
                </div>
              </div>
            </div>
            <div class="col-md-2 d-flex align-items-end">
              <div class="fw-bold fs-6 text-primary me-5">
                <QrcodeVue :value="code" :size="80" />
                <div class="min-h-10px" id="color"></div>
              </div>
            </div>
          </div>

          <div class="h-10px bg-warning rounded rounded-top-0"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { onMounted, ref } from "vue";
import QrcodeVue from "qrcode.vue";
// import VueHtml2pdf from "vue-html2pdf";
import html2pdf from "html2pdf.js";
import usePreview from "../services/previewservices.js";
export default {
  components: {
    QrcodeVue,
    // VueHtml2pdf,
  },
  setup() {
    const { getCardData, car, customer, code } = usePreview();
    onMounted(async () => {
      await callBackMounted();
    });
    const code_encoded = ref("");
    async function callBackMounted() {
      const href = location.href;

      const [protocol, hostname, port, pathname, search, hash] =
        href.split("/");
      await getCardData(search);
      document
        .getElementById("color")
        .style.setProperty("background-color", car.color);
      code_encoded.value = code;
    }
    return {
      car,
      code,
      customer,
      code_encoded,
    };
  },
  methods: {
    generatePdf() {
      var opt = {
        margin: 1,
        filename: "cardCustomer.pdf",
        image: { type: "jpeg", quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: "in", format: "a5", orientation: "landscape" },
      };
      // New Promise-based usage:
      //   html2pdf().set(opt).from(element).save();

      // Old monolithic-style usage:
      const element = document.getElementById("print-content");
      element.classList.add("border-1");
      element.classList.add("border-dashed");

      html2pdf(element, opt);
    },
  },
};
</script>

