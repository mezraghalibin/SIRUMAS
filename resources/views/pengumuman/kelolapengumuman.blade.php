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
  <title>PENGUMUMAN</title>
    <link rel="author" href="humans.txt">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/pengumuman.css') }}">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import jQuery before materialize.js-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <!--FOR MATERIALIZE DONT DELETE THIS-->

    <script>
      $(document).ready(function(){
        //CLEAR FLASH MESSAGE
        $("#clear").click(function(){
          $("#flash-msg").fadeOut(1000);
        });
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
            @if($spesifik_role == 'divisi riset')
              <li id="kelola"><a href="/pengumuman/kelolapengumuman">Kelola Pengumuman</a></li>
              <li id="buat"><a href="/pengumuman/buatpengumuman">Buat Pengumuman</a></li>
            @endif
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END of SECOND NAVBAR --}}

    {{-- CONTENT KELOLA PENGUMUMAN --}}
    <div class="container">        
      <div id="kelola-pengumuman">
        <div class="header"><h4>Kelola Pengumuman</h4></div>
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
                <th>Judul</th>
                <th>Nomor</th>
                <th>Kategori</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th style="width:7%">Detail</th>
                <th style="width:7%">Edit</th>
                <th style="width:7%">Delete</th>
                <th style="width:4%">Publish</th>
              </tr>
            </thead>
            <tbody>
              @foreach($allPengumuman as $pengumuman)
                <tr>
                  <td>{{$pengumuman->judul}}</td>
                  <td>{{$pengumuman->nomor}}</td>
                  <td>{{$pengumuman->kategori}}</td>
                  <td>{{$pengumuman->created_at}}</td>
                  <td>{{$pengumuman->updated_at}}</td>
                  <td>
                    {{-- MODAL DETAIL PENGUMUMAN --}}
                    <button data-target="modal{{$pengumuman->id}}detail" class="btn-floating btn modal-trigger">
                      <i class="material-icons right">info</i>
                    </button>
                    {{-- MODAL STRUCTURE DETAIL PENGUMUMAN --}}
                    <div id="modal{{$pengumuman->id}}detail" class="modal modal-fixed-footer">
                      <div class="modal-content left-align">
                        <h4>PENGUMUMAN DETAIL</h4>
                        Judul      : {{ $pengumuman->judul }} <br>
                        Kategori   : {{ $pengumuman->kategori }} <br>
                        Created At : {{ $pengumuman->created_at }} <br>
                        Updated At : {{ $pengumuman->updated_at }} <br>
                        @if($pengumuman->file == null)
                          Lampiran : Kosong <br>
                        @else
                          Lampiran : <a href="../upload/pengumuman/{{ $pengumuman->file }}">{{ $pengumuman->file }}</a><br>
                        @endif
                        Konten     : <br>
                        {{ $pengumuman->konten }}
                      </div>
                      <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Tutup</a>
                      </div>
                    </div>
                    {{-- END OF MODAL DETAIL PENGUMUMAN --}}
                  </td>
                  <td>{{-- BUTTON ICON UNTUK EDIT PENGUMUMAN --}}
                    <a class="btn-floating" href="/pengumuman/editpengumuman/{{$pengumuman->id}}">
                      <i class="material-icons right">mode_edit</i></a>
                  </td>
                  <td> {{-- BUTTON ICON UNTUK HAPUS PENGUMUMAN --}}
                    <!-- Modal Trigger -->
                    @if($pengumuman->status == 1)
                      <button data-target="" class="btn-floating btn black" style="cursor:default">
                          <i class="material-icons right">delete</i>
                      </button>
                    @else
                    <button data-target="modal{{$pengumuman->id}}" class="btn-floating modal-trigger">
                      <i class="material-icons right">delete</i>
                    </button>
                    <!-- Modal Structure -->
                    <div id="modal{{$pengumuman->id}}" class="modal">
                      <div class="modal-content">
                        <h4>Hapus {{ $pengumuman->judul }}?</h4>
                        <p>Pengumuman akan dihapus</p>
                      </div>
                      <div class="modal-footer">
                        <a href="/hapuspengumuman/{{$pengumuman->id}}" class="modal-action modal-close btn-flat left">Ya</a>
                        <a href="#!" class=" modal-action modal-close btn-flat left">Tidak</a>
                      </div>
                    </div>
                    @endif
                    <!-- END OF MODAL STRUCTURE -->
                  </td>
                  <td> {{-- BUTTON ICON UNTUK PUBLISH PENGUMUMAN --}}
                    @if($pengumuman->status === 1)
                      <i class="material-icons center">done_all</i>
                    @else
                      <!-- Modal Trigger -->
                      <button data-target="publish{{$pengumuman->id}}" class="btn-floating modal-trigger">
                        <i class="material-icons right">arrow_upward</i>
                      </button>
                      <!-- Modal Structure -->
                      <div id="publish{{$pengumuman->id}}" class="modal">
                        <div class="modal-content">
                          <h4>Publish {{ $pengumuman->judul }}?</h4>
                          <p>Pengumuman akan ditampilkan di Beranda</p>
                        </div>
                        <div class="modal-footer center-align">
                          <a href="/pengumuman/publishpengumuman/{{$pengumuman->id}}" 
                            class="modal-action modal-close btn-flat left">Ya</a>
                          <a href="#!" class=" modal-action modal-close btn-flat left">Tidak</a>
                        </div>
                      </div>
                      <!-- END OF MODAL STRUCTURE -->
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="center-align">
      {!! $allPengumuman->render() !!}
    </div>
    {{-- END OF CONTENT KELOLA PENGUMUMAN --}}
  </div>
  {{-- END OF PAGE CONTENT --}}
  <script>
    $(document).ready(function() {
      $('select').material_select();
      $('.modal-trigger').leanModal();
    });
  </script>

  @if ($errors->any())
    <ul class="alert alert-danger">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  @endif
  @stop
</body>
</html>