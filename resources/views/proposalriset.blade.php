@extends('master')

<?php 
  //GET USER'S PROFILE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role']; 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Proposal Riset</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/proposalhibah.css')}}">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <!--FOR MATERIALIZE DONT DELETE THIS-->

    <!--FOR BOOTSTRAP DONT DELETE THIS-->
    <script>
      $(document).ready(function(){
       
      });
    </script>
</head>
<body>
  @section('main_content')
  {{-- PAGE CONTENT   --}}
  <div class="page-content">
    {{-- SECOND NAVBAR --}}
      <nav class="second-navbar">
        <div class="nav-wrapper">
          <ul class="left hide-on-med-and-down">
              <li id="navbar-hibah-riset"><a href="/proposalriset">Proposal Hibah Riset
              </a></li>
              <li id="navbar-hibah-pengmas"><a href="/proposalpengmas">Proposal Hibah Pengmas
              </a></li>
          </ul>
          <ul class="right hide-on-med-and-down">
              <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
          </ul>
          </div>
      </nav>
      <!-- END of SECOND NAVBAR -->

    <!-- CONTENT PROPOSAL HIBAH RISET -->
    <div class="container">
      <div id="hibah-riset">
      <!-- PILIH HIBAH -->
      <div class="header"><h4>Pilih Hibah Riset</h4></div>
        <div class="hibah-riset-content">
          <table id="list-hibah-riset" class="highlight centered">
            <tbody>
              @foreach ($dataHibahRiset as $hibah)
                @if ($hibah->kategori_hibah === 'Riset') 
                  <tr>
                    <td>{{ $hibah->nama_hibah }}</td>
                    <td>
                      <a href="/daftarproposalhibahriset/{{$hibah->id}}" class="btn card-panel teal darken-2">
                      <span class="white-text">Masuk</span></a>
                    </td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @stop
</body>
</html>
