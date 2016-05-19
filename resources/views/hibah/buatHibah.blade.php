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
  <title>HIBAH</title>
  <link rel="author" href="humans.txt">
  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/hibah.css') }}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
  <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
  <!--FOR MATERIALIZE DONT DELETE THIS-->

  <script>
    $(document).ready(function() {
      //CLEAR FLASH MESSAGE
      $("#clear").click(function(){
        $("#flash-msg").fadeOut(1000);
      });

      //DATE PICKER
      $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
      });

      //INPUT ID STAF RISET PENGUPLOAD HIBAH
      var id_staf = "<?php echo $id ?>";
      document.getElementById('staf_riset').value = id_staf;
    });
  </script>
</head>
<body>
  @section('main_content')
  {{-- PAGE CONTENT --}}
  <div class="page-content">
    {{-- CONTENT SECOND NAVBAR --}}
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
          <li id="kelola"><a href="/hibah/kelolaHibah">Kelola Hibah</a></li>
          <li id="buat"><a href="/hibah/buatHibah">Buat Hibah</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a id="user" href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF CONTENT SECOND NAVBAR --}}

    {{-- CONTENT BUAT HIBAH --}}
    <div class="container">
      <div id="buat-hibah">
        <div class="header"><h4>Buat Hibah</h4></div>
        <div id="flash-msg">
          @if(Session::has('flash_message'))
            <div class="card-panel teal darken-2">
              <span class="white-text">{{ Session::get('flash_message') }}</span>
              <a id="clear" class="collection-item" style="cursor:pointer">
              <i class="material-icons white right">clear</i></a>
            </div>
          @endif
        </div>
        <div class="buat-hibah-content">
          <div class="row">
            <form method="post" action="/hibah/buatHibah" class="col s12" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <input type="hidden" name="status" value=0>
              {{-- FIRST ROW = CATEGORY, TIME START, TIME END --}}
              <div class="row">                
                <div class="input-field col s6">
                  <select name="kategori_hibah" required>
                    <option value="" disabled selected>Kategori</option>
                    <option value="Riset">Riset</option>
                    <option value="Pengmas">Pengmas</option>
                  </select>
                </div>
                <div class="input-field col s3">
                  <input type="time" name="tgl_awal" class="datepicker" required>
                  <label>Waktu Mulai</label>
                </div>
                <div class="input-field col s3">
                  <input type="date" name="tgl_akhir" class="datepicker" required>
                  <label>Waktu Selesai</label>
                </div>
              </div>

              {{-- SECOND ROW = NAMA --}}
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Nama" id="nama" name="nama_hibah" type="text" class="validate" required>            
                  <label for="nama">Nama Hibah</label>
                </div>
              </div>

              {{-- THIRD ROW = BESAR DANA --}}
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Tuliskan Nominalnya Saja" id="nominal" 
                    name="nominal" type="number" class="validate" min="1" required>
                  <label for="nama">Besar Dana</label>
                </div>
                <div class="input-field col s12">
                  <input id="besar_dana" name="besar_dana" type="hidden" class="validate" value="">
                </div>
              </div>

              {{-- FOUR ROW = PEMBERI DANA --}}
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Pemberi Dana" id="pemberiDana" name="pemberi" type="text" class="validate" required>
                  <label for="nama">Pemberi Dana Hibah</label>
                </div>
              </div>

              {{-- FIFTH ROW = DESKRIPSI --}}
              <div class="row">
                <div class="input-field col s12">
                  <textarea placeholder="Deskripsi Hibah" id="deskripsi" 
                    name="deskripsi" class="materialize-textarea" required></textarea>
                  <label for="deksripsi">Deskripsi</label>
                </div>
              </div>

              {{-- INPUT ID OF STAF RISET --}}
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input type="hidden" id="staf_riset" name="staf_riset" value="<?php echo $id ?>">
                </div>
              </div>

              {{-- BUTTON SUMBIT --}}
              <div class="center">
                <button class="btn waves-effect waves-light card-panel teal darken-2" type="submit"
                  name="action"><span class="white-text">Simpan</span>
                  <i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- END OF CONTENT BUAT HIBAH --}}
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
