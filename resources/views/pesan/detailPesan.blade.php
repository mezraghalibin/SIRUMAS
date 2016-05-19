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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
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
          @if ($spesifik_role == "divisi riset")
            <li id="kembali"><a href="/daftarPesanRiset">Kembali</a></li>
          @elseif ($spesifik_role == "dosen")
            <li id="kembali"><a href="/daftarPesanDosen">Kembali</a></li>
          @endif
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- DETAIL PESAN CONTENT --}}
    <div class="row">
      <div class="col s12">
        <div class="row">
          <h4>Detail Pesan</h4>
          <div class="detailpesan">
            <div class="col s4">
              <table class="centered">
                @if ( $spesifik_role == "divisi riset")
                  <thead><tr><th data-field="waktu">Waktu Kirim</th></tr></thead>
                @elseif ( $spesifik_role == "dosen")
                  <thead><tr><th data-field="waktu">Waktu Terima</th></tr></thead>
                @endif
                <tbody><tr><td id="besar_dana">{{ $message->created_at }}</td></tr></tbody>
              </table>
            </div>
            <div class="col s4">
              <table class="centered">
                <thead><tr><th data-field="pengirim">Pengirim</th></tr></thead> 
                <tbody><tr><td>{{ $message->hasPengirim->nama }}</td></tr></tbody>
              </table>
            </div>
            <div class="col s4">
              <table class="centered">
                <thead><tr><th data-field="penerima">Penerima</th></tr></thead>
                <tbody><tr><td>{{ $message->hasPenerima->nama }}</td></tr></tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="isi-pesan col s8">
            <h6>Subjek : </h6>{{ $message->subjek }} <br>
            <h6>Pesan  : <br></h6>
            {{ $message->pesan }} <br>
            <p></p>
            Lampiran :
            @if ($message->file != null)
              <a href="../upload/pesan/{{ $message->file }}">{{ $message->file }}</a>
            @endif
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
