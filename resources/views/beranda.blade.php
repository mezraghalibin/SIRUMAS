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
  <title>HOME</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/beranda.css') }}">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
    <!--FOR MATERIALIZE DONT DELETE THIS-->

    <script>
    $(document).ready(function(){
      //DATE PICKER
      $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
      });
    });
    </script>
</head>
<body>
  @section('main_content')
  <div class="page-content">
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="right hide-on-med-and-down">
          <li><a id="user" href="#"><?php echo "Selamat Datang $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>

    @foreach($allPengumuman as $pengumuman)
    <!-- PENGUMUMAN -->
    <div class="container">
      <div class="row">
        <div class="col s8 offset-s2">
          <div class="pengumuman">
            <div id="title" class="title center-align"><h5>{{ $pengumuman->judul }}</h5></div>
            <div id="created_by" class="time center-align"><h6>By {{ $pengumuman->nama }}</h6></div>
            <div id="time" class="time center-align"><h6>{{ $pengumuman->created_at }}</h6></div>
            <div id="content{{$pengumuman->id}}" class="content">
              {{ $pengumuman->konten }}
            </div>
            <a href="/detailpengumuman/{{$pengumuman->id}}" class="btn waves-effect waves-light card-panel red darken-2" name="action"><span class="white-text">Read More</span></a>
          </div>
        </div>
      </div>
    </div>
    <!-- END OF PENGUMUMAN -->

    <!-- SCRIPT FOR TRUNCATE -->
    <script>
      var textParse = document.getElementById("content{{ $pengumuman->id }}").innerHTML;
      document.getElementById("content{{ $pengumuman->id }}").innerHTML = shorten(textParse, 1200);
      function shorten(text, maxLength) {
        var ret = text;
        if (ret.length > maxLength) {
          ret = ret.substr(0,maxLength-3) + "...";
        }
        return ret;
      }
    </script>
    <!-- Script for truncate -->
    @endforeach
    
  </div>
  <script>
    $(document).ready(function() {
        $('select').material_select();
    });
  </script>
  @stop
</body>
</html>
