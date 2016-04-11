@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>Proposal Hibah</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/nilaiproposal.css">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
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
        $("#daftar-proposal-riset").hide();
        $("#hibah-pengmas").hide();

        $("#navbar-hibah-riset").click(function(){
            $("#hibah-riset").fadeIn(500);
            $("#hibah-pengmas").hide();
        });

        $("#navbar-hibah-pengmas").click(function(){
            $("#hibah-pengmas").fadeIn(500);
            $("#hibah-riset").hide();
            $("#daftar-proposal-pengmas").hide();
        });

        $("#list-hibah-riset").click(function(){
            $("#daftar-proposal-riset").fadeIn(500);
        });

        $("#list-hibah-pengmas").click(function(){
            $("#daftar-proposal-pengmas").fadeIn(500);
        });

      });
    </script>
</head>
<body>
  @section('main_content')
  

  <!-- SECOND NAVBAR -->
    <div class="page-content">
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
            <li id="navbar-hibah-riset"><a href='{{action('ProposalHibahController@index')}}'>Proposal Hibah Riset
            </a></li>
            <li id="navbar-hibah-pengmas"><a href='{{action('ProposalHibahController@index')}}'>Proposal Hibah Pengmas
            </a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset
            </a></li>
        </ul>
        </div>
    </nav>
    
    <!-- END of SECOND NAVBAR -->

    <div class="container">
    <div class="header"><h4>Penyesuaian Dana Hibah Riset</h4></div>
     <!-- display pdf-->
     <div class="row">
     <div class="col s6">
      
      <embed src="test.pdf" width="100%" height="500px">
      
     </div>
     <!-- end display pdf-->

      <div class="col s6">
    
              Penyesuaian Dana
              <br>
               <textarea id="textarea1" class="materialize-textarea" length="120"></textarea>
            <label for="textarea1">Isi penyesuaian dana..</label>
            <br>
             <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action"><span class="white-text">Kirim</span>
                 <i class="material-icons right">send</i>
                 </button>
              
      </div>



      </div>   
      </div>
   </div>
   <div>
    <script>
    
    $(document).ready(function() {
      $('select').material_select();
    });
              
    </script></div>
  @stop
</body>
</html>
