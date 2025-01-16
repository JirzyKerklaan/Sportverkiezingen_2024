// Import
import { Navigation } from "./navigatie";
import { MouseFocus } from "./mouseFocus";
import Alpine from 'alpinejs'
import focus from '@alpinejs/focus'
import collapse from '@alpinejs/collapse'
import Splide from '@splidejs/splide';
import GLightbox from 'glightbox';

// AlpineJS
// @ts-ignore:next-line
window.Alpine = Alpine
Alpine.plugin(collapse)
Alpine.plugin(focus)
Alpine.start()

// Our import scripts that can run immediately
new MouseFocus();
new Navigation();

// Global get CSRF token function (used by forms).
// @ts-ignore:next-line
window.getToken = async () => {
    return await fetch('/!/DynamicToken/refresh')
        .then((res) => res.json())
        .then((data) => {
            return data.csrf_token
        })
        .catch(function (error) {
            this.error = 'Something went wrong. Please try again later.'
        })
}

// Global GLightbox initializer
// @ts-ignore:next-line
window.initializeLightbox = (id: string) => {
    const lightbox = GLightbox({
        touchNavigation: true,
        loop: true,
        autoplayVideos: true,
        selector: id,
    });
}

// Initialize all splide sliders
var sliders = document.getElementsByClassName( 'splide' );

for ( var i = 0; i < sliders.length; i++ ) {
  new Splide( sliders[ i ] ).mount();
}

