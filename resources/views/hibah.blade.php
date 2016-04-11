@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>HIBAH</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/hibah.css">

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
        $("#kelola-hibah").hide(); //hide page kelola hibah
        $("#buat-hibah").hide(); //hide page buat hibah

        $("#daftar").click(function(){
            $("#daftar-hibah").fadeIn(500);
            $("#kelola-hibah").hide(); //hide page kelola hibah
            $("#buat-hibah").hide(); //hide page buat hibah
        });

        $("#kelola").click(function(){
            $("#kelola-hibah").fadeIn(500);
            $("#daftar-hibah").hide(); //hide page daftar hibah
            $("#buat-hibah").hide(); //hide page buat hibah
        });

        $("#buat").click(function(){
            $("#buat-hibah").fadeIn(500);
            $("#daftar-hibah").hide(); //hide page daftar hibah
            $("#kelola-hibah").hide(); //hide page kelola hibah
        });

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
          <li id="daftar"><a href="#">Daftar Hibah</a></li>
          <li id="kelola"><a href="#">Kelola Hibah</a></li>
          <li id="buat"><a href="#">Buat Hibah</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
        </ul>
      </div>
    </nav>
    
    <!-- CONTENT DAFTAR HIBAH -->
    <div class="container">
      <div id="daftar-hibah">
        <div class="header"><h4>Daftar Hibah</h4></div>
          <div class="daftar-content">
            <table class="highlight centered">
              <tbody>
                <tr>
                  <td>Hibah Riset Univeristas Indonesia Tahun 2016</td>
                  <td><a href="{{action('HibahController@applyHibah')}}" class="waves-effect waves-light btn card-panel red darken-2"><span class="white-text">Info & Daftar</span></a></td>
                </tr>
                <tr>
                  <td>Hibah Riset Bank Indonesia Tahun 2015</td>
                  <td><a href="{{action('HibahController@applyHibah')}}" class="waves-effect waves-light btn card-panel red darken-2"><span class="white-text">Info & Daftar</span></a></td>
                </tr>
                <tr>
                  <td>Hibah Pengmas Bank Indonesia Tahun 2015</td>
                  <td><a href="{{action('HibahController@applyHibah')}}" class="waves-effect waves-light btn card-panel red darken-2"><span class="white-text">Info & Daftar</span></a></td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
    </div>

    <!-- CONTENT KELOLA HIBAH -->
    <div class="container">
      <div id="kelola-hibah">
        <div class="header">KELOLA HIBAH</div>
          <div class="kelola-content">
            <table class="highlight centered">
              <thead>
                <tr>
                    <th data-field="id">Nama Hibah</th>
                    <th data-field="name">Kategori</th>
                    <th data-field="price">Pemberi</th>
                    <th data-field="price">Besar Dana</th>
                    <th data-field="price">Periode</th>
                    <th data-field="price"></th>
                    <th data-field="price"></th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td>Universitas Indonesia Hibah</td>
                  <td>Hibah</td>
                  <td>Garuda Indonesia</td>
                  <td>RP. 150.000.000</td>
                  <td>11/04/2015 - 11/05/2016</td>
                  <td><a href="{{action('HibahController@kelolaHibah')}}"><i class="material-icons right">mode_edit</i></a></td>
                  <td>
                    <!-- Modal Trigger  -->
                    <i data-target="modal1" class="material-icons right modal-trigger">
                      <!-- Modal Structure -->
                      <div id="modal1" class="modal">
                        <div class="modal-content">
                          <h4>Hapus Pengumuman?</h4>
                          <p>Pengumuman akan dihapus</p>
                        </div>
                        <div class="modal-footer">
                          <a href="#!" class=" modal-action modal-close btn-flat">Ya</a>
                          <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                        </div>
                      </div>
                      delete
                    </i>
                  </td>
                </tr>
                <tr>
                  <td>ABCDEFGHIJK Hibah</td>
                  <td>Hibah</td>
                  <td>Garuda Indonesia</td>
                  <td>RP. 150.000.000</td>
                  <td>11/04/2015 - 11/05/2016</td>
                  <td><a href="{{action('HibahController@kelolaHibah')}}"><i class="material-icons right">mode_edit</i></a></td>
                  <td><i class="material-icons right">delete</i></td>
                </tr>
                <tr>
                  <td>ULALALALALA Hibah</td>
                  <td>Hibah</td>
                  <td>Garuda Indonesia</td>
                  <td>RP. 150.000.000</td>
                  <td>11/04/2015 - 11/05/2016</td>
                  <td><a href="{{action('HibahController@kelolaHibah')}}"><i class="material-icons right">mode_edit</i></a></td>
                  <td><i class="material-icons right">delete</i></td>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
    </div>
      <!-- END OF CONTENT KELOLA HIBAH -->

    <!-- CONTENT BUAT HIBAH -->
    <div class="container">
      <div id="buat-hibah">
        <div class="header">BUAT HIBAH</div>
        <div class="buat-content">
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
              
              <button class="btn waves-effect waves-light" type="submit" name="action">Submit
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
