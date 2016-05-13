@extends('master')

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
  <title>LAPORAN</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/laporan.css') }}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
  <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--FOR MATERIALIZE DONT DELETE THIS-->

  <script>
    $(document).ready(function(){

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
          <li id="kemajuan"><a href="/laporan/readLaporanKemajuan">Laporan Kemajuan</a></li>
          <li id="akhir"><a href="/laporan/readLaporanAkhir">Laporan Akhir</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- CONTENT READ LAPORAN AKHIR --}}
    <div class="container">
      <div id="laporan-akhir">
        <div class="header"><h4>Laporan Akhir</h4></div>
        <div class="kemajuan-content">
          <table class="highlight centered">
            <thead>
              <tr>
                <th data-field="id">Judul Laporan</th>
                <th data-field="id">Hibah</th>
                <th data-field="name">Pengaju</th>
                <th data-field="price">Tanggal Submit</th>
                <th data-field="price">File</th>
              </tr>
            </thead>
            <tbody>
              @foreach($allAkhir as $akhir)
              <tr>
                <td>{{$akhir->judul}}</td>
                <td>{{$akhir->nama_hibah}}</td>                  
                <td>{{$akhir->nama}}</td>
                <td>{{$akhir->created_at}}</td>
                <td>
                  @if($akhir->file_akhir != "")
                    <a href="/upload/laporanakhir/{{$akhir->file_akhir}}">
                      <i class="material-icons">file_download</i>
                    </a>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{-- END OF READ LAPORAN AKHIR --}}
  </div>
  {{-- END OF PAGE CONTENT --}}
  @stop
</body>
</html>
