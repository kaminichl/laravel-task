require('./bootstrap');
 
window.Vue = require('vue');
import VueRouter from 'vue-router';
import StarRating from 'vue-star-rating'
import Datepicker from 'vuejs-datepicker';
import Multiselect from 'vue-multiselect'

window.Vue.config.devtools = true





window.Vue.use(VueRouter);

axios.defaults.headers.common['Content-Type'] = 'multipart/form-data'; // for all requests

 
import FilmsIndex from './components/frontend/FilmsIndex.vue';
import FilmCreate from './components/frontend/FilmCreate.vue';
import FilmEdit from './components/frontend/FilmEdit.vue';
import FilmView from './components/frontend/FilmView.vue';
import Comment from './components/frontend/Comment.vue';


window.Vue.component('star-rating', StarRating);
window.Vue.component('datepicker', Datepicker);
window.Vue.component('multiselect', Multiselect);





const routes = [
    {path: '/', component: FilmsIndex, name: 'index'},
    {path: '/film/create', component: FilmCreate, name: 'createFilm'},
    {path: '/film/edit/:slug', component: FilmEdit, name: 'editFilm'},
	{path: '/film/:slug', component: FilmView, name: 'viewFilm'},
	

];
 
const router = new VueRouter({ routes });
 
const app = new Vue({ router }).$mount('#wrapper')