<?php 
  //CHECK USER'S ROLE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role'];
  $status_presentasi = "";
?>

@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>KELOLA PRESENTASI</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/publikasi.css') }}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
    <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--FOR MATERIALIZE DONT DELETE THIS-->

  <script>
  $(document).ready(function(){
    $role = "<?php echo $spesifik_role ?>";
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
          <li id="kelola-presentasi"><a href="/presentasi/kelolapresentasi">Kelola Jadwal Presentasi</a></li> 
          <li id="buat-presentasi"><a href="/presentasi/buatpresentasi">Buat Jadwal Presentasi</a></li>   
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

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

    {{-- CONTENT KELOLA HIBAH --}}
    <div class="container">
      <div id="kelola-presentasi-konten">
        <div class="header"><h4>Kelola Jadwal Presentasi</h4></div>
        <div class="kelola-content">
          <table class="highlight centered">
            <thead> {{-- NAMA JUDUL DARI KELOLA HIBAH --}}
              <tr>
                <th data-field="judul_laporan">Judul Laporan</th>
                <th data-field="dosen">Dosen</th>
                <th data-field="jadwal">Jadwal</th>
                <th data-field="gedung">Gedung</th>
                <th data-field="ruang">Ruang</th>
                <th data-field="periode">Status</th>
                <th data-field="" style="width:7%">Edit</th>
                <th data-field="" style="width:4%">Delete</th>
              </tr>
            </thead>

            <tbody>  {{-- ISI DARI TIAP HIBAH --}}
                @foreach($dataPresentasi as $presentasi)
                  <tr>
                    <td>{{$presentasi->judul}}</td>
                    <td>{{$presentasi->nama}}</td>
                    <td>{{$presentasi->waktu}}</td>
                    <td>{{$presentasi->gedung}}</td>
                    <td>{{$presentasi->ruang}}</td>
                    @if($presentasi->status==0)
                      <?php $status_presentasi = 'Belum Presentasi'; ?>
                    @else
                      <?php $status_presentasi = 'Sudah Presentasi'; ?>
                    @endif
                    <td>{{$status_presentasi}}</td>
                    <td> {{-- BUTTON ICON UNTUK EDIT PRESENTASI --}}
                      <a class="btn-floating" href="/presentasi/editpresentasi/{{$presentasi->id}}">
                      <i class="material-icons right">mode_edit</i></a>
                    </td>
                    <td> {{-- BUTTON ICON UNTUK HAPUS PRESENTASI --}}
                      
                      @if($presentasi->status==0)
                        <!-- Modal Trigger -->
                      <button data-target="modal{{$presentasi->id}}detail" class="btn-floating btn modal-trigger">
                        <i class="material-icons right">delete</i>
                      </button>
                      <!-- Modal Structure -->
                      <div id="modal{{$presentasi->id}}detail" class="modal">
                        <div class="modal-content">
                          <h4>Hapus Jadwal {{$presentasi->judul}}?</h4>
                          <p>Jadwal Presentasi akan dihapus secara permanen</p>
                        </div>
                        <div class="modal-footer center-align">
                          <a href="/presentasi/delete/{{$presentasi->id}}" class="modal-action modal-close btn-flat">Ya</a>
                          <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                        </div>
                      </div>
                      @else
                        <a class="btn-floating black" href="#" style="cursor:default">
                          <i class="material-icons right">done</i></a>
                      @endif

                      
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $('.materialboxed').materialbox();
      $('select').material_select();  //FOR FORM SELECT
      $('.modal-trigger').leanModal(); //FOR MODAL
    });
  </script>
  @stop
</body>
</html>
