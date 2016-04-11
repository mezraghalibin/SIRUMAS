<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
  	<!--CSS FOR MASTER DONT DELETE THIS -->
    <link rel="stylesheet" href="assets/css/master.css">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
    <!--FOR MATERIALIZE DONT DELETE THIS-->

    <!--FOR BOOTSTRAP DONT DELETE THIS-->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Josefin+Slab:600' rel='stylesheet' type='text/css'>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!--FOR BOOTSTRAP DONT DELETE THIS-->
    <script>
    //js code
      $(document).ready(function(){
         $(".button-collapse").sideNav();
         $('.collapsible').collapsible();
      });
    </script>
</head>
<body>
<!-- HEADER -->
  <div class="navbar-fixed">
  <nav class="z-depth-0">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo"><img class="responsive-img" src="/images/FIA_UI.png" alt="Logo"></a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">PORTAL</a></li>
        <li><a href="{{action('PesanController@index')}}">PESAN</a></li>
        <li><a href="{{action('SSOController@logout')}}">LOGOUT</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="#">PORTAL</a></li>
        <li><a href="#">PESAN</a></li>
        <li><a href="#">LOGOUT</a></li>
      </ul>
    </div>
  </nav>
  </div>

  <header>
    <ul id="nav-mobile" class="side-nav fixed">
      <li><a href="{{action('BerandaController@index')}}" class="waves-effect waves-teal">BERANDA</a></li>
      <li><a href="#" class="waves-effect waves-teal">PANDUAN</a></li>
      <li><a href="{{action('HibahController@index')}}" class="waves-effect waves-teal">HIBAH</a></li>
      <li><a href="{{action('PengumumanController@index')}}" class="waves-effect waves-teal">PENGUMUMAN</a></li>
      <li><a href="{{action('ProposalController@index')}}" class="waves-effect waves-teal">PROPOSAL</a></li>
      <li><a href="{{action('ProposalHibahController@index')}}" class="waves-effect waves-teal">PROPOSAL HIBAH</a></li>
      <li><a href="{{action('LaporanController@index')}}" class="waves-effect waves-teal">LAPORAN</a></li>
      <li><a href="#" class="waves-effect waves-teal">KONTAK</a></li>
      <li><a href="{{action('MouController@index')}}" class="waves-effect waves-teal">MOU</a></li>
      <li><a href="{{action('BorangController@index')}}" class="waves-effect waves-teal">BORANG</a></li>
      <li><a href="#" class="waves-effect waves-teal">REPOSITORY</a></li>
      <li><a href="#" class="waves-effect waves-teal">KELOLA REPOSITORY</a></li>
    </ul>
  </header>
  @yield('main_content')
</body>
</html>