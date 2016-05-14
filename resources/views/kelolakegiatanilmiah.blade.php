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
  <title>KELOLA KEGIATAN ILMIAH</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/publikasi.css">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script>
    $(document).ready(function(){
      });
    }
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
          <li id="kelola-kegiatan-ilmiah"><a href="{{action('KegiatanIlmiahController@kelola')}}">Kelola Kegiatan Ilmiah</a></li>
          <li id="buat-kegiatan-ilmiah"><a href="{{action('KegiatanIlmiahController@buat')}}">Buat Kegiatan Ilmiah</a></li>     
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- FLASH MESSAGE --}}
    <div id="flash-msg">
      @if(Session::has('flash_message'))
        <div class="card-panel teal">
          <span class="white-text">
            {{ Session::get('flash_message') }}<a id="clear" class="btn-flat transparent right">
            <i class="material-icons">clear</i></a>
          </span>
        </div>
      @endif 
    </div>
    {{-- END OF FLASH MESSAGE --}}


    {{-- CONTENT KELOLA HIBAH --}}
    <div class="container">
      <div id="kelola-kegiatan-ilmiah-konten">
        <div class="header"><h4>Kelola Kegiatan Ilmiah</h4></div>
        <div class="kelola-content">
          <table class="highlight centered">
            <thead> {{-- NAMA JUDUL DARI KELOLA HIBAH --}}
              <tr>
                  <th style="width:30%">Nama Kegiatan</th>
                  <th>Jenis Kegiatan</th>
                  <th>Pembicara</th>
                  <th>Waktu</th>
                  <th>Tempat</th>
                  <th style="width:7%">Edit</th>
                  <th style="width:4%">Delete</th>
              </tr>
            </thead>
            @foreach($kegiatanilmiahs as $kegiatanilmiah)
            <tbody>  {{-- ISI DARI TIAP HIBAH --}}
                  <tr>
                    <td>{{ $kegiatanilmiah->nama }}</td>
                    <td>{{ $kegiatanilmiah->jenis }}</td>
                    <td>{{ $kegiatanilmiah->pembicara }}</td>
                    <td>{{ $kegiatanilmiah->waktu }}</td>
                    <td>{{ $kegiatanilmiah->tempat }}</td>
                    <td> {{-- BUTTON ICON UNTUK EDIT HIBAH --}}
                      <a class="btn-floating" href="/editkegiatanilmiah/{{$kegiatanilmiah->id}}">
                      <i class="material-icons right">mode_edit</i></a>
                    </td>
                    <td> {{-- BUTTON ICON UNTUK HAPUS HIBAH --}}
                      <!-- Modal Trigger -->
                      <button data-target="modal{{$kegiatanilmiah->id}}" class="btn-floating btn modal-trigger">
                        <i class="material-icons right">delete</i>
                      </button>
                      <!-- Modal Structure -->
                      <div id="modal{{$kegiatanilmiah->id}}" class="modal">
                        <div class="modal-content">
                          <h4>Hapus?</h4>
                          <p>Kegiatan ilmiah akan dihapus secara permanen</p>
                        </div>
                        <div class="modal-footer center-align">
                          <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                          <a href="/hapuskegilmiah/{{$kegiatanilmiah->id}}" class="modal-action modal-close btn-flat">Ya</a>
                        </div>
                      </div>
                    </td>
                  </tr>
            </tbody>
            @endforeach
          </table>
        </div>
      </div>
    </div>
    {{-- END OF CONTENT KELOLA KEGiATAN ILMIAH --}} 

    <div align="center"> 
    {!! $kegiatanilmiahs->links() !!}
    </div>

  </div>
  {{-- END OF PAGE CONTENT --}}
     <script>
      $(document).ready(function() {
        $('.modal-trigger').leanModal();
      });
    </script>
  @stop
</body>
</html>
