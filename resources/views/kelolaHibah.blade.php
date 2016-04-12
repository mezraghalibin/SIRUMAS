@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>KELOLA HIBAH</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/kelolaHibah.css">

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
    });
    </script>
</head>
<body>
  @section('main_content')
  <div class="page-content">
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
          <li id="kelola"><a href="{{action('HibahController@index')}}">BACK</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
        </ul>
      </div>
    </nav>

    <!-- CONTENT BUAT HIBAH -->
    <div class="container">
      <div id="kelola-hibah">
        <div class="header"><h4>Kelola Hibah</h4></div>
        <div class="kelola-content">
          <div class="row">
            <form class="col s12">
            <!-- FIRST ROW = CATEGORY, TIME START, TIME END -->
              <div class="row">                
                <div class="input-field col s6">
                  <select>
                    <option value="" disabled selected>Kategori</option>
                    <option value="1">Riset</option>
                    <option value="2">Pengmas</option>
                  </select>
                </div>
                <div class="input-field col s3">
                  <input type="date" class="datepicker">
                  <label>Waktu Mulai</label>
                </div>
                <div class="input-field col s3">
                  <input type="date" class="datepicker">
                  <label>Waktu Selesai</label>
                </div>
              </div>

              <!-- SECOND ROW = NAMA -->
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Nama" id="nama" type="text" class="validate">            
                  <label for="nama">Nama Hibah</label>
                </div>
              </div>

              <!-- THIRD ROW = BESAR DANA -->
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Besar Dana" id="besarDana" type="text" class="validate">
                  <label for="nama">Besar Dana Hibah</label>
                </div>
              </div>

              <!-- FOUR ROW = PEMBERI DANA -->
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Pemberi Dana" id="pemberiDana" type="text" class="validate">
                  <label for="nama">Pemberi Dana Hibah</label>
                </div>
              </div>

              <!-- FIFTH ROW = DESKRIPSI -->
              <div class="row">
                <div class="input-field col s12">
                  <textarea placeholder="Deskripsi Hibah" id="deskripsi" class="materialize-textarea"></textarea>
                  <label for="deksripsi">Deskripsi</label>
                </div>
              </div>
              
              <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action"><span class="white-text">Submit</span>
                <i class="material-icons right">send</i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- END OF CONTENT BUAT HIBAH -->
  </div>
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
