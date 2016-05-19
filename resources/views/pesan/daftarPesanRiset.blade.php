@extends('master')
<?php 
  //CHECK USER'S ROLE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role']; 
  $totalMessagge  = $_SESSION['countPesan'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>PESAN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="author" href="humans.txt">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/pesan.css') }}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
    <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
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
          <li id="kelola"><a href="/daftarPesanRiset">Daftar Pesan</a></li>
          <li id="buat"><a href="/pesan/buat">Buat Pesan</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}
    
    {{--  CONTENT DAFTAR PESAN --}}
    <div class="container">
      <div id="kelola-pesan">
        <div class="header"><h4>Daftar Pesan Terkirim</h4></div>
        <div id="flash-msg">
          @if(Session::has('flash_message'))
            <div class="card-panel teal darken-2">
              <span class="white-text">{{ Session::get('flash_message') }}</span>
              <a id="clear" class="collection-item" style="cursor:pointer">
              <i class="material-icons white right">clear</i></a>
            </div>
          @endif
        </div>
        <div class="kelola-content">
          <table class="highlight centered">
            <thead>
              <tr>
                <th>Tanggal Kirim</th>
                <th>Subjek Pesan</th>
                <th>Detail</th>
                <th>Opened</th>
              </tr>
            </thead>
            <tbody>
              @if (count($messages))
                @foreach ($messages as $message)
                  <tr>
                    <td>{{ $message->created_at }}</td>
                    <td>{{ $message->subjek }}</td>
                    <td>
                      <a class="btn-floating" href="/pesan/detailPesan/{{ $message->id }}">
                        <i class="material-icons">mail</i></a>
                    </td>
                    <td>
                      @if ( $message->isread == 1 )
                        <i class="material-icons center">done_all</i>
                      @elseif ($message->isread == 0 )
                        <i class="material-icons center">done</i>
                      @endif
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div align="center"> 
      {!! $messages->render() !!}
    </div>
    {{-- END OF CONTENT DAFTAR PESAN --}}
  </div>
  {{-- END OF PAGE CONTENT --}}
@stop
</body>
</html>
