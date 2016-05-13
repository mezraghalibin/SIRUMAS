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
  <title>KELOLA PENELITIAN</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/publikasi.css">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
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
      $role = "<?php echo $spesifik_role ?>";

        // $("#buat-penelitian-konten").hide();

        // $("#kelola-penelitian").click(function(){
        //     $("#kelola-penelitian-konten").fadeIn(500);
        //     $("#buat-penelitian-konten").hide();
        // });

        //  $("#buat-penelitian").click(function(){
        //     $("#buat-penelitian-konten").fadeIn(500);
        //     $("#kelola-penelitian-konten").hide();
        // });

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

          <li id="kelola-penelitian"><a href="kelolapenelitian">Kelola Penelitian</a></li>
          <li id="buat-penelitian"><a href="buatpenelitian">Buat Penelitian</a></li>    
          @endif
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

    {{-- CONTENT KELOLA PENELITIAN --}}
    <div class="container">
      <div id="kelola-penelitian-konten">
        <div class="header"><h4>Kelola Penelitian</h4></div>
        <div class="kelola-content">
          <table class="highlight centered">
            <thead> {{-- NAMA JUDUL DARI KELOLA HIBAH --}}
              <tr>
                  <th data-field="judul_penelitian" style="width:30%">Judul Penelitian</th>
                  <th data-field="ketua_peneliti">Ketua Penelitian</th>
                  <th data-field="sumber_dana">Sumber Dana</th>
                  <th data-field="besar_dana">Besar Dana</th>
                  <th data-field="" style="width:7%">Edit</th>
                  <th data-field="" style="width:4%">Delete</th>
              </tr>
            </thead>

            <tbody>  {{-- ISI DARI TIAP PENELITIAN --}}
                  @foreach ($dataPenelitian as $penelitian) 
                  <tr>
                    <td>{{ $penelitian->judul }}</td
                    ></td>
                    <td>{{ $penelitian->ketua }}</td
                    ></td>
                    <td>{{ $penelitian->sumber_dana }}</td
                    ></td>
                    <td>{{ $penelitian->besar_dana }}</td
                    ></td>
                    <td> {{-- BUTTON ICON UNTUK EDIT PENELITIAN --}}
                      <a class="btn-floating" href="/editpenelitian/{{$penelitian->id}}">
                          <i class="material-icons right">mode_edit</i></a>
                    </td>
                    <td> {{-- BUTTON ICON UNTUK HAPUS HIBAH --}}
                      <!-- Modal Trigger -->
                      <button data-target="modal{{$penelitian->id}}" class="btn-floating btn modal-trigger">
                        <i class="material-icons right">delete</i>
                      </button>
                      <!-- Modal Structure -->
                      <div id="modal{{$penelitian->id}}" class="modal">
                        <div class="modal-content">
                          <h4>Hapus {{$penelitian->judul}}?</h4>
                          <p>Penelitian ini akan dihapus secara permanen</p>
                        </div>
                        <div class="modal-footer center-align">
                          <a href="/deletepenelitian/{{$penelitian->id}}" class="modal-action modal-close btn-flat">Ya</a>
                          <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                        </div>
                      </div>
                    </td>
                  </tr>
              @endforeach
        
            </tbody>
          </table>
        </div>
      </div>
    </div>

       <!-- {{-- CONTENT DAFTAR BUKU --}}
       <div id="buat-penelitian-konten">
       <div class="container">
          <div class="header"><h4>Buat Penelitian</h4></div>
          <div class="hibah-riset-content">
             <div class="row">
            <form class="col s12">

              {{-- FIRST ROW = NAMA --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Judul penelitian" id="nama" name="nama_pengaju" type="text" class="validate">
                  <label for="nama">Judul Penelitian</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Ketua penelitian" id="nip/nup" name="nip/nup" type="text" class="validate">
                  <label for="nip/nup">Ketua Peneliti</label>
                </div>

              </div>

              {{-- SECOND ROW = JUDUL PROPOSAL --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Sumber dana penelitian" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Sumber Dana</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Nama anggota peneliti" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">Anggota Peneliti</label>
                </div>
                <label><button class="add_field_button btn-floating btn-large card-panel red darken-2">
                <i class="material-icons">add</i></button></label>
              </div>

                {{-- FOURTH ROW --}}
              <div class="row">
               <div class="input-field col s6 offset-s1">
                  <input placeholder="Besar dana" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Besar Dana</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Penerbit" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">Mahasiswa yang Terlibat</label>
                </div>
                <label><button class="add_field_button btn-floating btn-large card-panel red darken-2">
                <i class="material-icons">add</i></button></label>
              </div>


              {{-- FIFTH ROW --}}
              <div class="row">
                <div class="file-field input-field col s6 offset-s1">
                  <div class="btn">
                    <span class="white-text">File</span>
                    <input name="file" type="file" placeholder="Masukkan bukti kontrak penelitian">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Masukkan bukti artikel">
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
          <!-- END OF TABEL DAFTAR PROPOSAL -->
          </div>
          {{-- CONTENT BUKU --}} -->

   <script>
    $(document).ready(function(){
      $('.materialboxed').materialbox();
      $('select').material_select();  //FOR FORM SELECT
      $('.modal-trigger').leanModal(); //FOR MODAL
    });
  </script>

  </div>
  @stop
</body>
</html>
