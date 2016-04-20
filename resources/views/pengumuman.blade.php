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
  <title>PENGUMUMAN</title>
    <link rel="author" href="humans.txt">
    <link rel="stylesheet" href="assets/css/pengumuman.css">

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
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
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

    {{-- CONTENT KELOLA PENGUMUMAN --}}
    <div class="container">        
      <div id="kelola-pengumuman">
        <div class="header"><h4>Kelola Pengumuman</h4></div>
        <div class="kelola-content">
          <table class="highlight centered">  
            <thead>
              <tr>
                <th>Judul</th>
                <th>Nomor</th>
                <th>Kategori</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th style="width:7%">Edit</th>
                <th style="width:7%">Delete</th>
                <th style="width:4%">Publish</th>
              </tr>
            </thead>
            <tbody>
              @foreach($allPengumuman as $pengumuman)
                <tr>
                  <td>{{$pengumuman->judul}}</td>
                  <td>{{$pengumuman->nomor}}</td>
                  <td>{{$pengumuman->kategori}}</td>
                  <td>{{$pengumuman->created_at}}</td>
                  <td>{{$pengumuman->updated_at}}</td>
                  <td>{{-- BUTTON ICON UNTUK EDIT PENGUMUMAN --}}
                    <a class="btn-floating" href="/kelolapengumumansingle/{{$pengumuman->id}}">
                      <i class="material-icons right">mode_edit</i></a>
                  </td>
                  <td> {{-- BUTTON ICON UNTUK HAPUS PENGUMUMAN --}}
                    <!-- Modal Trigger -->
                    <button data-target="modal{{$pengumuman->id}}" class="btn-floating modal-trigger">
                      <i class="material-icons right">delete</i>
                    </button>
                    <!-- Modal Structure -->
                    <div id="modal{{$pengumuman->id}}" class="modal">
                      <div class="modal-content">
                        <h4>Hapus {{ $pengumuman->judul }}?</h4>
                        <p>Pengumuman akan dihapus</p>
                      </div>
                      <div class="modal-footer center-align">
                        <a href="/hapuspengumuman/{{$pengumuman->id}}" class="modal-action modal-close btn-flat">Ya</a>
                        <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                      </div>
                    </div>
                    <!-- END OF MODAL STRUCTURE -->
                  </td>
                  <td> {{-- BUTTON ICON UNTUK PUBLISH PENGUMUMAN --}}
                    @if($pengumuman->status === 1)
                        Published
                    @else
                      <!-- Modal Trigger -->
                      <button data-target="publish{{$pengumuman->id}}" class="btn-floating modal-trigger">
                        <i class="material-icons right">arrow_upward</i>
                      </button>
                      <!-- Modal Structure -->
                      <div id="publish{{$pengumuman->id}}" class="modal">
                        <div class="modal-content">
                          <h4>Publish {{ $pengumuman->judul }}?</h4>
                          <p>Pengumuman Akan ditampilkan di Beranda</p>
                        </div>
                        <div class="modal-footer center-align">
                          <a href="/publishpengumuman/{{$pengumuman->id}}" class="modal-action modal-close btn-flat">Ya</a>
                          <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                        </div>
                      </div>
                      <!-- END OF MODAL STRUCTURE -->
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{-- END OF CONTENT KELOLA PENGUMUMAN --}}

    {{-- CONTENT BUAT PENGUMUMAN --}}
    <div class="container">
      <div id="buat-pengumuman">
          <div class="header"><h4>Buat Pengumuman</h4></div>
            <form method="post" action="buatpengumuman" class="col s12" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="staf_riset" value="<?php echo $id ?>"> <!-- naro id staf riset -->
            <input type="hidden" name="status" value=0> <!-- status di set 0 -->
            {{-- bagian atas --}}
            <div class="row">
              <div class="input-field col s4">
                <input id="judul_pengumuman"  placeholder="Judul Pengumuman" type="text" class="validate" name="judul">
                <label class="active" for="judul_hibah">Judul</label>
              </div>
              <div class="input-field col s4">
                <input id="nomor_pengumuman" type="text" placeholder="Nomor Pengumuman" class="validate" name="nomor">
                <label class="active" for="nomor_hibah">Nomor</label>
              </div>
              <div class="input-field col s2">
                <select name="kategori">
                <option value="" disabled selected>Kategori</option>
                <option value="Riset">Riset</option>
                <option value="Pengmas">Pengmas</option>
                </select>
                <label>Ketegori</label>
              </div>
            </div>

            {{-- bagian isi     --}}
            <div class="row">
              <div class="input-field col s10">
                <textarea id="konten_pengumuman" placeholder="Masukan Konten Pengumuman" 
                      class="materialize-textarea" name="konten"></textarea>
                <label for="konten_pengumuman">Konten Pengumuman</label>
              </div>
            </div>
            
            {{-- INPUT FILE --}}
            <div class="row">
              <div class="file-field input-field col s6">
                <div class="btn card-panel red darken-2">
                  <span class="white-text">File</span>
                  <input type="file" name="file">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" name="file" placeholder="Belum ada file yang dipilih">
                </div>
              </div>
            </div>

            {{-- BUTTON SUBMIT --}}
            <div class="col s6">
              <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action" value="submit"><span class="white-text">Buat Pengumuman</span>
              <i class="material-icons right">send</i>
              </button>
            </div>
          </form>
      </div>
    </div>
    {{-- END OF CONTENT BUAT HIBAH --}}
  <div>
  {{-- END OF PAGE CONTENT --}}
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
    <script>
      $(document).ready(function() {
        $('select').material_select();
        $('#konten_pengumuman_isi').val('Lorem ipsum dolor...');
        $('#konten_pengumuman').trigger('autoresize');
        $('#konten_pengumuman-isi').trigger('autoresize');
        $('.modal-trigger').leanModal();
      });
    </script>

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