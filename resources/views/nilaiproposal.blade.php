<?php 
  //CHECK USER'S ROLE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role'];
  //$id_proposal    = $_SESSION['id_proposal']; buat masukin id proposal
?>

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
    <div class="header"><h5>Nilai Proposal</h5></div>

     @if(Session::has('flash_message'))
        <div class="card-panel red darken-2">
          <span class="white-text">{{ Session::get('flash_message') }}</span>
        </div>

    @endif

  

     <!-- display pdf-->
     
      <div align="center">
      <embed src="test.pdf" width="100%" height="500px">
     </div>
     <!-- end display pdf-->
       
      <div class="col s6">
      <br>
      <div class="sub-judul"><h5>Borang Penilaian</h5></div>
      <div class="row">

      <br>
        <div class="col s6">
          <b>Komponen</b>
        </div>
        <div class="col s6">
          <b>Nilai</b>
        </div>
      </div>
      <hr>
        
        <?php foreach ($borangs as $borang) { ?>
        
        <form class="action" action="nilaiproposal" method="post">
          <div class="row">
          <div class="col s6">
          <p><?php echo $borang->komponen ?></p><input type="hidden" name="nama_komp[]" value="<?php echo $borang->komponen ?>" placeholder="Isi komponen" class="validate"></div>
          <div class="col s6"><select name="nilai[]" value="" class="browser-default validate" style="width:100px"><option disabled selected>Nilai</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option></select></div>
          <input type="hidden" name="id_proposal[]" value="1" placeholder="Isi id proposal">
          <input type="hidden" name="staf_riset[]" value="<?php echo $id ?>">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </div>
          <?php } ?>
          <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action" value="post"><span class="white-text">Simpan</span><i class="material-icons right">send</i>
          
        </form>
        </div>
         
      </div>
   </div>
  
  @stop
</body>
</html>

