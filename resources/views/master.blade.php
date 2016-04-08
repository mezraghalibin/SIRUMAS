<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
  	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="author" href="humans.txt">
    <link rel="stylesheet" href="assets/css/master.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Josefin+Slab:600' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<!-- HEADER -->
	<nav class="navbar navbar-fixed-top shadow-nav">
    <div class="container-fluid">
      <div class="col-md-12 navbar-container">
        <div class="col-md-6 navbar-content">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">
              <img class="image-responsive" src="/images/FIA_UI.png" alt="Logo">
            </a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>                        
            </button>
          </div>
        </div>
        <div class="col-md-6">
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right menu">
              <li><a class="select" href="#">PORTAL</a></li>
              <li><a class="select" href="#">PESAN</a></li>
              <li><a class="select" href="#">LOGOUT</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>
	<!-- END OF HEADER -->

  <!-- SIDEBAR -->
  <div class="wrapper">
    <div class="sidebar-wrapper shadow-nav-side">
      <ul class="sidebar-nav sidebar-nav-top">
      	<li><a href="#" style="opacity:0">A</a></li>
        <li class="top-menu"><a href="#">BERANDA</a></li> <!-- ALL -->
        <li><a href="#">PANDUAN</a></li> <!-- Reviewer -->
        <li><a href="#">HIBAH</a></li> <!-- Staf Riset & Dosen -->
        <li><a href="#">PENGUMUMAN</a></li> <!-- Staf Riset -->
        <li><a href="#">PROPOSAL</a></li> <!-- Staf Riset -->
        <li><a href="#">PROPOSAL HIBAH</a></li> <!-- Staf Keuangan & Dosen-->
        <li><a href="#">LAPORAN</a></li> <!-- Dosen & Staf Riset & Reviewer -->
        <li><a href="#">KONTAK</a></li> <!-- Staf Riset -->
        <li><a href="#">MOU</a></li> <!-- Staf Riset -->
      </ul>
    </div>
  </div>  
  @yield('main_content')
</body>
</html>