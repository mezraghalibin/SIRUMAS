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
  <title>KELOLA PRESENTASI</title>
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

        $("#buat-presentasi-konten").hide();

        $("#kelola-presentasi").click(function(){
            $("#kelola-presentasi-konten").fadeIn(500);
            $("#buat-presentasi-konten").hide();
        });

         $("#buat-presentasi").click(function(){
            $("#buat-presentasi-konten").fadeIn(500);
            $("#kelola-presentasi-konten").hide();
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
          <li id="kelola-presentasi"><a href="#">Kelola Jadwal Presentasi</a></li> 
          <li id="buat-presentasi"><a href="#">Buat Jadwal Presentasi</a></li>   
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}


    {{-- CONTENT KELOLA HIBAH --}}
    <div class="container">
      <div id="kelola-presentasi-konten">
        <div class="header"><h4>Kelola Jadwal Presentasi</h4></div>
        <div class="kelola-content">
          <table class="highlight centered">
            <thead> {{-- NAMA JUDUL DARI KELOLA HIBAH --}}
              <tr>
                  <th data-field="kategori_hibah">Judul Proposal</th>
                  <th data-field="besar_dana">Jadwal</th>
                  <th data-field="periode">Gedung</th>
                  <th data-field="periode">Ruang</th>
                  <th data-field="periode">Status</th>
                  <th data-field="" style="width:7%">Edit</th>
                  <th data-field="" style="width:4%">Delete</th>
              </tr>
            </thead>

            <tbody>  {{-- ISI DARI TIAP HIBAH --}}
                  <tr>
                    <td>Riset Administrasi</td>
                    <td>19/05/2015 12:00</td>
                    <td>B</td>
                    <td>2604</td>
                    <td>Belum Presentasi</td>
                    <td> {{-- BUTTON ICON UNTUK EDIT HIBAH --}}
                      <a class="btn-floating" href="">
                      <i class="material-icons right">mode_edit</i></a>
                    </td>
                    <td> {{-- BUTTON ICON UNTUK HAPUS HIBAH --}}
                      <!-- Modal Trigger -->
                      <button data-target="" class="btn-floating btn modal-trigger">
                        <i class="material-icons right">delete</i>
                      </button>
                      <!-- Modal Structure -->
                      <div id="" class="modal">
                        <div class="modal-content">
                          <h4>Hapus?</h4>
                          <p>Hibah akan dihapus secara permanen</p>
                        </div>
                        <div class="modal-footer center-align">
                          <a href="" class="modal-action modal-close btn-flat">Ya</a>
                          <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                        </div>
                      </div>
                    </td>
                  </tr>
        
            </tbody>
          </table>
        </div>
      </div>
    </div>

       {{-- CONTENT DAFTAR BUKU --}}
       <div id="buat-presentasi-konten">
       <div class="container">
          <div class="header"><h4>Buat Jadwal Presentasi</h4></div>
          <div class="hibah-riset-content">
             <div class="row">
            <form class="col s12">

              {{-- FIRST ROW = NAMA --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Judul proposal" id="nama" name="nama_pengaju" type="text" class="validate">
                  <label for="nama">Judul Proposal</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Lokasi gedung" id="nip/nup" name="nip/nup" type="text" class="validate">
                  <label for="nip/nup">Gedung</label>
                </div>

              </div>

              {{-- SECOND ROW = JUDUL PROPOSAL --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Nama dosen" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Dosen</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Ruangan" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">Ruang</label>
                </div>
              </div>

                {{-- FOURTH ROW --}}
                 <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="dd/mm/yyyy, 00:00" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Jadwal</label>
                </div>
                <div class="input-field col s4">
                   <select class="browser-default">
                      <option value="" disabled selected>Status</option>
                      <option value="1">Belum presentasi</option>
                      <option value="2">Sudah presentasi</option>
                    </select>
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
          {{-- CONTENT BUKU --}}

  </div>
  @stop
</body>
</html>
