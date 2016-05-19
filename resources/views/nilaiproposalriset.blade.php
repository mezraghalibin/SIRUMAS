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
    <link rel="stylesheet" href="{{URL::asset('assets/css/nilaiproposal.css')}}">


    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
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
          <li id="navbar-hibah-riset"><a href="{{action('ProposalHibahController@index')}}">Kembali</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END of SECOND NAVBAR --}}

    <div class="container">
      <div class="header"><h5>Nilai Proposal</h5></div>
      @if(Session::has('flash_message'))
        <div class="card-panel red darken-2">
          <span class="white-text">{{ Session::get('flash_message') }}</span>
        </div>
      @endif
      {{-- display pdf --}}
      <div class="left-align">
        <object width="80%" height="500" data="/upload/proposal/{{$proposal->file}}"></object>
      </div>
      {{-- end display pdf --}}
      <div class="row"> 
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
          
          <form class="action" action="menilairiset/{{ $proposal->id }}" method="post">
            <div class="row">
            <div class="col s6">
            <p><?php echo $borang->komponen ?></p><input type="hidden" name="nama_komp[]" value="<?php echo $borang->komponen ?>" placeholder="Isi komponen" class="validate"></div>
            <div class="col s6"><select name="nilai[]" value="" class="browser-default validate" style="width:100px"><option disabled selected>Nilai</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select></div>
            <input type="hidden" name="id_proposal[]" value="{{$proposal->id}}" placeholder="Isi id proposal">
            <input type="hidden" name="staf_riset[]" value="<?php echo $id ?>">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
            <?php } ?>
            <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action" value="post"><span class="white-text">Simpan</span><i class="material-icons right">send</i>
            </button> 
          </form>
          </div>

          <div class="col s6">
            <br>

            <div class="sub-judul">
              <h5>Panduan Peniliaian</h5>
              <h6>Untuk Setiap Komponen Penilian</h6>
              <ul>
                <li>Range Nilai :</li>
                <li>1 - Sangat Buruk</li>
                <li>2 - Buruk</li>
                <li>3 - Cukup</li>
                <li>4 - Baik</li>
                <li>5 - Sangat Baik</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
   </div>
  
  @stop
</body>
</html>

