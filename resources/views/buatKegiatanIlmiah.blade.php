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
  <title>BUAT KEGIATAN ILMIAH</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/publikasi.css">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


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
          <li id="kelola-kegiatan-ilmiah"><a href="{{action('KegiatanIlmiahController@kelola')}}">Kelola Kegiatan Ilmiah</a></li>
          <li id="buat-kegiatan-ilmiah"><a href="{{action('KegiatanIlmiahController@buat')}}">Buat Kegiatan Ilmiah</a></li>     
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


       {{-- CONTENT DAFTAR BUKU --}}
       <div id="buat-kegiatan-ilmiah-konten">
       <div class="container">
          <div class="header"><h4>Buat Kegiatan Ilmiah</h4></div>
          <div class="hibah-riset-content">
             <div class="row">
            <form method="post" action="buatkegiatanilmiah" class="col s12" enctype="multipart/form-data">
            <input name="staf_riset" value="<?php echo $id ?>" type="hidden" class="validate">
             <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">            
              {{-- FIRST ROW = NAMA --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Nama kegiatan" name="nama" type="text" class="validate">
                  <label for="nama">Nama Kegiatan</label>
                </div>
                <div class="input-field col s4">
                 <select name="jenis">
                    <option value="" disabled selected>Jenis Kegiatan</option>
                    <option value="Seminar">Seminar</option>
                    <option value="Konferensi">Konferensi</option>
                    <option value="Kuliah Tamu">Kuliah tamu</option>
                    <option value="Diskusi">Diskusi</option>
                  </select>
                </div>

              </div>

              {{-- SECOND ROW = JUDUL PROPOSAL --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Judul kegiatan" name="judul" type="text" class="validate">
                  <label for="judulproposal">Judul Kegiatan</label>
                </div>
                <div class="input-field col s4">
                  <select name="skala">
                    <option value="" disabled selected>Skala</option>
                    <option value="Internal Departemen">Internal Departemen</option>
                    <option value="Internal UI">Internal UI</option>
                    <option value="Nasional">Nasional</option>
                    <option value="Internasional">Internasional</option>
                  </select>
                </div>
              </div>

                {{-- FOURTH ROW --}}
              <div class="row">
               <div class="input-field col s6 offset-s1">
                  <input placeholder="Pembicara" name="pembicara" type="text" class="validate">
                  <label for="judulproposal">Pembicara</label>
                </div>
                <div class="input-field col s4">
                  <input type="date" name="waktu" class="datepicker">
                  <label for="nohp">Waktu</label>
                </div>
              </div>

               {{-- FOURTH ROW --}}
              <div class="row">
               <div class="input-field col s6 offset-s1">
                  <input placeholder="Tempat" name="tempat" type="text" class="validate">
                  <label for="judulproposal">Tempat</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Sumber dana" name="sumber_dana" type="text" class="validate">
                  <label for="nohp">Sumber Dana</label>
                </div>
              </div>


              {{-- FIFTH ROW --}}
              <div class="row">
                <div class="file-field input-field col s6 offset-s1">
                  <div class="btn">
                    <span class="white-text">File</span>
                    <input name="bukti" type="file" placeholder="Masukkan bukti kontrak kegiatan-ilmiah">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Masukkan bukti kegiatan">
                  </div>
                </div>
              </div>

              {{-- BUTTON SUBMIT --}}
              <div class="center-align">
                <button class="btn waves-effect waves-light" type="submit" name="action" value="post"><span class="white-text">Submit</span><i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
          </div>
          </div>
          <!-- END OF TABEL DAFTAR PROPOSAL -->
          </div>
          {{-- CONTENT BUKU --}}

     

  </div>

  <script>
  $(document).ready(function() {
      $('select').material_select();  //FOR FORM SELECT
      $('.modal-trigger').leanModal(); //FOR MODAL
  });
  </script>
  @stop
</body>
</html>
