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
  <title>KELOLA PENGABDIAN MASYARAKAT</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/buku.css') }}">

  {{-- FOR MATERIALIZE DONT DELETE THIS --}}
  <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  {{-- FOR MATERIALIZE DONT DELETE THIS --}}

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
          <li id="kelola-pengmas"><a href="/kelolaRepository/pengmas/kelola">Kelola Pengabdian Masyarakat</a></li>
          <li id="buat-pengmas"><a href="/kelolaRepository/pengmas/buat">Buat Pengabdian Masyarakat</a></li>     
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


    {{-- CONTENT KELOLA PENGMAS --}}
    <div class="container">
      <div id="kelola-pengmas-konten">
        <div class="header"><h4>Kelola Pengabdian Masyarakat</h4></div>
        <div class="kelola-content">
          <table class="highlight centered">
            <thead> {{-- NAMA JUDUL DARI KELOLA HIBAH --}}
              <tr>
                <th data-field="nama_hibah" style="width:30%">Nama Kegiatan</th>
                <th data-field="kategori_hibah">Ketua Tim</th>
                <th data-field="besar_dana">Penyelenggara</th>
                <th data-field="periode">Peranan</th>
                <th data-field="periode">Waktu</th>
                <th data-field="periode">Tempat</th>
                <th data-field="" style="width:7%">Edit</th>
                <th data-field="" style="width:4%">Delete</th>
              </tr>
            </thead>
            @foreach($listofpengmas as $pengmas)
              <tbody>  {{-- ISI DARI TIAP HIBAH --}}
                <tr>
                  <td>{{ $pengmas->nama_kegiatan }}</td>
                  <td>{{ $pengmas->ketua }}</td>
                  <td>{{ $pengmas->penyelenggara }}</td>
                  <td>{{ $pengmas->peranan }}</td>
                  <td>{{ $pengmas->waktu }}</td>
                  <td>{{ $pengmas->tempat }}</td>
                  <td> {{-- BUTTON ICON UNTUK EDIT PENGMAS --}}
                    <a class="btn-floating" href="/kelolaRepository/pengmas/edit/{{$pengmas->id}}">
                    <i class="material-icons right">mode_edit</i></a>
                  </td>
                  <td> {{-- BUTTON ICON UNTUK HAPUS PENGMAS --}}
                    <!-- Modal Trigger -->
                    <button data-target="modal{{$pengmas->id}}" class="btn-floating btn modal-trigger">
                      <i class="material-icons right">delete</i>
                    </button>
                    <!-- Modal Structure -->
                    <div id="modal{{$pengmas->id}}" class="modal">
                      <div class="modal-content">
                        <h4>Hapus?</h4>
                        <p>Pengabdian Masyarakat {{ $pengmas->nama_kegiatan }} dihapus secara permanen</p>
                      </div>
                      <div class="modal-footer center-align">
                        <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                        <a href="/kelolaRepository/pengmas/delete/{{$pengmas->id}}" 
                          class="modal-action modal-close btn-flat">Ya</a>
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
    {{-- END OF CONTENT KELOLA PENGMAS --}} 
    <div align="center"> 
      {!! $listofpengmas->render() !!}
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
