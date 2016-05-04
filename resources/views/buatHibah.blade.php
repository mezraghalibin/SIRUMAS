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
    <!--FOR MATERIALIZE DONT DELETE THIS-->

    <script>
    $(document).ready(function(){
        var spesifik_role = "<?php echo $spesifik_role; ?>";

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
          @if($spesifik_role == 'dosen')
            <li id="daftar"><a href="#">Daftar Hibah</a></li>
          @endif
          @if($spesifik_role == 'divisi riset')
            <li id="kelola"><a href="/hibah/kelolahibah">Kelola Hibah</a></li>
            <li id="buat"><a href="#">Buat Hibah</a></li>
          @endif
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a id="user" href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF CONTENT SECOND NAVBAR --}}

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

    {{-- CONTENT BUAT HIBAH --}}
    <div class="container">
      <div id="buat-hibah">
        <div class="header"><h4>Buat Hibah</h4></div>
        <div class="buat-content">
          <div class="row">
            <form method="post" action="/hibah/createhibah" class="col s12" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <input type="hidden" name="status" value=0>
              {{-- FIRST ROW = CATEGORY, TIME START, TIME END --}}
              <div class="row">                
                <div class="input-field col s6">
                  <select name="kategori_hibah">
                    <option value="" disabled selected>Kategori</option>
                    <option value="Riset">Riset</option>
                    <option value="Pengmas">Pengmas</option>
                  </select>
                </div>
                <div class="input-field col s3">
                  <input type="date" name="tgl_awal" class="datepicker">
                  <label>Waktu Mulai</label>
                </div>
                <div class="input-field col s3">
                  <input type="date" name="tgl_akhir" class="datepicker">
                  <label>Waktu Selesai</label>
                </div>
              </div>

              {{-- SECOND ROW = NAMA --}}
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Nama" id="nama" name="nama_hibah" type="text" class="validate">            
                  <label for="nama">Nama Hibah</label>
                </div>
              </div>

              {{-- THIRD ROW = BESAR DANA --}}
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Tuliskan Nominalnya Saja" id="nominal" 
                    name="nominal" type="number" class="validate" min="1">
                  <label for="nama">Besar Dana</label>
                </div>
                <div class="input-field col s12">
                  <input id="besar_dana" name="besar_dana" type="hidden" class="validate" value="">
                </div>
              </div>

              {{-- FOUR ROW = PEMBERI DANA --}}
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Pemberi Dana" id="pemberiDana" name="pemberi" type="text" class="validate">
                  <label for="nama">Pemberi Dana Hibah</label>
                </div>
              </div>

              {{-- FIFTH ROW = DESKRIPSI --}}
              <div class="row">
                <div class="input-field col s12">
                  <textarea placeholder="Deskripsi Hibah" id="deskripsi" name="deskripsi" class="materialize-textarea"></textarea>
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
              <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action"><span class="white-text">Submit</span>
                <i class="material-icons right">send</i>
              </button>
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
