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
  <link rel="stylesheet" href="{{URL::asset('assets/css/artikelIlmiah.css')}}">

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
          <li id="kelola-buku"><a href="/kelolaRepository/artikelIlmiah/kelola">Kembali</a></li> 
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
        <div class="header"><h4>Edit {{$artikelIlmiah->judul}}</h4></div>
        <div class="hibah-riset-content">
          <div class="row">
            <form method="POST" action="/kelolaRepository/artikelIlmiah/update/{{ $artikelIlmiah->id }}" 
              class="col s12" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <input type="hidden" name="staf_riset" value="<?php echo $id ?>">

              {{-- FIRST ROW = JUDUL --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">
                  <input placeholder="Judul Artikel Ilmiah" id="judul" name="judul" type="text" 
                    class="validate" value="{{ $artikelIlmiah->judul }}" required>
                  <label for="judul">Judul</label>
                </div>
              </div>

              {{-- SECOND ROW = NAMA JURNAL & LEVEL --}}
              <div class="row">
                <div class="input-field col s5 offset-s2">
                <input placeholder="Jurnal" id="nama_jurnal" name="nama_jurnal" type="text" 
                  class="validate" value="{{ $artikelIlmiah->nama_jurnal }}" required>
                  <label for="nama_jurnal">Nama Jurnal</label>
                </div>
                <div class="input-field col s3">
                @if ( $artikelIlmiah->level == 'nasional_tidak_terakreditasi')
                 <select name="level" required>
                    <option value="" disabled selected>Level Artikel Ilmiah</option>
                    <option value="nasional_tidak_terakreditasi" selected="selected">Nasional Tidak Terakreditasi</option>
                    <option value="nasional_terakreditas">Nasional Terakreditasi</option>
                    <option value="internasional">Internasional</option>
                  </select>
                @elseif ( $artikelIlmiah->level == 'nasional_terakreditasi')
                  <select name="level" required>
                    <option value="" disabled selected>Level Artikel Ilmiah</option>
                    <option value="nasional_tidak_terakreditasi">Nasional Tidak Terakreditasi</option>
                    <option value="nasional_terakreditas" selected="selected">Nasional Terakreditasi</option>
                    <option value="internasional">Internasional</option>
                  </select>
                @elseif ( $artikelIlmiah->level == 'internasional')
                  <select name="level" required>
                    <option value="" disabled selected>Level Artikel Ilmiah</option>
                    <option value="nasional_tidak_terakreditasi">Nasional Tidak Terakreditasi</option>
                    <option value="nasional_terakreditas">Nasional Terakreditasi</option>
                    <option value="internasional" selected="selected">Internasional</option>
                  </select>
                @endif
                </div>
              </div>
                
              {{-- THIRD ROW = PENULIS UTAMA --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">
                  <input placeholder="Penulis" name="penulis_utama" id="penulis" type="text" 
                    class="validate" value="{{ $artikelIlmiah->penulis_utama }}" required>
                  <label for="penulis">Penulis Utama</label>
                </div>
              </div>
              
              {{-- FOURTH ROW = PENULIS ANGGOTA --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">

                <?php 
                  $all_anggota_penulis = $artikelIlmiah::find($artikelIlmiah->id)->getAnggota;
                  $list = "";
                  
                  foreach ($all_anggota_penulis as $anggota_penulis) {
                    $list = $list . $anggota_penulis->nama_anggota . ";";
                  }

                  $listAnggota = substr($list, 0, -1);
                ?>

                 <input placeholder="Andi;Budi;Caca;Delta" name="nama_anggota" id="nama_anggota" 
                    type="text" value=<?php echo $listAnggota ?> class="validate" required>
                  <label for="nama_anggota">Anggota Penulis</label>
                </div>
              </div>

              {{-- FIFTH ROW = NO VOL HAL TAHUN--}}
              <div class="row">
                <div class="input-field col s2 offset-s2">
                  <input placeholder="Nomor" name="no" id="no" type="text" 
                    class="validate" value="{{ $artikelIlmiah->no }}" required>
                  <label for="no">No. </label>
                </div>
                <div class="input-field col s2">
                  <input placeholder="Volume" name="volume" id="volumer" type="text" 
                    class="validate"  value="{{ $artikelIlmiah->volume }}" required>
                  <label for="Volumer">Volume</label>
                </div>
                <div class="input-field col s2">
                  <input placeholder="Jumlah Halaman" name="halaman" id="halaman" type="text" 
                    class="validate"  value="{{ $artikelIlmiah->halaman }}" required>
                  <label for="Halaman">Jumlah Halaman</label>
                </div>
                <div class="input-field col s2">
                  <input placeholder="Tahun" name="tahun" id="tahun" type="text" 
                    class="validate" value="{{ $artikelIlmiah->tahun }}" required>
                  <label for="tahun">Tahun</label>
                </div>
              </div>

              {{-- SIXT ROW = KOTA TERBIT, JUMLAH HALAMAN--}}
              <div class="row">
                <div class="input-field col s2 offset-s2">
                  <input placeholder="ISSN" name="issn" id="issn" type="text" 
                    class="validate" value="{{ $artikelIlmiah->issn }}" required>
                  <label for="issn">ISSN</label>
                </div>
                <div class="input-field col s3">
                  <input placeholder="Penerbit" name="penerbit" id="penerbit" type="text" 
                    class="validate" value="{{ $artikelIlmiah->penerbit }}" required>
                  <label for="penerbit">Penerbit</label>
                </div>
                <div class="input-field col s3">
                  <input placeholder="URL" name="url" id="url" type="text" 
                    class="validate" value="{{ $artikelIlmiah->url }}" required>
                  <label for="url">URL Artikel</label>
                </div>
              </div>

              {{-- SEVENTH ROW --}}
              <div class="row">
                <div class="file-field input-field col s8 offset-s2">
                  <div class="btn">
                    <span class="white-text">File</span>
                    <input name="bukti" type="file" placeholder="Kosongkan Jika Tidak Mengganti File">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Kosongkan Jika Tidak Mengganti File">
                  </div>
                </div>
              </div>

              {{-- BUTTON SUBMIT --}}
              <div class="center-align">
                <button class="btn waves-effect waves-light" type="submit" name="action">
                  <span class="white-text">Submit</span><i class="material-icons right">send</i>
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
  <script>
    $(document).ready(function() {
      $('select').material_select();  //FOR FORM SELECT
      $('.modal-trigger').leanModal(); //FOR MODAL
    });
  </script>
  @stop
</body>
</html>