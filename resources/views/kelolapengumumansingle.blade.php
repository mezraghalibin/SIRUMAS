@extends('master')
<?php 
  //CHECK USER'S ROLE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role']; 

  //GET KATEGORI HIBAH
  $kategori = $pengumuman->kategori;
?>

<!DOCTYPE html>
<html>
<head>
  <title>PENGUMUMAN</title>
  <link rel="author" href="humans.txt">
  <link rel="stylesheet" href="{{URL::asset('assets/css/master.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/css/pengumuman.css')}}">
  <meta charset="utf-8">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
    <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
  <!--FOR MATERIALIZE DONT DELETE THIS-->

  <script>
    $(document).ready(function(){
      $("#buat-pengumuman").hide();

      $("#kelola").click(function(){
          $("#kelola-pengumuman").fadeIn(500);
          $("#buat-pengumuman").hide();
      });

      $("#buat").click(function(){
          $("#buat-pengumuman").fadeIn(500);
          $("#kelola-pengumuman").hide();
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

      //CLEAR FLASH MESSAGE
      $("#clear").click(function(){
        $("#flash-msg").fadeOut(1000);
      });

      $('select').material_select();
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
            @if($spesifik_role == 'divisi riset')
              <li id="kelola"><a href="#">Kelola Pengumuman</a></li>
              <li id="buat"><a href="#">Buat Pengumuman</a></li>
            @endif
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
        </ul>
      </div>
    </nav>
    {{-- END of SECOND NAVBAR --}}

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

    {{-- CONTENT BUAT PENGUMUMAN --}}
    <div class="container">
      <div id="update-pengumuman">
        <div class="header"><h4>Edit Pengumuman</h4></div>
        <form method="post" action="/kelolapengumumansingle/{{$pengumuman->id}}" 
          class="col s12" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <input type="hidden" name="staf_riset" value="<?php echo $id ?>"> <!-- naro id staf riset -->
          <input type="hidden" name="status" value=0> <!-- status di set 0 -->
          {{-- FIRST ROW JUDUL NOMOR KATEGORI --}}
          <div class="row">
            <div class="input-field col s4 offset-s2">
              <input id="judul_pengumuman" type="text" class="validate" name="judul" value="{{ $pengumuman->judul }}">
              <label class="active" for="judul_hibah">Judul</label>
            </div>
            <div class="input-field col s2">
              <input id="nomor_pengumuman" type="text" class="validate" name="nomor" value="{{ $pengumuman->nomor }}">
              <label class="active" for="nomor_hibah">Nomor</label>
            </div>                
            {{-- FOR RISET IS BEING SELECTED --}}
            <div id="riset-selected" class="input-field col s2">
              <select name="kategori">
                <option value="" disabled selected>Kategori</option>
                <option value="Riset" selected="selected">Riset</option>
                <option value="Pengmas">Pengmas</option>
              </select>
            </div>
            {{-- FOR PENGMAS IS BEING SELECTED --}}
            <div id="pengmas-selected" class="input-field col s2">
              <select name="kategori">
                <option value="" disabled selected>Kategori</option>
                <option value="Riset">Riset</option>
                <option value="Pengmas" selected="selected">Pengmas</option>
              </select>
            </div>
          </div>

          {{-- KONTEN PENGUMUMAN --}}
          <div class="row">
            <div class="input-field col s8 offset-s2">
              <textarea id="konten_pengumuman" class="materialize-textarea" name="konten"></textarea>
              <label for="konten_pengumuman">Konten Pengumuman</label>
            </div>
          </div>

          {{-- INPUT FILE --}}
          <div class="row">  
            <div class="file-field input-field col s8 offset-s2">
              <div class="btn card-panel red darken-2">
                <span class="white-text">File</span>
                <input type="file" name="file">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" 
                  placeholder="Kosongkan Jika Tidak Mengubah File" value="">
              </div>
            </div>
          </div>

          {{-- BUTTON SUBMIT --}}
          <div class="center-align col s6">
            <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action" value="submit"><span class="white-text">Perbarui Pengumuman</span>
            <i class="material-icons right">send</i>
            </button>
          </div>
        </form>
      </div>
    </div>
    {{-- END OF CONTENT BUAT HIBAH --}}
  </div>
  {{-- END OF PAGE CONTENT --}}
    
  <div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
    <script>
      $(document).ready(function() {
        $('select').material_select();
        $('#konten_pengumuman').val('{{$pengumuman->konten}}');
        $('#konten_pengumuman').trigger('autoresize');
        $('.modal-trigger').leanModal();
      });
    </script>
  </div>

  @if ($errors->any())
      <ul class="alert alert-danger">
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  @endif
@stop
</body>
</html>