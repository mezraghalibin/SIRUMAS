@extends('master')
<?php 
  //GET USER'S PROFILE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role']; 
  
  //GET KATEGORI HIBAH
  $kategori = $dataHibah->kategori_hibah;
  $dana_hibah = $dataHibah->besar_dana;
?>
<!DOCTYPE html>
<html>
<head>
  <title>KELOLA HIBAH</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/applyHibah.css') }}">

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
          <li id="kelola"><a href="/hibah/kelolaHibah">Kembali</a></li>
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

    {{-- CONTENT UPDATE HIBAH --}}
    <div class="container">
      <div id="kelola-hibah">
        <div class="header"><h4>Kelola Hibah</h4></div>
        <div class="kelola-content">
          <div class="row">
            <form method="post" action="/hibah/updateHibah/{{$dataHibah->id}}" class="col s12" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              {{-- FIRST ROW = CATEGORY, TIME START, TIME END --}}
              <div class="row">        
                {{-- FOR RISET IS BEING SELECTED --}}
                @if ($kategori == 'Riset')
                <div id="riset-selected">
                  <div class="input-field col s6">
                    <select name="kategori_hibah">
                      <option value="" disabled selected>Kategori</option>
                      <option value="Riset" selected="selected">Riset</option>
                      <option value="Pengmas">Pengmas</option>
                    </select>
                  </div>
                </div>
                @elseif ($kategori == 'Pengmas')
                {{-- FOR PENGMAS IS BEING SELECTED --}}
                <div id="pengmas-selected">
                  <div class="input-field col s6">
                    <select name="kategori_hibah">
                      <option value="" disabled selected>Kategori</option>
                      <option value="Riset">Riset</option>
                      <option value="Pengmas" selected="selected">Pengmas</option>
                    </select>
                  </div>
                </div>
                @endif
                <div class="input-field col s3">
                  <input type="date" name="tgl_awal" class="datepicker" value="{{$dataHibah->tgl_awal}}" required>
                  <label>Waktu Mulai</label>
                </div>
                <div class="input-field col s3">
                  <input type="date" name="tgl_akhir" class="datepicker"  value="{{$dataHibah->tgl_akhir}}" required>
                  <label>Waktu Selesai</label>
                </div>
              </div>

              {{-- SECOND ROW = NAMA --}}
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Nama" name="nama_hibah" type="text" class="validate" 
                    value="{{$dataHibah->nama_hibah}}" required> 
                  <label for="nama">Nama Hibah</label>
                </div>
              </div>

              {{-- THIRD ROW = BESAR DANA --}}
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Tuliskan Nominalnya Saja" id="nominal" name="nominal" type="number" 
                    class="validate" value="{{ $dataHibah->nominal }}" required>
                  <label for="nama">Besar Dana</label>
                </div>
                <div class="input-field col s12">
                  <input id="besar_dana" name="besar_dana" type="hidden" class="validate" value="">
                </div>
              </div>

              {{-- FOUR ROW = PEMBERI DANA --}}
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Pemberi Dana" name="pemberi" type="text" 
                  class="validate" value="{{$dataHibah->pemberi}}" required>
                  <label for="nama">Pemberi Dana Hibah</label>
                </div>
              </div>

              {{-- FIFTH ROW = DESKRIPSI --}}
              <div class="row">
                <div class="input-field col s12">
                  <textarea placeholder="Deskripsi Hibah" id="deskripsi" name="deskripsi" 
                  class="materialize-textarea" required>{{$dataHibah->deskripsi}}</textarea>
                  <label for="deksripsi">Deskripsi</label>
                </div>
              </div>

              {{-- INPUT ID OF STAF RISET --}}
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input type="hidden" id="staf_riset" name="staf_riset" value="<?php echo $id ?>">
                </div>
              </div>

              {{-- CANCEL BUTTON --}}
              <a class="btn waves-effect waves-light card-panel red darken-2" href="{{action('HibahController@index')}}" 
              name="action"><span class="white-text">CANCEL</span>
              </a>
              {{-- UPDATE BUTTON --}}
              <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action"><span class="white-text">Update</span>
                <i class="material-icons right">forward</i>
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
        $('select').material_select();
    });
  </script>
  @stop
</body>
</html>