require('./bootstrap');

require('./lib/bootstrap');
require('./lib/slinky');
fileinput = require('bootstrap-fileinput');

require('datatables.net-dt');
require('select2');
$('.select2').select2({
	width: '100%'
});

// var pace = require('./lib/pace');
// pace.start();

// window.Vue = require('vue');
//
// Vue.component('select2', require('./components/Select2Component.vue').default);
// Vue.component('service-price-component', require('./components/ServicePriceComponent.vue').default);
// Vue.component('create-order-component', require('./components/CreateOrderComponent.vue').default);
//
// const app = new Vue({
//     el: '#app'
// });


require('./admin/layout_setup')
require('./shared/data-table')
require('./shared/fileinput')
