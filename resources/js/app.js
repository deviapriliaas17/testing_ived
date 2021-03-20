/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



require('./bootstrap');
import vue from 'vue';
window.Vue = require('vue');
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import App from './components/App.vue';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueSweetalert2);

import Category from './components/category/index.vue';
import Blog from './components/blog/index.vue';
import BlogEdit from './components/blog/edit.vue';
import BlogCreate from './components/blog/create.vue';
import CategoryCreate from './components/category/create.vue';
import CategoryEdit from './components/category/edit.vue';
import BlogDetail from './components/blog/detail.vue';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [{
        name: 'category',
        path: '/category',
        component: Category
    }, {
        name: 'blog',
        path: '/blog',
        component: Blog,
    }, {
        name: 'blog-edit',
        path: '/blog/edit/:id',
        component: BlogEdit
    },
    {
        name: 'blog-create',
        path: '/blog/create',
        component: BlogCreate
    },
    {
        name: 'category-create',
        path: '/category/create',
        component: CategoryCreate
    },
    {
        name: 'category-edit',
        path: '/category/edit/ :id',
        component: CategoryEdit
    },
    {
        name: 'blog-detail',
        path: '/blog/ :id',
        component: BlogDetail
    }
]
const router = new VueRouter({
    mode: 'history',
    routes: routes
})
const app = new Vue(
    vue.util.extend({ router }, App)).$mount('#content');