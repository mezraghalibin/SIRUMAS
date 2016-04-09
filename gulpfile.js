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
    mix.sass('pengumuman.scss', 'public/assets/css/pengumuman.css');
});

=======
>>>>>>> c3935214254484df199d5e1e34c92f087456637e
elixir(function(mix) {
    mix.sass('applyHibah.scss', 'public/assets/css/applyHibah.css');
});
elixir(function(mix) {
    mix.sass('kelolaHibah.scss', 'public/assets/css/kelolaHibah.css');
});

/*********** PROPOSAL *************/
elixir(function(mix) {
    mix.sass('proposal.scss', 'public/assets/css/proposal.css');
});

/*********** PROPOSAL HIBAH *************/
elixir(function(mix) {
    mix.sass('proposalhibah.scss', 'public/assets/css/proposalhibah.css');
});
elixir(function(mix) {
    mix.sass('nilaiproposal.scss', 'public/assets/css/nilaiproposal.css');
});
elixir(function(mix) {
    mix.sass('sesuaikanproposal.scss', 'public/assets/css/sesuaikanproposal.css');
});

/*********** PESAN & MOU ***********/
elixir(function(mix) {
    mix.sass('pesan.scss', 'public/assets/css/pesan.css');
<<<<<<< HEAD
});

elixir(function(mix) {
    mix.sass('applyHibah.scss', 'public/assets/css/applyHibah.css');
});
elixir(function(mix) {
    mix.sass('kelolaHibah.scss', 'public/assets/css/kelolaHibah.css');

});
=======
});
>>>>>>> c3935214254484df199d5e1e34c92f087456637e

