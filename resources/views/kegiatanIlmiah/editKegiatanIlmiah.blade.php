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
  <title>EDIT KEGIATAN ILMIAH</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/publikasi.css') }}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
  <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--FOR MATERIALIZE DONT DELETE THIS-->

  <script>
    $(document).ready(function(){
      //DATE PICKER
      $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
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
          <li id="kelola-kegiatan-ilmiah"><a href="/kelolaRepository/kegiatanIlmiah/kelola">Kembali</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- FLASH MESSAGE --}}
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
    {{-- END OF FLASH MESSAGE --}}

    {{-- CONTENT EDIT KEGIATAN ILMIAH --}}
    <div id="buat-kegiatan-ilmiah-konten">
      <div class="container">
        <div class="header"><h4>Edit Kegiatan Ilmiah</h4></div>
        <div class="buat-content">
          <div class="row">
            <form method="post" action="/kelolaRepository/kegiatanIlmiah/update/{{$kegiatanIlmiah->id}}" 
              class="col s12" enctype="multipart/form-data">
              <input name="staf_riset" value="<?php echo $id ?>" type="hidden" class="validate">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">         

              {{-- FIRST ROW = NAMA --}}
              <div class="row">
                <div class="input-field col s4 offset-s2">
                  <input placeholder="Nama kegiatan" name="nama" type="text" class="validate" 
                    value="{{ $kegiatanIlmiah->nama }}" required>
                  <label for="nama">Nama Kegiatan</label>
                </div>
                <div class="input-field col s2">
                  @if ($kegiatanIlmiah->jenis === 'Seminar')
                    <select name="jenis" required>
                      <option value="" disabled selected>Jenis</option>
                      <option value="Seminar" selected="selected">Seminar</option>
                      <option value="Konferensi">Konferensi</option>
                      <option value="Kuliah Tamu">Kuliah Tamu</option>
                      <option value="Diskusi">Diskusi</option>
                    </select>
                  @elseif ($kegiatanIlmiah->jenis === 'Konferensi')
                    <select name="jenis" required>
                      <option value="" disabled selected>Jenis</option>
                      <option value="Seminar">Seminar</option>
                      <option value="Konferensi" selected="selectec">Konferensi</option>
                      <option value="Kuliah Tamu">Kuliah Tamu</option>
                      <option value="Diskusi">Diskusi</option>
                    </select>
                  @elseif ($kegiatanIlmiah->jenis === 'Kuliah Tamu')
                    <select name="jenis" required>
                      <option value="" disabled selected>Jenis</option>
                      <option value="Seminar" selected="selected">Seminar</option>
                      <option value="Konferensi">Konferensi</option>
                      <option value="Kuliah Tamu" selected="selected">Kuliah Tamu</option>
                      <option value="Diskusi">Diskusi</option>
                    </select>
                  @elseif ($kegiatanIlmiah->jenis === 'Diskusi')
                    <select name="jenis" required>
                      <option value="" disabled selected>Jenis</option>
                      <option value="Seminar" selected="selected">Seminar</option>
                      <option value="Konferensi">Konferensi</option>
                      <option value="Kuliah Tamu">Kuliah tamu</option>
                      <option value="Diskusi" selected="selected">Diskusi</option>
                    </select>
                  @endif
                </div>
                <div class="input-field col s2">
                  @if ($kegiatanIlmiah->skala === 'Internal Departemen')
                    <select name="skala" required>
                      <option value="" disabled selected>Skala</option>
                      <option value="Internal Departemen" selected="selected">Internal Departemen</option>
                      <option value="Internal UI" >Internal UI</option>
                      <option value="Nasional">Nasional</option>
                      <option value="Internasional">Internasional</option>
                    </select>
                  @elseif ($kegiatanIlmiah->skala === 'Internal UI')
                    <select name="skala" required>
                      <option value="" disabled selected>Skala</option>
                      <option value="Internal Departemen">Internal Departemen</option>
                      <option value="Internal UI" selected="selected">Internal UI</option>
                      <option value="Nasional">Nasional</option>
                      <option value="Internasional">Internasional</option>
                    </select>
                  @elseif ($kegiatanIlmiah->skala === 'Nasional')
                    <select name="skala" required>
                      <option value="" disabled selected>Skala</option>
                      <option value="Internal Departemen">Internal Departemen</option>
                      <option value="Internal UI">Internal UI</option>
                      <option value="Nasional" selected="selected">Nasional</option>
                      <option value="Internasional">Internasional</option>
                    </select>
                  @elseif ($kegiatanIlmiah->skala === 'Internasional')
                    <select name="skala" required>
                      <option value="" disabled selected>Skala</option>
                      <option value="Internal Departemen">Internal Departemen</option>
                      <option value="Internal UI">Internal UI</option>
                      <option value="Nasional">Nasional</option>
                      <option value="Internasional" selected="selected">Internasional</option>
                    </select>
                  @endif
                </div>
              </div>

              {{-- SECOND ROW = JUDUL & SUMBER DANA --}}
              <div class="row">
                <div class="input-field col s5 offset-s2">
                  <input placeholder="Judul kegiatan" name="judul" type="text" 
                    class="validate" value="{{ $kegiatanIlmiah->judul }}" required>
                  <label for="judulproposal">Judul Kegiatan</label>
                </div>
                <div class="input-field col s3">
                  <input placeholder="Sumber dana" name="sumber_dana" type="text"
                    class="validate" value="{{ $kegiatanIlmiah->sumber_dana }}" required>
                  <label for="nohp">Sumber Dana</label>
                </div>
              </div>

              {{-- THIRD ROW = PEMBICARA --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">
                  <input placeholder="Pembicara" name="pembicara" type="text" class="validate" 
                    value="{{ $kegiatanIlmiah->pembicara }}" required>
                  <label for="judulproposal">Pembicara</label>
                </div>
              </div>

              {{-- FOURTH ROW = TEMPAT & WAKTU--}}
              <div class="row">
                <div class="input-field col s4 offset-s2">
                  <input placeholder="Tempat" name="tempat" type="text" class="validate" 
                    value="{{ $kegiatanIlmiah->tempat }}" required>
                  <label for="judulproposal">Tempat</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Waktu" type="date" name="waktu" class="datepicker"
                    value="{{ $kegiatanIlmiah->waktu }}" required>
                  <label for="nohp">Waktu</label>
                </div>
              </div>

              {{-- FIFTH ROW = FILE--}}
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
                <button class="btn waves-effect waves-light" type="submit" name="action" value="post">
                  <span class="white-text">Submit</span><i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- END OF CONTENT EDIT KEGIATAN ILMIAH --}}
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
