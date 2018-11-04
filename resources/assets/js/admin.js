require('./bootstrap');
 
window.Vue = require('vue');
import VueRouter from 'vue-router';
import StarRating from 'vue-star-rating'
import Datepicker from 'vuejs-datepicker';
import Multiselect from 'vue-multiselect'

window.Vue.config.devtools = true





window.Vue.use(VueRouter);

axios.defaults.headers.common['Content-Type'] = 'multipart/form-data'; // for all requests




import BackendFilmsIndex from './components/backend/BackendFilmsIndex.vue';
import BackendFilmCreate from './components/backend/BackendFilmCreate.vue';
import BackendFilmEdit from './components/backend/BackendFilmEdit.vue';
import BackendFilmView from './components/backend/BackendFilmView.vue';


window.Vue.component('star-rating', StarRating);
window.Vue.component('datepicker', Datepicker);
window.Vue.component('multiselect', Multiselect);





const routes = [

	{path: '/', component: BackendFilmsIndex, name: 'backendindex'},
    {path: '/film/create', component: BackendFilmCreate, name: 'backendcreateFilm'},
    {path: '/film/edit/:slug', component: BackendFilmEdit, name: 'backendeditFilm'},
	{path: '/film/:slug', component: BackendFilmView, name: 'backendviewFilm'},
	
];
 
const router = new VueRouter({ routes });
 
const app = new Vue({ router }).$mount('#wrapper')