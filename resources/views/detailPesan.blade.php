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
  <title>Detail Pesan</title>
    <!--CSS FOR MASTER DONT DELETE THIS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="author" href="humans.txt">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/detailPesan.css') }}">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
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
        $("#buat-pesan").hide();
        $('select').material_select();

        $("#kelola").click(function(){
            $("#kelola-pesan").fadeIn(500);
            $("#buat-pesan").hide();
        });

        $("#buat").click(function(){
            $("#buat-pesan").fadeIn(500);
            $("#kelola-pesan").hide();
        });
      });
    </script>
</head>
<body>
  @section('main_content')
  {{-- PAGE CONTENT --}}
  <div class="page-content">
    {{-- SECOND NAVBAR --}}
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai <?php echo $username ?> - <?php echo $spesifik_role ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- DETAIL PESAN CONTENT --}}
    <div class="row">
      <div class="col s12">
        <div class="row">
          <div class="detailpesan col s8 offset-s4">
            <h4>Pesan</h4>
               <?php
                echo '<h5 class="left-align">Tanggal: '.$message->created_at.'</h5>';
                echo '<h5 class="left-align">Pengirim: '.$message->hasPengirim->nama.'</h5>';
                echo '<h5 class="left-align">Penerima: '.$message->hasPenerima->nama.'</h5>';
                echo '<h5 class="left-align">Subjek: '.$message->subjek.'</h5>';
                echo '<h5 class="left-align">Pesan: '.$message->pesan.'</h5>';
                if($message->file != null){
                  echo '<a href="/upload/pesan/'.$message->file.'">Unduh file</a>';
                }
              ?>  
          </div>
        </div>
      </div>
    </div>
    {{-- END OF DETAIL PESAN CONTENT --}}
  </div>
  {{-- END OF PAGE CONTENT --}}

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
@stop
</body>
</html>
