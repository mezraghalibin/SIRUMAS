<?php 
  //CHECK USER'S ROLE
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
    <link rel="stylesheet" href="assets/css/beranda.css">

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
        //DATE PICKER
        $('.datepicker').pickadate({
          selectMonths: true, // Creates a dropdown to control month
          selectYears: 15 // Creates a dropdown of 15 years to control year
        });

        //WRITE USER SPECIFICATION
        var name          = "<?php echo $name ?>";
        var role          = "<?php echo $role ?>";
        var spesifik_role = "<?php echo $spesifik_role ?>";
        document.getElementById("user").innerHTML = "Selamat Datang " + name + " - " + role + " | " + spesifik_role;
    });
    </script>
</head>
<body>
  @section('main_content')
  <div class="page-content">
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="right hide-on-med-and-down">
          <li><a id="user" href="#"></a></li>
        </ul>
      </div>
    </nav>

    @foreach($allPengumuman as $pengumuman)
    <!-- PENGUMUMAN -->
    <div class="container">
      <div class="row">
        <div class="col s8 offset-s2">
          <div class="pengumuman">
            <div id="title" class="title center-align"><h5>{{$pengumuman->judul}}</h5></div>
            <div id="time" class="time center-align"><h6>{{$pengumuman->created_at}}</h6></div>
            <div id="content{{$pengumuman->id}}" class="content">
              {{$pengumuman->konten}}
            </div>
            <a href="/detailpengumuman/{{$pengumuman->id}}" class="btn waves-effect waves-light card-panel red darken-2" name="action"><span class="white-text">Read More</span></a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    <!-- END OF PENGUMUMAN -->

    <!-- SCRIPT FOR TRUNCATE -->
    <script>
      var textParse =  document.getElementById("content{{$pengumuman->id}}").innerHTML;
      document.getElementById("content{{$pengumuman->id}}").innerHTML = shorten(textParse, 1200);
      function shorten(text, maxLength) {
        var ret = text;
        if (ret.length > maxLength) {
            ret = ret.substr(0,maxLength-3) + "...";
        }
        return ret;
      }
    </script>
    <!-- Script for truncate -->
    
  </div>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.js"></script>
  <script>
    $(document).ready(function() {
        $('select').material_select();
    });
  </script>
  @stop
</body>
</html>
