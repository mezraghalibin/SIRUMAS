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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
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
            <li id="kelola"><a href="/hibah/kelolaHibah">Kelola Hibah</a></li>
            <li id="buat"><a href="/hibah/buatHibah">Buat Hibah</a></li>
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

    {{-- CONTENT KELOLA HIBAH --}}
    <div class="container">
      <div id="kelola-hibah">
        <div class="header"><h4>Kelola Hibah</h4></div>
        <div class="kelola-content">
          <table class="highlight centered">
            <thead> {{-- NAMA JUDUL DARI KELOLA HIBAH --}}
              <tr>
                <th data-field="nama_hibah" style="width:25%">Nama Hibah</th>
                <th data-field="kategori_hibah">Kategori</th>
                <th data-field="pemberi">Pemberi</th>
                <th data-field="besar_dana">Besar Dana</th>
                <th data-field="periode">Periode (YYYY-MM-DD)</th>
                <th data-field="" style="width:5.5%">Edit</th>
                <th data-field="" style="width:4%">Publish</th>
                <th data-field="" style="width:5%">Delete</th>
                <th data-field="" style="width:5.5%">Non-Aktif</th>
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
                    <td>{{ $hibah->tgl_awal }} s/d {{ $hibah->tgl_akhir }}</td>
                    <td> {{-- BUTTON ICON UNTUK EDIT HIBAH --}}
                      @if($hibah->status === 1 || $hibah->status === 2) {{-- IF HIBAH UDAH DI PUBLISH/NON AKTIF --}} 
                        <a class="btn-floating black" href="#" style="cursor:default">
                          <i class="material-icons right">mode_edit</i></a>  
                      @else {{-- IF HIBAH BELUM DI PUBLISH --}} 
                        <a class="btn-floating" href="/hibah/editHibah/{{$hibah->id}}">
                          <i class="material-icons right">mode_edit</i></a>
                      @endif
                    </td>
                    <td> {{-- BUTTON ICON UNTUK PUBLISH PENGUMUMAN --}}
                      @if($hibah->status === 1 || $hibah->status === 2) {{-- IF HIBAH UDAH DI PUBLISH/NONAKTIF --}}
                        <a class="btn-floating black" href="#" style="cursor:default">
                          <i class="material-icons right">done</i></a>
                      @else {{-- IF UDAH DI PUBLISH/NON AKTIF --}}
                        <!-- Modal Trigger -->
                        <button data-target="publish{{$hibah->id}}" class="btn-floating modal-trigger">
                          <i class="material-icons right">arrow_upward</i>
                        </button>
                        <!-- Modal Structure -->
                        <div id="publish{{$hibah->id}}" class="modal">
                          <div class="modal-content">
                            <h4>Publish {{ $hibah->nama_hibah }}?</h4>
                            <p>Hibah Akan ditampilkan!</p>
                          </div>
                          <div class="modal-footer center-align">
                            <a href="/hibah/publishHibah/{{$hibah->id}}" class="modal-action modal-close btn-flat">Ya</a>
                            <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                          </div>
                        </div>
                        <!-- END OF MODAL STRUCTURE -->
                      @endif
                    </td>
                    @if($hibah->status === 1 || $hibah->status === 2) 
                      <td> {{-- BUTTON UNTUK HAPUS HIBAH IF HIBAH UDAH DI PUBLISH/NON AKTIF --}}
                        <button data-target="" class="btn-floating btn black" style="cursor:default">
                          <i class="material-icons right">delete</i>
                        </button>
                      </td>
                    @else
                      <td> {{-- BUTTON ICON UNTUK HAPUS HIBAH SEBELUM DIPUBLISH/NON AKTIF--}}
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
                            <a href="/hibah/deleteHibah/{{$hibah->id}}" class="modal-action modal-close btn-flat">Ya</a>
                            <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                          </div>
                        </div>
                      </td>
                    @endif
                    <td> {{-- FOR NON AKTIF --}}
                      @if($hibah->status === 1)
                        <!-- Modal Trigger -->
                        <button data-target="nonAktif{{$hibah->id}}" class="btn-floating btn modal-trigger">
                          <i class="material-icons right">clear</i>
                        </button>
                        <!-- Modal Structure -->
                        <div id="nonAktif{{$hibah->id}}" class="modal">
                          <div class="modal-content">
                            <h4>Non-Aktifkan {{$hibah->nama_hibah}}?</h4>
                          </div>
                          <div class="modal-footer center-align">
                            <a href="/hibah/nonAktifHibah/{{$hibah->id}}" class="modal-action modal-close btn-flat">Ya</a>
                            <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                          </div>
                        </div>
                      @elseif ($hibah->status === 0)
                        <button class="btn-floating black btn" style="cursor:default">
                          <i class="material-icons right">clear</i></button>
                      @elseif ($hibah->status === 2)
                        <a class="btn-floating black" href="#" style="cursor:default">
                          <i class="material-icons right">done</i></a>
                      @endif
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
    <div class="center-align">
      {!! $dataHibah->render() !!}
    </div>
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