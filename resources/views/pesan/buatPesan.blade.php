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
  <title>PESAN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="author" href="humans.txt">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/pesan.css') }}">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!--FOR MATERIALIZE DONT DELETE THIS-->
    <script>
      $(document).ready(function(){
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
          <li id="kelola"><a href="/daftarPesanRiset">Daftar Pesan</a></li>
          <li id="buat"><a href="/pesan/buat">Buat Pesan</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}
    
    {{-- FLASH MESSAGE AFTER KIRIM PESAN --}}
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
    {{-- END OF FLASH MESSAGE AFTER KIRIM PESAN --}}

    @if (count($errors) > 0)
      <div class="card-panel teal">
          <span class="white-text">Pesan gagal dikirim.</span><br /> 
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
      </div>
    @endif

    {{-- CONTENT BUAT PESAN --}}
    @if($spesifik_role == 'divisi riset')
      <div class="container">
        <div id="buat-pesan">
          <div class="header"><h4>Buat Pesan</h4></div>
          <div id="flash-msg">
            @if(Session::has('flash_message'))
              <div class="card-panel teal darken-2">
                <span class="white-text">{{ Session::get('flash_message') }}</span>
                <a id="clear" class="collection-item" style="cursor:pointer">
                <i class="material-icons white right">clear</i></a>
              </div>
            @endif
          </div>
          <div class="kelola-content">
            <div class="row">
              <form method="post" action="/pesan/buat" class="col s12" enctype="multipart/form-data">            
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="id_pengirim" value="<?php echo $id ?>">
                <input type="hidden" name="isRead" value=0> {{-- ID READ OR NOT --}}
                {{-- ROW 1 = SUBJEK + PENERIMA --}}
                <div class="row">
                  <div class="input-field col s6 offset-s2">
                    <input placeholder="Subjek" id="subjek" name="subjek" type="text" class="validate" required>
                    <label for="subjek">Subjek</label>
                  </div>
                  <div class="input-field col s2">
                    <select name="penerima" required>
                      <option value="" disabled selected>Pilih</option>
                      @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nama }}</option>
                      @endforeach
                    </select>
                    <label>Kepada</label>
                  </div>
                </div>
                {{-- ROW 2 ISI PESAN --}}
                <div class="row">
                  <div class="input-field col s8 offset-s2">
                    <textarea id="textarea1" name="pesan" placeholder="Isi Pesan" 
                      class="materialize-textarea" required></textarea>
                    <label for="textarea1">Pesan</label>
                  </div>
                </div>
                {{-- ROW 3 INPUT FILE --}}
                <div class="row">
                  <div class="file-field input-field col s8 offset-s2">
                    <div class="btn card-panel teal darken-2">
                      <span class="white-text">File</span>
                      <input type="file" name="file">
                    </div>
                    <br>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text" placeholder="Belum ada file yang dipilih">
                    </div>
                  </div>
                </div>
                {{-- BUTTON KIRIM PESAN --}}
                <div class="center-align">
                  <button class="btn waves-effect waves-light card-panel teal darken-2" type="submit" 
                    name="action" value="submit"><span class="white-text">Kirim</span>
                    <i class="material-icons right">send</i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endif
    {{-- END OF CONTENT BUAT PESAN --}}
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
