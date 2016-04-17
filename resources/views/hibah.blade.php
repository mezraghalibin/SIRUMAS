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
        $("#kelola-hibah").hide(0); //hide page kelola hibah
        $("#buat-hibah").hide(0); //hide page buat hibah

        $("#daftar").click(function(){
            $("#daftar-hibah").fadeIn(500);
            $("#kelola-hibah").hide(0); //hide page kelola hibah
            $("#buat-hibah").hide(0); //hide page buat hibah
        });

        $("#kelola").click(function(){
            $("#kelola-hibah").fadeIn(500);
            $("#daftar-hibah").hide(0); //hide page daftar hibah
            $("#buat-hibah").hide(0); //hide page buat hibah
        });

        $("#buat").click(function(){
            $("#buat-hibah").fadeIn(500);
            $("#daftar-hibah").hide(0); //hide page daftar hibah
            $("#kelola-hibah").hide(0); //hide page kelola hibah
        });

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

    {{-- FLASH MESSAGE AFTER UPLOAD MOU --}}
    <div id="flash-msg">
      @if(Session::has('flash_message'))
        <div class="card-panel teal">
          <span class="white-text">
            {{ Session::get('flash_message') }}<a id="clear" class="btn-flat transparent right"><i class="material-icons">clear</i></a>
          </span>
        </div>
      @endif 
    </div>
    {{-- END OF FLASH MESSAGE AFTER UPLOAD MOU --}}
    
    {{-- CONTENT DAFTAR HIBAH --}}
    <div class="container">
      <div id="daftar-hibah">
        <div class="header"><h4>Daftar Hibah</h4></div>
          <div class="daftar-content">
            <table class="highlight centered">
              <tbody>
                @if (count($dataHibah))
                  @foreach ($dataHibah as $hibah)
                    <tr>
                      <td>{{ $hibah->nama_hibah }}</td>
                      <td><a href="/hibah/applyhibah/{{$hibah->id}}" class="waves-effect waves-light btn card-panel red darken-2"><span class="white-text">Info & Daftar</span></a></td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
      </div>
    </div>
    {{-- END OF CONTENT DAFTAR HIBAH --}}

    {{-- CONTENT KELOLA HIBAH --}}
    <div class="container">
      <div id="kelola-hibah">
        <div class="header"><h4>Kelola Hibah</h4></div>
          <div class="kelola-content">
            <table class="highlight centered">
              <thead> {{-- NAMA JUDUL DARI KELOLA HIBAH --}}
                <tr>
                    <th data-field="nama_hibah" style="width:30%">Nama Hibah</th>
                    <th data-field="kategori_hibah">Kategori</th>
                    <th data-field="pemberi">Pemberi</th>
                    <th data-field="besar_dana">Besar Dana</th>
                    <th data-field="periode">Periode</th>
                    <th data-field=""></th>
                    <th data-field=""></th>
                </tr>
              </thead>

              <tbody>  {{-- ISI DARI TIAP HIBAH --}}
                @if (count($dataHibah))
                  @foreach ($dataHibah as $hibah)
                    <tr>
                      <td>{{ $hibah->nama_hibah }}</td>
                      <td>{{ $hibah->kategori_hibah }}</td>
                      <td>{{ $hibah->pemberi }}</td>
                      <td>{{ $hibah->besar_dana }}</td>
                      <td>{{ $hibah->tgl_awal }} - {{ $hibah->tgl_akhir }}</td>
                      <td> {{-- BUTTON ICON UNTUK EDIT HIBAH --}}
                        <a class="btn-floating" href="/hibah/kelolahibah/{{$hibah->id}}">
                        <i class="material-icons right">mode_edit</i></a>
                      </td>
                      <td> {{-- BUTTON ICON UNTUK HAPUS HIBAH --}}
                        <!-- Modal Trigger -->
                        <button data-target="modal{{$hibah->id}}" class="btn-floating btn modal-trigger">
                          <i class="material-icons right">delete</i>
                        </button>
                        <!-- Modal Structure -->
                        <div id="modal{{$hibah->id}}" class="modal">
                          <div class="modal-content">
                            <h4>Hapus {{$hibah->nama_hibah}}?</h4>
                            <p>Hibah akan dihapus secara permanen</p>
                          </div>
                          <div class="modal-footer center-align">
                            <a href="/hibah/deletehibah/{{$hibah->id}}" class="modal-action modal-close btn-flat">Ya</a>
                            <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
      </div>
    </div>
    {{-- END OF CONTENT KELOLA HIBAH --}}

    {{-- CONTENT BUAT HIBAH --}}
    <div class="container">
      <div id="buat-hibah">
        <div class="header"><h4>Buat Hibah</h4></div>
        <div class="buat-content">
          <div class="row">
            <form method="post" action="createhibah" class="col s12" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
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
                  <input placeholder="Tuliskan Nominalnya Saja" id="besarDana" name="besar_dana" type="text" class="validate">
                  <label for="nama">Besar Dana</label>
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
                  <input type="hidden" id="staf_riset" name="staf_riset" value="">
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
    <!-- END OF CONTENT BUAT HIBAH -->
  </div>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.js"></script>
  <script>
    $(document).ready(function() {
        $('select').material_select();  //FOR FORM SELECT
        $('.modal-trigger').leanModal(); //FOR MODAL
    });
  </script>
  @stop
</body>
</html>
