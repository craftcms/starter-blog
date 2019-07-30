/**
 * This file kicks off Webpack's tasks to minify and compile CSS and JS.
 */
import './styles/main.scss';
import './scripts/bootstrap-carousel';

/**
 * Bootstrap carousel standalone from https://codepen.io/derekjp/pen/QjmxdK
 */
$('.carousel').carousel({
    interval: 0
});
