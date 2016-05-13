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
    <link rel="stylesheet" href="{{ URL::asset('assets/css/proposal.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--FOR MATERIALIZE DONT DELETE THIS-->
    <script>
      $(document).ready(function(){
        $("#upload-revisi").hide();

        $("#navbar-daftar-proposal").click(function(){
            $("#daftar-proposal").fadeIn(500);
            $("#upload-revisi").hide();
        });

        $("#navbar-upload-revisi").click(function(){
            $("#upload-revisi").fadeIn(500);
            $("#daftar-proposal").hide();
        });

        //CLEAR FLASH MESSAGE
        $("#clear").click(function(){
          $("#flash-msg").fadeOut(1000);
        });
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
            <li id="navbar-daftar-proposal"><a href="#">Daftar Proposal</a></li>
            <li id="navbar-upload-revisi"><a href="#">Upload Revisi Proposal</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END of SECOND NAVBAR --}}

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

    {{-- CONTENT DAFTAR PROPOSAL --}}
    <div class="container">
      <div id="daftar-proposal">
        <!-- TABLE DAFTAR PROPOSAL-->
        <div class="header"><h4>Daftar Proposal</h4></div>
        <div class="daftar-proposal-content">
          <table class="highlight centered">
            <thead>
              <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tanggal Submit</th>
                <th>Nama Hibah</th>                          
                <th>Status</th>
                <th>File</th>
              </tr>
            </thead>
            <tbody>
              @if (count($dataProposal))
                @foreach ($dataProposal as $proposal)
                  <tr>
                    <td>{{ $proposal->judul_proposal }}</td>
                    <td>{{ $proposal->kategori}}</td>
                    <td>{{ $proposal->created_at}}</td>
                    <td>{{ $proposal->nama_hibah}}</td>
                    <td>{{ $proposal->status }}</td>
                    <td>{{ $proposal->file}}</td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
        <!-- END OF TABEL DAFTAR PROPOSAL -->
      </div>
    </div>
    {{-- END OF PROPOSAL HIBAH RISET --}}

    {{-- CONTENT UPLOAD REVISI --}}
    <div class="container">
      <div id="upload-revisi">
        <div class="header"><h4>Upload Revisi Proposal Hibah</h4></div>
        <div class="upload-revisi-content">
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
                    <td> {{-- BUTTON ICON UNTUK EDIT PROPOSAL --}}
                      <a class="btn-floating" href="/proposalupload/{{$proposal->id}}">
                      <i class="material-icons right">mode_edit</i></a>
                    </td> 
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{-- END OF CONTENT UPLOAD REVISI --}}
  </div>
  @stop
</body>
</html>
