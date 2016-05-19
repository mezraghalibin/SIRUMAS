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
  <title>UPLOAD LAPORAN AKHIR</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{URL::asset('assets/css/laporan.css')}}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
  <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--FOR MATERIALIZE DONT DELETE THIS-->
</head>
<body>
  @section('main_content')
  <div class="page-content">
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
        <li id="kemajuan"><a href="/laporan/laporanAkhir">Kembali</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>

    {{-- CONTENT UPLOAD LAPORAN AKHIR --}}
    <div class="container">
      <div id="laporan-kemajuan">
        <div class="header"><h4>Upload Laporan</h4></div>
        <div class="kemajuan-content">
          <table class="highlight centered">
            <thead>
              <th>Judul Proposal</th>
              <th>Judul Laporan Kemajuan</th>
            </thead>
              <tr>
                <td>{{ $laporanAkhir->judul }}</td>
                <td>{{ $laporanAkhir->judul_laporan_kemajuan }}</td>
              </tr>
          </table>
          <div class="upload-revisi-attach">
            <form class="" action="/laporan/uploadLaporanAkhir/upload/{{ $laporanAkhir->id }}" 
              method="post" enctype="multipart/form-data">
              <input type="hidden" name="tipe_progres" value="akhir">
              <input type="hidden" name="flag_akhir" value=1>
              <input type="hidden" name="flag_kemajuan" value=0>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="id_proposal" value="{{ $laporanAkhir->id_proposal }}">
              <input type="hidden" name="judul_laporan_kemajuan" value="{{ $laporanAkhir->judul_laporan_kemajuan }}">
              <input type="hidden" name="judul" value="{{ $laporanAkhir->judul }}">
              <input type="hidden" name="dosen" value="<?php echo $id ?>">
              <div class="row">
                <div class="input-field col s4">
                  <input placeholder="Judul Laporan Akhir" name="judul_laporan_akhir" type="text" class="validate">
                </div>
              </div>
              <div class="file-field input-field">
                <div class="btn card-panel red darken-2">
                  <span class="white-text">File</span>
                  <input name="file_akhir" type="file">
                  <input type="hidden" name="file_akhir" value="">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Upload laporan">
                </div>
              </div>
              <br>
              <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action"><span class="white-text">Ajukan Laporan</span> 
                <i class="material-icons right">send</i>
              </button>
            </form>
            <br>     
          </div>
        </div>
      </div>
    </div>
    {{-- END OF CONTENT UPLOAD LAPORAN AKHIR --}}
  </div>
  {{-- END OF PAGE CONTENT --}}
  @stop
</body>
</html>
