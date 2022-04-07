console.log('Test Webpack');
import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import VueApexCharts from 'vue-apexcharts';
import VueConfirmDialog from 'vue-confirm-dialog';
import { ValidationProvider, ValidationObserver, extend } from 'vee-validate/dist/vee-validate.full';
import IpAddressIndex from './pages/ip_address/IpAddressIndex';

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueApexCharts);
Vue.use(VueConfirmDialog);
Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);
Vue.component('vue-confirm-dialog', VueConfirmDialog.default);
Vue.component('extend', extend);
Vue.component('apexchart', VueApexCharts);

// Vue init
window.IpAddressManagementApp = new Vue({
    el: '#app',
    components: {
        IpAddressIndex,
    },
    data() {
        return {
            showLoadingOverlay: false
        }
    }
});

