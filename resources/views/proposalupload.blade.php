@extends('master')

<?php 
  //CHECK USER'S ROLE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role']; 
?>


<!DOCTYPE html>
<html>
<head>
  <title>Proposal</title>
     <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/hibah.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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

      });
    </script>
</head>
<body>
  @section('main_content')
    <div class="page-content">
    {{-- SECOND NAVBAR --}}
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
            <li id="navbar-daftar-proposal"><a href='{{action('ProposalController@index')}}'>Back</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END of SECOND NAVBAR --}}

    {{-- CONTENT UPLOAD REVISI --}}
    <div class="container">
      <div id="upload-revisi">
        <div class="header"><h4>Upload Revisi Proposal Hibah</h4></div>
        <div class="revisi-content">
          <div class="row">
            <table class="highlight centered">
              <thead>
                <tr>
                  <th>Judul</th>
                  <th>Nama Hibah</th>
                  <th>Kategori</th>
                  <th>Created Date</th>
                  <th>Update Date</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @if (count($dataProposal))
                  @foreach ($dataProposal as $proposal)
                    <tr>
                      <td>{{ $proposal->judul_proposal }}</td>
                      <td>{{ $proposal->nama_hibah}}</td>
                      <td>{{ $proposal->kategori}}</td>
                      <td>{{ $proposal->created_at}}</td>
                      <td>{{ $proposal->updated_at}}</td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <div class="row">
            <form method="post" action="uploadrevisi/{{ $proposal->id }}" class="col s12" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <div class="row">
                <div class="file-field input-field col s6 offset-s3">
                  <div class="btn card-panel red darken-2">
                    <span class="white-text">File</span>
                    <input name="file" type="file">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Lampirkan file revisi">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="center-align">
                  <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action">
                    <span class="white-text">Submit</span><i class="material-icons right">send</i>
                  </button>  
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- END OF CONTENT UPLOAD REVISI --}}
    </div>
  @stop
</body>
</html>
