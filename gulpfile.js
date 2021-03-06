const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss').version('css/app.css');
    //copie les font boostrap
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/css/fonts/bootstrap'); 
   	mix.webpack('app.js');
	mix.scripts([
		'walk.js',
	]);

});