<?php
  //CHECK USER'S ROLE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role']; 	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<!--CSS FOR MASTER DONT DELETE THIS -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/master.css') }}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
    <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import jQuery before materialize.js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
  <!--FOR MATERIALIZE DONT DELETE THIS-->

  {{-- SCRIPT OF JAVASCRIPT --}}
  <script>
  $(document).ready(function(){
    //CLEAR FLASH MESSAGE
    $("#clear").click(function(){
      $("#flash-msg").fadeOut(1000);
    });

    //DATE PICKER
    $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    $('.collapsible').collapsible({
      accordion : false
    });
  });
  </script>
  {{-- END OF JAVASCRIPT --}}
</head>

<body>
  {{-- HEADER --}}
  <div class="navbar-fixed">
	  <nav class="z-depth-0">
	    <div class="nav-wrapper">
	      <a href="#" class="brand-logo"><img class="responsive-img" src="/images/FIA_UI.png" alt="Logo"></a>
	      <ul class="right hide-on-med-and-down">
	        <li><a href="#">PORTAL</a></li>
	        <li><a id="pesan" href="{{action('PesanController@index')}}">PESAN</a></li>
	        <li><a href="{{action('SSOController@logout')}}">LOGOUT</a></li>
	      </ul>
	    </div>
	  </nav>
  </div>
  {{-- END OF HEADER --}}

  {{-- SIDEBAR MENU MASTER --}}
  {{-- SIDEBAR MENU FOR MAHSISWA --}}
  @if($spesifik_role == 'mahasiswa')
    <header>
      <ul class="side-nav fixed">
        <li><a href="{{action('BerandaController@index')}}" class="waves-effect waves-teal">BERANDA</a></li>
        <li><a href="#" class="waves-effect waves-teal">REPOSITORY</a></li>
      </ul>
    </header>
  @endif
  {{-- END OF SIDEBAR MENU FOR MAHSISWA --}}

  {{-- SIDEBAR MENU FOR DOSEN --}}    
  @if($spesifik_role == 'dosen')
    <header>
      <ul class="side-nav fixed">
        <li><a href="{{action('BerandaController@index')}}" class="waves-effect waves-teal">BERANDA</a></li>
        <li><a href="{{action('HibahController@index')}}" class="waves-effect waves-teal">HIBAH</a></li>
        <li><a href="{{action('ProposalController@index')}}" class="waves-effect waves-teal">PROPOSAL</a></li>
        <li><a href="{{action('LaporanController@index')}}" class="waves-effect waves-teal">LAPORAN</a></li>
        <li><a href="#" class="waves-effect waves-teal">REPOSITORY</a></li>
      </ul>
    </header>
  @endif
  {{-- END OF SIDEBAR MENU FOR DOSEN --}}

  {{-- SIDEBAR MENU FOR STAF DIVISI RISET --}}
  @if($spesifik_role == 'divisi riset')
  <header>
    <div class="side-bar">
      <ul class="collapsible" data-collapsible="accordion">      
        <li>
            <a href="{{action('BerandaController@index')}}" class="collapsible-header">
              <i class="material-icons">home</i>BERANDA
            </a>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">work</i>HIBAH</div>
          <div class="collapsible-body">
            <ul>
              <li><a href="/hibah/kelolahibah" class="waves-effect waves-teal">Kelola Hibah</a></li>
              <li><a href="/hibah/buathibah" class="waves-effect waves-teal">Buat Hibah</a></li>
            </ul>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">keyboard_voice</i>PENGUMUMAN</div>
          <div class="collapsible-body">
            <ul>
              <li><a href="#" class="waves-effect waves-teal">Kelola Pengumuman</a></li>
              <li><a href="#" class="waves-effect waves-teal">Buat Pengumuman</a></li>
            </ul>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">books</i>PROPOSAL HIBAH</div>
          <div class="collapsible-body">
            <ul>
              <li><a href="#" class="waves-effect waves-teal">Proposal Hibah Riset</a></li>
              <li><a href="#" class="waves-effect waves-teal">Proposal Hibah Pengmas</a></li>
            </ul>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">description</i>LAPORAN</div>
          <div class="collapsible-body">
            <ul>
              <li><a href="#" class="waves-effect waves-teal">Laporan Kemajuan</a></li>
              <li><a href="#" class="waves-effect waves-teal">Laporan Akhir</a></li>
            </ul>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">people</i>KONTAK</div>
          <div class="collapsible-body">
            <ul>
              <li><a href="/kontak/kelolakontak" class="waves-effect waves-teal">Kelola Kontak</a></li>
              <li><a href="/kontak/buatkontak" class="waves-effect waves-teal">Buat Kontak</a></li>
            </ul>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">assignment_turned_in</i>MoU</div>
          <div class="collapsible-body">
            <ul>
              <li><a href="#" class="waves-effect waves-teal">Arsip MoU</a></li>
              <li><a href="#" class="waves-effect waves-teal">Upload MoU</a></li>
            </ul>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">border_color</i>BORANG</div>
          <div class="collapsible-body">
            <ul>
              <li><a href="#" class="waves-effect waves-teal">Kelola Borang</a></li>
              <li><a href="#" class="waves-effect waves-teal">Buat Borang</a></li>
            </ul>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">desktop_windows</i>JADWAL PRESENTASI</div>
          <div class="collapsible-body">
            <ul>
              <li><a href="#" class="waves-effect waves-teal">Kelola Jadwal Presentasi</a></li>
              <li><a href="#" class="waves-effect waves-teal">Buat Jadwal Presentasi</a></li>
            </ul>
          </div>
        </li>
        <li>
          <a href="{{action('BerandaController@index')}}" class="collapsible-header">
            <i class="material-icons">folder</i>REPOSITORY
          </a>
        </li>
        <li>
          <a href="{{action('BerandaController@index')}}" class="collapsible-header">
            <i class="material-icons">build</i>KELOLA REPOSITORY
          </a>
        </li>
      </ul>
    </div>
  </header>
  @endif
  {{-- END OF SIDEBAR MENU FOR STAF DIVISI RISET --}}

  {{-- SIDEBAR MENU FOR STAF DIVISI KEUANGAN --}}
  @if($spesifik_role == 'divisi keuangan')
    <header>
      <ul class="side-nav fixed">
        <li><a href="{{action('BerandaController@index')}}" class="waves-effect waves-teal">BERANDA</a></li>
        <li><a href="{{action('ProposalHibahController@index')}}" class="waves-effect waves-teal">PROPOSAL HIBAH</a></li>
        <li><a href="#" class="waves-effect waves-teal">REPOSITORY</a></li>
      </ul>
    </header>
  @endif
  {{-- END OF SIDEBAR MENU FOR STAF DIVISI KEUANGAN --}}
  @yield('main_content')
</body>
</html>