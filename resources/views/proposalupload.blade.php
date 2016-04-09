@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>Proposal</title>
     <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/proposal.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
      $(document).ready(function(){
        $("#daftar-proposal").hide();

        $("#navbar-daftar-proposal").click(function(){
            $("#daftar-proposal").fadeIn(500);
            $("#upload-revisi").hide();
        });

        
      });
    </script>
</head>
<body>
  @section('main_content')
  <div class="wrapper">

  <!-- SECOND NAVBAR -->
    <div class="page-content">
      <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
            <li id="navbar-daftar-proposal"><a href='{{action('ProposalController@index')}}'>Back</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
        </ul>
      </div>
      </nav>
  <!-- END of SECOND NAVBAR -->

      <!-- CONTENT DAFTAR PROPOSAL -->
      <div class="container">
        <div id="daftar-proposal">

            <!-- TABLE DAFTAR PROPOSAL-->
              <div class="header">Daftar Proposal</div>
              <div class="daftar-proposal-content">
                <table class="highlight centered">
                  <thead>
                  <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tanggal Submit</th>
                    <th>Besar Dana</th>                          
                    <th>Status</th>
                    <th>File</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <tr>
                    <td>Judul Proposal</td>
                    <td>Riset</td>
                    <td>01/01/2015</td>
                    <td>Rp12.000.000</td>
                    <td>Menunggu Penilaian</td>
                    <td>File.pdf</td>
                  </tr>
                </tbody>
              </table>
              </div>
              <!-- END OF TABEL DAFTAR PROPOSAL -->
        </div>
      </div>
      <!-- END OF PROPOSAL HIBAH RISET -->

      <!-- CONTENT UPLOAD REVISI -->
      <div class="container">
        <div id="upload-revisi">
            <div class="header">Upload Revisi Proposal Hibah</div>
             
            <!--attach file -->
          <div class="upload-revisi-attach">

            <form action="#">
              <div class="file-field input-field">
                <div class="btn">
                  <span>File</span>
                  <input type="file">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Lampirkan file revisi">
                </div>
              </div>
            </form>
      

                 <button class="btn waves-effect waves-light" type="submit" name="action">Ajukan Proposal 
                 <i class="material-icons right">send</i>
                 </button>
                 </form>
          </div>
            <!--end of ajukan proposal -->
            </div>
          </div>
        </div>
      </div>
      

  @stop
</body>
</html>
