<?php 
  //CHECK USER'S ROLE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role'];
?>

@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>EDIT PENELITIAN</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE PENELITIAN -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/penelitian.css') }}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
  <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--FOR MATERIALIZE DONT DELETE THIS-->
  
  <script>
    $(document).ready(function(){
  
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
          <li id="kelola-penelitian"><a href="/kelolaRepository/penelitian/kelola">Kembali</a></li>   
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- FLASH MESSAGE  --}}
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

    {{-- EDIT PENELITIAN CONTENT --}}
    <div id="buat-penelitian-konten">
      <div class="container">
        <div class="header"><h4>Edit {{$penelitian->judul}}</h4></div>
        <div class="hibah-riset-content">
          <div class="row">
            <form method="POST" action="/kelolaRepository/penelitian/update/{{$penelitian->id}}" 
              class="col s12" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <input type="hidden" name="staf_riset" value="<?php echo $id ?>">

              {{-- FIRST ROW = JUDUL --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">
                  <input placeholder="Judul penelitian" id="judul" name="judul" 
                    type="text" class="validate" value="{{$penelitian->judul}}" required>
                  <label for="nama">Judul Penelitian</label>
                </div>
              </div>

              {{-- SECOND ROW = KETUA --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">
                  <input placeholder="Ketua penelitian" id="ketua" name="ketua" 
                    type="text" class="validate" value="{{$penelitian->ketua}}" required>
                  <label for="ketua">Ketua Peneliti</label>
                </div>
              </div>

              {{-- THIRD ROW = ANGGOTA --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">
                  {{-- GET ALL Penelitian Anggota FROM SPECIFIC Penelitian --}}
                  <?php 
                    $seluruh_penelitian_anggota = $penelitian::find($penelitian->id)->getAnggota;
                    $list = ""; 
                  ?>
                  @foreach($seluruh_penelitian_anggota as $penelitian_anggota)
                    <?php $list = $list . $penelitian_anggota->nama_anggota . ";" ; ?>
                  @endforeach

                  <?php $coba = substr($list, 0, -1) ?>
                  <input placeholder="Andi;Budi;Caca" name="nama_anggota" id="nama_anggota" 
                    type="text" class="validate" value="<?php echo $coba ?>">
                  {{-- END OF GET ALL Penelitian Anggota  --}}
                  <label for="nama_anggota">Anggota Peneliti</label>
                </div>
              </div>

              {{-- FOURTH ROW = MAHASISWA --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">
                  {{-- GET ALL MAHASISWA TERLIBAT FROM SPECIFIC PENELITIAN --}}
                  <?php 
                    $seluruh_mhs_terlibat = $penelitian::find($penelitian->id)->getMhsTerlibat;
                    $list = ""; 
                  ?>
                  @foreach($seluruh_mhs_terlibat as $mahasiswa_terlibat)
                    <?php $list = $list . $mahasiswa_terlibat->nama_mhs . ";" ; ?>
                  @endforeach
                  <?php $coba2 = substr($list, 0, -1) ?>
                  <input placeholder="Andi;Budi;Caca" name="nama_mhs" id="nama_mhs" 
                    type="text" class="validate"  value = "<?php echo $coba2 ?>">
                  {{-- END OF GET ALL MAHASISWA TERLIBAT --}}
                  <label for="nama_mhs">Mahasiswa yang Terlibat</label>
                </div>
              </div>

              {{-- FIFTH ROW = SUMBER & BESAR DANA --}}
              <div class="row">
                <div class="input-field col s5 offset-s2">
                  <input placeholder="Sumber dana" name="sumber_dana" 
                    id="sumber_dana" type="text" class="validate" value="{{$penelitian->sumber_dana}}" required>
                  <label for="sumber_dana">Sumber Dana</label>
                </div>
                <div class="input-field col s3">
                  <input placeholder="Isi Dengan Angka" name="nominal" id="besar_dana" type="number" 
                    class="validate" min="1" value="{{$penelitian->nominal}}" required>
                  <label for="besar_dana">Besar Dana</label>
                </div>
                <input name="besar_dana" id="besar_dana" type="hidden" class="validate" value="">
              </div>

              {{-- FOURTH ROW = FILE --}}
              <div class="row">
                <div class="file-field input-field col s8 offset-s2">
                  <div class="btn card-panel">
                    <span class="white-text">File</span>
                    <input name="file" type="file">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" 
                      placeholder="Masukkan bukti kontrak penelitian"value="{{$penelitian->file}}">
                  </div>
                </div>
              </div>

              {{-- BUTTON SUBMIT --}}
              <div class="center-align">
                <button class="btn waves-effect waves-light" type="submit" name="action"><span class="white-text">Submit</span><i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- END OF EDIT PENELITIAN CONTENT --}}
  </div>
  {{-- END OF PAGE CONTENT --}} 
  @stop
</body>
</html>
