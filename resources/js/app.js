/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: Axios } = require('axios');

require('./bootstrap');

window.Vue = require('vue');

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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});



// MY JS FUNCTIONS
const confirmationOverlay = document.getElementById('confirmation-overlay');
if (confirmationOverlay){
const confirmationForm = confirmationOverlay.querySelector('form');

document.querySelectorAll('.btn-delete').forEach(element=> {
    element.addEventListener('click', function(){
        confirmationOverlay.classList.remove('d-none');
        confirmationForm.action = confirmationForm.dataset.base + '/' + this.dataset.id;
    });
});
document.querySelector('.body').addEventListener('click', function() {
    confirmationForm.action = '';
    confirmationOverlay.classList.add('d-none');
});
}

const confirmationOverlay2 = document.getElementById('confirmation-overlay');
if (confirmationOverlay2){
const confirmationForm2 = confirmationOverlay2.querySelector('form');

document.querySelectorAll('.btn-delete').forEach(element=> {
    element.addEventListener('click', function(){
        confirmationOverlay2.classList.remove('d-none');
        confirmationForm2.action = confirmationForm2.dataset.base + '/' + this.dataset.id;
    });
});
document.querySelector('.body').addEventListener('click', function() {
    confirmationForm2.action = '';
    confirmationOverlay2.classList.add('d-none');
});
}


// FUNZIONE SLUG
const btnSlugger = document.querySelector('.btn-slugger');
if (btnSlugger) {
    btnSlugger.addEventListener('click', function() {
        const eleSlug = document.querySelector('#slug');
        const title = document.querySelector('#title').value;

        Axios.post('/admin/slugger', {
            originalString: title,
        })
            .then(function(response) {
                eleSlug.value = response.data.slug;
            })
    })
}