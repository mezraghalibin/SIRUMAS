@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>Proposal Hibah</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/proposalhibah.css">

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
        $("#daftar-proposal-riset").hide();
        $("#hibah-pengmas").hide();

        $("#navbar-hibah-riset").click(function(){
            $("#hibah-riset").fadeIn(500);
            $("#hibah-pengmas").hide();
        });

        $("#navbar-hibah-pengmas").click(function(){
            $("#hibah-pengmas").fadeIn(500);
            $("#hibah-riset").hide();
            $("#daftar-proposal-pengmas").hide();
        });

        $("#list-hibah-riset").click(function(){
            $("#daftar-proposal-riset").fadeIn(500);
        });

        $("#list-hibah-pengmas").click(function(){
            $("#daftar-proposal-pengmas").fadeIn(500);
        });

      });
    </script>
</head>
<body>
  @section('main_content')
  

  <!-- SECOND NAVBAR -->
    <div class="page-content">
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
            <li id="navbar-hibah-riset"><a href="#">Proposal Hibah Riset
            </a></li>
            <li id="navbar-hibah-pengmas"><a href="#">Proposal Hibah Pengmas
            </a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset
            </a></li>
        </ul>
        </div>
    </nav>
    <!-- END of SECOND NAVBAR -->

    <!-- CONTENT PROPOSAL HIBAH RISET -->
    <div class="container">
        <div id="hibah-riset">

        <!-- PILIH HIBAH -->
        <div class="header"><h4>Pilih Hibah Riset</h4></div>
        <div class="hibah-riset-content">
            <table id="list-hibah-riset" class="highlight centered">
            <tbody>
              <tr>
                <td>Hibah Riset 2015</td>
              </tr>
              <tr>
                <td>Hibah Riset 2014</td>
              </tr>
            </tbody>
          </table>
          </div>
        <!-- END of Pilih Hibah -->
 

        <!-- TABLE DAFTAR PROPOSAL-->
          <div id="daftar-proposal-riset">
          <div class="header"><h4>Daftar Proposal</h4></div>
          <div class="hibah-riset-content">
            <table class="highlight centered">
              <thead>
              <tr>
                <th>Judul</th>
                <th>Pengaju</th>
                <th>Tanggal Submit</th>
                <th>Hibah</th>                           
                <th>Nilai</th>
                <th>Penyesuaian</th>
                <th>Status</th>
                <th>File</th>
              </tr>
            </thead>
            <tbody>
              
              <tr>
                <td>Judul Proposal</td>
                <td>Sri Mulyani</td>
                <td>01/01/2015</td>
                <td>Hibah Riset UI 2015</td>
                <td>9</td>
                <td>Perlu Revisi</td>
                <td>Diterima</td>
                <td>File.pdf</td>
              </tr>
              <tr>
                <td>Judul Proposal</td>
                <td>Sri Mulyani</td>
                <td>01/01/2015</td>
                <td>Hibah Riset UI 2015</td>
                <td>
                  <a href='{{action('ProposalHibahController@nilaiProposal')}}'><button class="btn waves-effect waves-teal card-panel red darken-2"><span class="white-text">Nilai</span></button></a>
                </td>
                <td>
                  <a href='{{action('ProposalHibahController@sesuaikanProposal')}}'><button class="btn waves-effect waves-teal card-panel red darken-2"><span class="white-text">Sesuaikan</span></button></a>
                </td>
                <td>Menunggu Penilaian</td>
                <td>File.pdf</td>
              </tr>
            </tbody>
          </table>
          </div>
          <!-- END OF TABEL DAFTAR PROPOSAL -->
          </div>
        </div>
      </div>
      <!-- END OF PROPOSAL HIBAH RISET -->

      <!-- CONTENT PROPOSAL HIBAH PENGMAS -->
      <div class="container">
        <div id="hibah-pengmas">
            
        
       <!-- PILIH HIBAH -->
        <div class="header"><h4>Pilih Hibah Pengmas</h4></div>
        <div class="hibah-riset-content">
            <table id="list-hibah-pengmas" class="highlight centered">
            <tbody>
              <tr>
                <td>Hibah Pengmas 2015</td>
              </tr>
              <tr>
                <td>Hibah Pengmas 2014</td>
              </tr>
            </tbody>
          </table>
          </div>

        <!-- END of Pilih Hibah -->
 

        <!-- TABLE DAFTAR PROPOSAL-->
        <div id="daftar-proposal-pengmas">
          <div class="header">Daftar Proposal</div>
          <div class="hibah-riset-content">
            <table class="highlight centered">
              <thead>
              <tr>
                <th>Judul</th>
                <th>Pengaju</th>
                <th>Tanggal Submit</th>
                <th>Hibah</th>                           
                <th>Nilai</th>
                <th>Penyesuaian</th>
                <th>Status</th>
                <th>File</th>
              </tr>
            </thead>
            <tbody>
              
              <tr>
                <td>Judul Proposal</td>
                <td>Sri Mulyani</td>
                <td>01/01/2015</td>
                <td>Kemendikbud RI</td>
                <td>9</td>
                <td>Perlu Revisi</td>
                <td>Diterima</td>
                <td>File.pdf</td>
              </tr>
              <tr>
                <td>Judul Proposal</td>
                <td>Sri Mulyani</td>
                <td>01/01/2015</td>
                <td>Hibah Pengmas UI 2015</td>
                <td>
                  <a href='{{action('ProposalHibahController@nilaiProposal')}}'><button class="btn waves-effect waves-teal card-panel red darken-2"><span class="white-text">Nilai</span></button></a>
                </td>
                <td>
                <a href='{{action('ProposalHibahController@sesuaikanProposal')}}'>
                <button class="btn waves-effect waves-teal card-panel red darken-2"><span class="white-text">Sesuaikan</span></button></a>
                </td>
                <td>Menunggu Penilaian</td>
                <td>File.pdf</td>
              </tr>
            </tbody>
          </table>
          </div>
          </div>
          <!-- END OF TABEL DAFTAR PROPOSAL -->

              </div>
            </div>
          </div>
        </div>
      
      <!-- END OF CONTENT PROPOSAL HIBAH PENGMAS -->

  @stop
</body>
</html>
