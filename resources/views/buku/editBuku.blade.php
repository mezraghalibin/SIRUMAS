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
  <title>EDIT BUKU</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{URL::asset('assets/css/buku.css')}}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
  <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
          <li id="kelola-buku"><a href="/kelolaRepository/buku/kelola">Kembali</a></li> 
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

    {{-- CONTENT EDIT BUKU --}}
    <div id="buat-buku-konten">
      <div class="container">
        <div class="header"><h4>Edit {{$buku->judul}}</h4></div>
        <div class="hibah-riset-content">
          <div class="row">
            <form method="POST" action="/kelolaRepository/buku/update/{{$buku->id}}" 
              class="col s12" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <input type="hidden" name="staf_riset" value="<?php echo $id ?>">

              {{-- FIRST ROW = JUDUL --}}
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input placeholder="Judul buku" id="judul" name="judul" type="text" class="validate" value="{{$buku->judul}}" required>
                  <label for="judul">Judul</label>
                </div>
              </div>

              {{-- SECOND ROW = PENULIS --}}
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input placeholder="Penulis" name="penulis" 
                    id="penulis" type="text" class="validate" value="{{$buku->penulis}}" required>
                  <label for="penulis">Penulis Utama</label>
                </div>
              </div>

              {{-- THIRD ROW = PENULIS ANGGOTA --}}
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  {{-- GET ALL EXPERTISE FROM SPECIFIC CONTACT --}}
                  <?php 
                    $seluruh_penulis_ang = $buku::find($buku->id)->getPenulis;
                    $list = ""; 
                  ?>
                  @foreach($seluruh_penulis_ang as $penulis_ang)
                    <?php $list = $list . $penulis_ang->nama_anggota . ";" ; ?>
                  @endforeach

                  <?php $coba = substr($list, 0, -1) ?>

                  <input placeholder="Penulis Anggota" name="nama_anggota" 
                    id="nama_anggota" type="text" class="validate" value = "<?php echo $coba ?>">
                  {{-- END OF GET ALL EXPERTISE --}}
                  <label for="nama_anggota">Penulis Anggota (Jika ada)</label>
                </div>
              </div>

              {{-- FOURTH ROW = TAHUN TERBIT, PENERBIT ISBN--}}
              <div class="row">
                <div class="input-field col s4 offset-s3">
                  <input placeholder="Nomor ISBN" name="isbn" id="isbn" type="text" class="validate" value="{{$buku->isbn}}" required>
                  <label for="isbn">ISBN</label>
                </div>
                <div class="input-field col s2">
                  <input placeholder="Jumlah halaman" name="jumlah_hlm" id="jumlah_hlm" type="text" class="validate" value="{{$buku->jumlah_hlm}}" required>
                  <label for="jumlah_hlm">Jumlah Halaman</label>
                </div>
              </div>

              {{-- FIFTH ROW = KOTA TERBIT, JUMLAH HALAMAN--}}
              <div class="row">
                <div class="input-field col s2 offset-s3">
                  <input placeholder="Tahun terbit buku" name="tahun" 
                    id="tahun" type="text" class="validate"  value="{{$buku->tahun}}" required>
                  <label for="tahun">Tahun Terbit</label>
                </div>
                <div class="input-field col s2">
                  <input placeholder="Penerbit" name="penerbit" id="penerbit" type="text" class="validate" value="{{$buku->penerbit}}" required>
                  <label for="penerbit">Penerbit</label>
                </div>
                <div class="input-field col s2">
                  <input placeholder="Tempat terbit buku" name="kota_terbit" 
                    id="kota_terbit" type="text" class="validate" value="{{$buku->kota_terbit}}" required>
                  <label for="kota_terbit">Kota Terbit</label>
                </div>
              </div>

              {{-- SIXTH ROW --}}
              <div class="row">
                <div class="file-field input-field col s6 offset-s3">
                  <div class="btn">
                    <span class="white-text">File</span>
                    <input name="file" type="file" placeholder="Masukkan bukti halaman cover dan ISBN">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Masukkan bukti halaman cover dan ISBN">
                  </div>
                </div>
              </div>

              {{-- BUTTON SUBMIT --}}
              <div class="center-align">
                <button class="btn waves-effect waves-light" type="submit" name="action"><span class="white-text">Submit</span><i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- END OF CONTENT BUKU --}}
  </div>
  {{-- END OF PAGE CONTENT --}}
  @stop
</body>
</html>