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
    <script>
      $(document).ready(function(){
        $("#hibah-pengmas").hide();

        $("#navbar-hibah-riset").click(function(){
            $("#hibah-riset").fadeIn(500);
            $("#hibah-pengmas").hide();
        });

        $("#navbar-hibah-pengmas").click(function(){
            $("#hibah-pengmas").fadeIn(500);
            $("#hibah-riset").hide();
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
            @foreach ($dataHibah as $hibah)
             @if ($hibah->kategori_hibah === 'Riset') 
              <tr>
                    <td><a href="/daftarproposalhibahriset/{{$hibah->id}}" >{{ $hibah->nama_hibah }}</a></td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
       </div>
     </div>
          
        <!-- END of Pilih Hibah -->

            
        <div class="container">
        <div id="hibah-pengmas">
       <!-- PILIH HIBAH -->
        <div class="header"><h4>Pilih Hibah Pengmas</h4></div>
        <div class="hibah-riset-content">
            <table id="list-hibah-pengmas" class="highlight centered">
            <tbody>
            @foreach ($dataHibah as $hibah)
            @if ($hibah->kategori_hibah === 'Pengmas') 
              <tr>
                    <td><a href="/daftarproposalhibahpengmas/{{$hibah->id}}" >{{ $hibah->nama_hibah }}</a></td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
          </div>
        </div>
        </div>
        <!-- END of Pilih Hibah -->
 

  @stop
</body>
</html>
