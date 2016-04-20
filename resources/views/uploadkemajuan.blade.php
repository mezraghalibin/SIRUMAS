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
  <title>LAPORAN</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/hibah.css') }}">

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
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script>
    $(document).ready(function(){

    });
    </script>
</head>
<body>
  @section('main_content')
  <div class="page-content">
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
          <li id="kemajuan"><a href="{{action('LaporanController@index')}}">Kembali</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>

    <!-- CONTENT LAPORAN kemajuan -->
    <div class="container">
      <div id="laporan-kemajuan">
        <div class="header"><h4>Upload Laporan</h4></div>
          <div class="kemajuan-content">
          <table>
              <thead>
                  <th>Judul Proposal</th>
                  <th>Kategori</th>
                  <th>Status</th>
              </thead>

         
                  <tr>
                      <td>{{ $proposal->judul_proposal }}</td>
                      <td>{{ $proposal->kategori }}</td>
                      <td>{{ $proposal->status }}</td>
                  </tr>
              
          </table>
          <div class="upload-revisi-attach">

           <form class="" action="uploadprogress/{{ $proposal->id }}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id_proposal" value="{{ $proposal->id }}">
              <input type="hidden" name="tipe_progres" value="kemajuan">
              <input type="hidden" name="judul" value="{{ $proposal->judul_proposal }}">
              <input type="hidden" name="dosen" value="<?php echo $id ?>">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="file-field input-field">
                <div class="btn card-panel red darken-2">
                  <span class="white-text">File</span>
                  <input name="file" type="file" multiple>
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Upload laporan">
                </div>
              </div>
              <br>
               <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action"><span class="white-text">Ajukan Laporan</span> 
                 <i class="material-icons right">send</i>
                 </button>
            </form>
            <br>

                 
          </div>
          </div>
      </div>
    </div>
      <!-- END OF CONTENT LAPORAN kemajuan -->
  </div>

  @stop
</body>
</html>
