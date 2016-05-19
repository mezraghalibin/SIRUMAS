<?php 
  //CHECK USER'S ROLE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role'];
?>

@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>KELOLA BUKU</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/buku.css') }}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
  <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--FOR MATERIALIZE DONT DELETE THIS-->

  <script>
    $(document).ready(function(){
      $('.materialboxed').materialbox();
      $('select').material_select();  //FOR FORM SELECT
      $('.modal-trigger').leanModal(); //FOR MODAL
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
          <li id="kelola-buku"><a href="/kelolaRepository/buku/kelola">Kelola Buku</a></li>
          <li id="buat-buku"><a href="/kelolaRepository/buku/buat">Buat Buku</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

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

    {{-- CONTENT KELOLA BUKU --}}
    <div class="container">
      <div id="kelola-buku-konten">
        <div class="header"><h4>Kelola Buku</h4></div>
        <div class="kelola-content row">
          <div class="col s12">
            <?php $count = 1 ?>
            @foreach($dataBuku as $buku)
              @if($count == 1)
                <div class="row">
              @endif

              {{-- CONTENT --}}
              <div class="col s6 buku">
                <div class="col s3 left-row">
                  <img src="../../upload/buku/{{ $buku->sampul }}" alt="sampul" class="materialboxed sampul">
                </div>
                <div class="col s8 right-row">
                  <div class="judul truncate">{{ $buku->judul }}</div>
                  <div class="Penulis truncate">{{ $buku->penulis }}</div>
                  <div class="penerbit truncate">Penerbit/Tahun  : {{ $buku->penerbit . "/" . $buku->tahun }}</div>
                  {{-- GET ALL ANGGOTA FROM SPECIFIC BUKU --}}
                  <?php 
                    $anggotas = $buku::find($buku->id)->getPenulis;
                    $list = ""; 
                  
                    foreach ($anggotas as $anggota) {
                      $list = $list . $anggota->nama_anggota . ", " ;
                    }
                  ?>
                  <div class="anggota truncate">Anggota  : <?php echo substr($list, 0, -2) ?></div>
                  <br>
                  {{-- END OF GET ALL EXPERTISE --}}

                  <div class="button right">
                    {{-- MODAL DELETE BUKU --}}
                    <button data-target="modal{{$buku->id}}" class="btn-floating btn modal-trigger">
                      <i class="material-icons right">delete</i>
                    </button>
                    {{-- MODAL STRUCTURE DELETE BUKU --}}
                    <div id="modal{{$buku->id}}" class="modal">
                      <div class="modal-content">
                        <h4>Hapus {{$buku->judul}}?</h4>
                        <p>Buku akan dihapus secara permanen</p>
                      </div>
                      <div class="modal-footer center-align">
                        <a href="/kelolaRepository/buku/delete/{{$buku->id}}" class="modal-action modal-close btn-flat">Ya</a>
                        <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                      </div>
                    </div>
                    {{-- END OF MODAL DELETE BUKU --}}

                    {{-- MODAL DETAIL BUKU --}}
                    <button data-target="modal{{$buku->id}}detail" class="btn-floating btn modal-trigger">
                      <i class="material-icons right">info</i>
                    </button>
                    {{-- MODAL STRUCTURE DETAIL BUKU --}}
                    <div id="modal{{$buku->id}}detail" class="modal modal-fixed-footer">
                      <div class="modal-content">
                        <h4>Detail Buku</h4>
                        Judul       : {{ $buku->judul }} <br>
                        ISBN        : {{ $buku->isbn }} <br>
                        Halaman     : {{ $buku->jumlah_hlm }} <br>
                        Penulis     : {{ $buku->penulis }} <br>
                        Anggota     : <br> <?php echo substr($list, 0, -2) ?> <br>
                        Penerbit    : {{ $buku->penerbit }} <br>
                        Tahun Terbit: {{ $buku->tahun }} <br>
                        Sampul Buku : <br>
                        <img src="../../upload/buku/{{ $buku->sampul }}" alt="sampul" class="materialboxed">
                      </div>
                      <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Tutup</a>
                      </div>
                    </div>
                    {{-- END OF MODAL DETAIL BUKU --}}

                    {{-- BUTTON FOR EDIT PAGE --}}
                    <a class="btn-floating" href="/kelolaRepository/buku/edit/{{$buku->id}}">
                      <i class="material-icons right">mode_edit</i></a>
                    {{-- END OF BUTTON EDIT PAGE --}}
                  </div>
                </div>
              </div>
              {{-- END OF CONTENT --}}

              @if($count == 2)
                <?php $count = 1?>
                </div>
              @else
                <?php $count = 2?>
              @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <div align="center-align"> 
      {!! $dataBuku->render() !!}
    </div>
    {{-- END OF CONTENT KELOLA BUKU --}}
  </div>
  {{-- END OF PAGE CONTENT --}}

  <script>
    $(document).ready(function(){
      $('.materialboxed').materialbox();
      $('select').material_select();  //FOR FORM SELECT
      $('.modal-trigger').leanModal(); //FOR MODAL
    });
  </script>
  @stop
</body>
</html>
