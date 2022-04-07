import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import VueApexCharts from 'vue-apexcharts';
import VueConfirmDialog from 'vue-confirm-dialog';
import { ValidationProvider, ValidationObserver, extend } from 'vee-validate/dist/vee-validate.full';
import IpAddressIndex from './pages/ip_address/IpAddressIndex';
import IpAddressForm from './pages/ip_address/IpAddressForm';

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueApexCharts);
Vue.use(VueConfirmDialog);
Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);
Vue.component('vue-confirm-dialog', VueConfirmDialog.default);
Vue.component('extend', extend);
Vue.component('apexchart', VueApexCharts);

// Customer Validator
extend('ip_address', {
    validate(value) {
        return /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(value);
    },
    message: 'The field must be a valid IP Address'
});

// Vue init
window.IpAddressManagementApp = new Vue({
    el: '#app',
    components: {
        IpAddressIndex,
        IpAddressForm
    },
    data() {
        return {
            showLoadingOverlay: false
        }
    }
});

