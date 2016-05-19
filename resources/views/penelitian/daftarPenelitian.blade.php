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
  <title>KELOLA PENELITIAN</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/penelitian.css') }}">

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
          <li id="kelola-penelitian"><a href="/kelolaRepository/penelitian/kelola">Kelola Penelitian</a></li>
          <li id="buat-penelitian"><a href="/kelolaRepository/penelitian/buat">Buat Penelitian</a></li>    
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- FLASH MESSAGE AFTER --}}
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

    {{-- CONTENT KELOLA PENELITIAN --}}
    <div class="container">
      <div id="kelola-penelitian-konten">
        <div class="header"><h4>Penelitian</h4></div>
        <div class="kelola-content">
          <table class="highlight centered">
            <thead>
              <tr>
                <th data-field="judul_penelitian" style="width:30%">Judul Penelitian</th>
                <th data-field="ketua_peneliti">Ketua Penelitian</th>
                <th data-field="sumber_dana">Sumber Dana</th>
                <th data-field="besar_dana">Besar Dana</th>
              </tr>
            </thead>

            <tbody>  {{-- ISI DARI TIAP PENELITIAN --}}
              @foreach ($dataPenelitian as $penelitian) 
                <tr>
                  <td>{{ $penelitian->judul }}</td>
                  <td>{{ $penelitian->ketua }}</td>
                  <td>{{ $penelitian->sumber_dana }}</td>
                  <td>{{ $penelitian->besar_dana }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{-- END OF KELOLA PENELITIAN --}}
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
