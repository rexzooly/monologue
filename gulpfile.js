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

elixir(mix => {
    mix.less('monologue.less');

    mix.copy('resources/assets/img', 'public/img');
    mix.copy('resources/assets/fonts', 'public/monologue/fonts');

    mix.version([
    	'public/img/*.*',
    	'public/css/*.*'
    ], 'public/monologue');
});