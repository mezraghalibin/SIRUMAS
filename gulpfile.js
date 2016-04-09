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
    mix.sass('app.scss');
});

elixir(function(mix) {
    mix.sass('master.scss', 'public/assets/css/master.css');
});

/*********** BERANDA ***********/
elixir(function(mix) {
    mix.sass('beranda.scss', 'public/assets/css/beranda.css');
});
elixir(function(mix) {
    mix.sass('detailPengumuman.scss', 'public/assets/css/detailPengumuman.css');
});

/*********** HIBAH *************/
elixir(function(mix) {
    mix.sass('hibah.scss', 'public/assets/css/hibah.css');
});
<<<<<<< HEAD

elixir(function(mix) {
    mix.sass('pesan.scss', 'public/assets/css/pesan.css');
=======
elixir(function(mix) {
    mix.sass('applyHibah.scss', 'public/assets/css/applyHibah.css');
});
elixir(function(mix) {
    mix.sass('kelolaHibah.scss', 'public/assets/css/kelolaHibah.css');
>>>>>>> 5c3c845585a794a0e47cd719064a79fb41c6fdb1
});