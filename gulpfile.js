var elixir = require('laravel-elixir');

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
    mix.sass('app.scss', 'public/assets/css/style.css');
    mix.scripts([
      'plugins/masonry.pkgd.min.js',
      'plugins/jquery.fancybox.js',
      'main.js'
    ], 'public/assets/js/main.js');
});
