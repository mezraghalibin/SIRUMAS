@extends('master')

<?php 
  //GET USER'S PROFILE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role']; 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Proposal Hibah</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/proposalhibah.css')}}">

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

</head>
<body>
  @section('main_content')

  <!-- SECOND NAVBAR -->
    <div class="page-content">
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
            <li id="navbar-hibah-riset"><a href='{{action('ProposalHibahController@index')}}'>Kembali
            </a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset
            </a></li>
        </ul>
        </div>
    </nav>
    <!-- END of SECOND NAVBAR -->

    <div class="container">    
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
              
                @foreach ($AllProposal as $proposal)
              <tr>
                <td>{{ $proposal->judul_proposal }}</td>
                <td>{{ $proposal->nama_pengaju}}</td>
                <td>{{ $proposal->created_at}}</td>
                <td>{{ $proposal->nama_hibah}}</td>
                <td><a href='{{action('ProposalHibahController@nilaiProposal')}}'><button class="btn waves-effect waves-teal card-panel red darken-2"><span class="white-text">Nilai</span></button></a></td>
                <td><a href='{{action('ProposalHibahController@sesuaikanProposal')}}'><button class="btn waves-effect waves-teal card-panel red darken-2"><span class="white-text">Sesuaikan</span></button></a></td>
                <td>{{ $proposal->status }}</td>
                <td>{{ $proposal->file}}</td>
              </tr>
              <!-- <tr>
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
               -->@endforeach
            </tbody>
          </table>
          </div>
          <!-- END OF TABEL DAFTAR PROPOSAL -->
          </div>
      </div>

      <!-- END OF PROPOSAL HIBAH RISET -->

  @stop
</body>
</html>
