/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/header/Menu.vue').default);
Vue.component('topo', require('./components/header/Topo.vue').default);
Vue.component('topo-autenticado', require('./components/header/TopoAutenticado.vue').default);
Vue.component('menu-admin', require('./components/header/Menu.vue').default);
Vue.component('card', require('./components/CardGenerico.vue').default);
Vue.component('tabela-usuarios', require('./components/Tabelas/TabelaUsuarios.vue').default);

Vue.component('tabela-clientes', require('./components/Tabelas/TabelaCliente.vue').default);
Vue.component('tabela-titulos', require('./components/Tabelas/TabelaTitulos.vue').default);
Vue.component('tabela-problemas', require('./components/Tabelas/TabelaProblemas.vue').default);
Vue.component('tabela-faturamento', require('./components/Tabelas/TabelaFaturamento.vue').default);
Vue.component('tabela-faturamento-email', require('./components/Tabelas/TabelaFaturamentoEmails.vue').default);
Vue.component('tabela-status-visualizacao', require('./components/Tabelas/TabelaStatusVisualizacao.vue').default);

import JwPagination from 'jw-vue-pagination';
Vue.component('jw-pagination', JwPagination);

import Vuesax from 'vuesax';
Vue.use(Vuesax);


import { SweetModal, SweetModalTab } from "sweet-modal-vue";
Vue.component('sweet-modal', SweetModal);
Vue.component('sweet-tab', SweetModalTab);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
