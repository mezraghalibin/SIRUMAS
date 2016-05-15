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
  <title>KELOLA BUKU</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/buku.css') }}">

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
          <li id="kelola-buku"><a href="/kelolaRepository/buku/kelola">Kelola Buku</a></li>
          <li id="buat-buku"><a href="/kelolaRepository/buku/buat">Buat Buku</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- FLASH MESSAGE AFTER UPLOAD MOU --}}
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
    {{-- END OF FLASH MESSAGE AFTER UPLOAD MOU --}}

    {{-- CONTENT KELOLA BUKU --}}
    <div class="container">
      <div id="kelola-buku-konten">
        <div class="header"><h4>Kelola Buku</h4></div>
        <div class="kelola-content">
          <table class="highlight centered">
            <thead> {{-- NAMA JUDUL DARI KELOLA HIBAH --}}
              <tr>
                <th data-field="judul" style="width:30%">Judul</th>
                <th data-field="penulis">Penulis</th>
                <th data-field="penerbit">Penerbit</th>
                <th data-field="isbn">ISBN</th>
                <th data-field="" style="width:7%">Edit</th>
                <th data-field="" style="width:4%">Delete</th>
              </tr>
            </thead>

            <tbody>  {{-- ISI DARI TIAP HIBAH --}}
              @foreach ($dataBuku as $buku) 
                <tr>
                  <td>{{$buku->judul}}</td>
                  <td>{{$buku->penulis}}</td>
                  <td>{{$buku->penerbit}}</td>
                  <td>{{$buku->isbn}}</td>
                  <td> {{-- BUTTON ICON UNTUK EDIT HIBAH --}}
                    <a class="btn-floating" href="/kelolaRepository/buku/edit/{{$buku->id}}">
                    <i class="material-icons right">mode_edit</i></a>
                  </td>
                  <td> {{-- BUTTON ICON UNTUK HAPUS HIBAH --}}
                    <!-- Modal Trigger -->
                    <button data-target="modal{{$buku->id}}" class="btn-floating btn modal-trigger">
                      <i class="material-icons right">delete</i>
                    </button>
                    <!-- Modal Structure -->
                    <div id="modal{{$buku->id}}" class="modal">
                      <div class="modal-content">
                        <h4>Hapus {{$buku->judul}}?</h4>
                        <p>Buku ini akan dihapus secara permanen</p>
                      </div>
                      <div class="modal-footer center-align">
                        <a href="/kelolaRepository/buku/delete/{{$buku->id}}" class="modal-action modal-close btn-flat">Ya</a>
                        <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{-- END OF CONTENT KELOLA BUKU --}}
  </div>
  {{-- END OF PAGE CONTENT --}}

  <script>
    $(document).ready(function(){
      $('.materialboxed').materialbox();
      $('select').material_select();  //FOR FORM SELECT
      $('.modal-trigger').leanModal(); //FOR MODAL
    });
  </script>
  @stop
</body>
</html>
