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

    <!--FOR BOOTSTRAP DONT DELETE THIS-->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Josefin+Slab:600' rel='stylesheet' type='text/css'>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!--FOR BOOTSTRAP DONT DELETE THIS-->

    <script>
    $(document).ready(function(){
        //DATE PICKER
        $('.datepicker').pickadate({
          selectMonths: true, // Creates a dropdown to control month
          selectYears: 15 // Creates a dropdown of 15 years to control year
        });

        //SET WHO IS SELECTED
        $("#pengmas-selected").hide(0); //hide Selected Pengmas
        $("#riset-selected").hide(0); //hide Selected Riset

        var kategori = "<?php echo $kategori ?>";
        if(kategori == "Riset") {
          $("#riset-selected").show(0); //hide Selected Pengmas
        }
        else {
          $("#pengmas-selected").show(0); //hide Selected Riset
        }

        //INPUT NAMA STAF RISET PENGUPLOAD MOU
        var id_staf = "<?php echo $id ?>";
        document.getElementById('staf_riset').value = id_staf;

        //CHANGE RUPIAH TO NOMINAL
        var danaHibah = "<?php echo $dana_hibah?>";
        var nominal = danaHibah.substring(4, danaHibah.length-2);
        var length = nominal.length;
        var count = length/3;
        for (i = count; i > 0; i--) {
          var nominal = nominal.replace(".", "");
        }
        document.getElementById('besar_dana').value = nominal;

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
          <li id="kelola"><a href="{{action('HibahController@index')}}">Kembali</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- CONTENT UPDATE HIBAH --}}
    <div class="container">
      <div id="kelola-hibah">
        <div class="header"><h4>Kelola Hibah</h4></div>
        <div class="kelola-content">
          <div class="row">
            <form method="post" action="updatehibah/{{$dataHibah->id}}" class="col s12" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              {{-- FIRST ROW = CATEGORY, TIME START, TIME END --}}
              <div class="row">        
                {{-- FOR RISET IS BEING SELECTED --}}
                <div id="riset-selected">
                  <div class="input-field col s6">
                    <select name="kategori_hibah">
                      <option value="" disabled selected>Kategori</option>
                      <option value="Riset" selected="selected">Riset</option>
                      <option value="Pengmas">Pengmas</option>
                    </select>
                  </div>
                </div>
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
                <div class="input-field col s3">
                  <input type="date" name="tgl_awal" class="datepicker" value="{{$dataHibah->tgl_awal}}">
                  <label>Waktu Mulai</label>
                </div>
                <div class="input-field col s3">
                  <input type="date" name="tgl_akhir" class="datepicker"  value="{{$dataHibah->tgl_akhir}}">
                  <label>Waktu Selesai</label>
                </div>
              </div>

              {{-- SECOND ROW = NAMA --}}
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Nama" name="nama_hibah" type="text" class="validate" value="{{$dataHibah->nama_hibah}}"> 
                  <label for="nama">Nama Hibah</label>
                </div>
              </div>

              {{-- THIRD ROW = BESAR DANA --}}
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Tuliskan Nominalnya Saja" id="besar_dana" name="besar_dana" type="text" 
                    class="validate" value="">
                  <label for="nama">Besar Dana</label>
                </div>
              </div>

              {{-- FOUR ROW = PEMBERI DANA --}}
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Pemberi Dana" name="pemberi" type="text" 
                  class="validate" value="{{$dataHibah->pemberi}}">
                  <label for="nama">Pemberi Dana Hibah</label>
                </div>
              </div>

              {{-- FIFTH ROW = DESKRIPSI --}}
              <div class="row">
                <div class="input-field col s12">
                  <textarea placeholder="Deskripsi Hibah" id="deskripsi" name="deskripsi" 
                  class="materialize-textarea" value="">{{$dataHibah->deskripsi}}</textarea>
                  <label for="deksripsi">Deskripsi</label>
                </div>
              </div>

              {{-- INPUT ID OF STAF RISET --}}
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input type="hidden" id="staf_riset" name="staf_riset" value="">
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
  
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.js"></script>
  <script>
    $(document).ready(function() {
        $('select').material_select();
    });
  </script>
  @stop
</body>
</html>