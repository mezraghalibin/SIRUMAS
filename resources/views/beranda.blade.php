@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>HIBAH</title>
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
    });
    </script>
</head>
<body>
  @section('main_content')
  <div class="page-content">
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
        </ul>
      </div>
    </nav>

    <!-- PENGUMUMAN -->
    <div class="container">
      <div class="row">
        <div class="col s8 offset-s2">
          <div class="pengumuman">
            <div id="title" class="title center-align"><h3>Pengumuman Hibah Riset UI 2015</h3></div>
            <div id="time" class="time center-align"><h6>Kamis, 5 April 2016</h6></div>
            <div id="content" class="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div> <br/>
            <a href="{{action('BerandaController@detailPengumuman')}}" class="btn waves-effect waves-light" name="action">Read More</a>
          </div>
        </div>
      </div>
    </div>
    <!-- END OF PENGUMUMAN -->

    <!-- SCRIPT FOR TRUNCATE -->
    <script>
      var textParse =  document.getElementById("content").innerHTML;
      document.getElementById("content").innerHTML = shorten(textParse, 1200);
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
