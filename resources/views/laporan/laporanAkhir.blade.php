<?php 
  //CHECK USER'S ROLE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role'];
?>

@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>LAPORAN</title>
  <link rel="author" href="humans.txt">
  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{URL::asset('assets/css/laporan.css')}}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
  <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--FOR MATERIALIZE DONT DELETE THIS-->
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <!--FOR MATERIALIZE DONT DELETE THIS-->
  <script>
    $(document).ready(function(){
      $('tr').click(function() {
        window.location = $(this).find('a').attr('href');
      }).hover( function() {
          $(this).toggleClass('hover');
        });

      //CLEAR FLASH MESSAGE
      $("#clear").click(function(){
        $("#flash-msg").fadeOut(1000);
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
        <ul class="left hide-on-med-and-down">
          <li id="upload-akhir"><a href="/laporan/uploadLaporanAkhir">Upload Laporan Akhir</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- CONTENT LAPORAN AKHIR --}}
    <div class="container">
      <div id="upload-laporan-kemajuan">
        <div class="header"><h4>Upload Laporan Akhir Berdasarkan Laporan Kemajuan</h4></div>
        <div id="flash-msg">
        @if(Session::has('flash_message'))
          <div class="card-panel red darken-2">
            <span class="white-text">
              {{ Session::get('flash_message') }}
              <a id="clear" class="btn-flat transparent right">
              <i class="material-icons">clear</i></a>
            </span>
          </div>
        @endif
        </div>
        <div class="kemajuan-content">
          <table class="highlight centered">
            <thead>
              <th>Judul Proposal</th>
              <th>Judul Laporan Kemajuan</th>
            </thead>    
            <tbody>
              @foreach($laporanKemajuan as $laporanKemajuan)
                <tr>
                  <td>{{ $laporanKemajuan->judul }}</td>
                  <td>{{ $laporanKemajuan->judul_laporan_kemajuan }}</td>
                  <td>
                    <a href="/laporan/uploadLaporanAkhir/{{$laporanKemajuan->id}}" class="button">
                    <button class="btn" type="submit" id="edit">Upload
                    </button>
                    </a>
                  </td>
                </tr>
              @endforeach              
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{-- END OF LAPORAN AKHIR --}}
  </div>
  {{-- END OF PAGE CONTENT --}}
  @stop
</body>
</html>
