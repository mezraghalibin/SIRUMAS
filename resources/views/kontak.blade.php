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
  <title>KONTAK</title>
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

        $("#buat-kontak-konten").hide();

        $("#kelola-kontak").click(function(){
            $("#kelola-kontak-konten").fadeIn(500);
            $("#buat-kontak-konten").hide();
        });

         $("#buat-kontak").click(function(){
            $("#buat-kontak-konten").fadeIn(500);
            $("#kelola-kontak-konten").hide();
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
          <li id="kelola-kontak"><a href="#">Kelola Kontak</a></li>
          <li id="buat-kontak"><a href="#">Buat Kontak</a></li>     
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}


    {{-- CONTENT KELOLA HIBAH --}}
    <div class="container">
      <div id="kelola-kontak-konten">
        <div class="header"><h4>Kelola Kontak</h4></div>
        <div class="kelola-content">
          <table class="highlight centered">
            <thead> {{-- NAMA JUDUL DARI KELOLA HIBAH --}}
              <tr>
                  <th data-field="nama_hibah" style="width:30%">Nama Kontak</th>
                  <th data-field="kategori_hibah">Expertise</th>
                  <th data-field="besar_dana">Institusi</th>
                  <th data-field="periode">No. HP</th>
                  <th data-field="periode">E-mail</th>
                  <th data-field="" style="width:7%">Edit</th>
                  <th data-field="" style="width:4%">Delete</th>
              </tr>
            </thead>

            <tbody>  {{-- ISI DARI TIAP HIBAH --}}
                  <tr>
                    <td>Prof. DR. Bambang</td>
                    <td>Ilmu Administrasi Niaga</td>
                    <td>Universitas Gadjah Mada</td>
                    <td>0812436587</td>
                    <td>bambang@ugm.ac.id</td>
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
       <div id="buat-kontak-konten">
       <div class="container">
          <div class="header"><h4>Buat Kontak</h4></div>
          <div class="hibah-riset-content">
             <div class="row">
            <form class="col s12">

              {{-- FIRST ROW = NAMA --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Nama kontak" id="nama" name="nama_pengaju" type="text" class="validate">
                  <label for="nama">Nama Kontak</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="E-mail" id="nip/nup" name="nip/nup" type="text" class="validate">
                  <label for="nip/nup">E-mail</label>
                </div>

              </div>

              {{-- SECOND ROW = JUDUL PROPOSAL --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Expertise" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Expertise</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Nomor HP" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">Nomor HP</label>
                </div>
              </div>

                {{-- FOURTH ROW --}}
              <div class="row">
               <div class="input-field col s6 offset-s1">
                  <input placeholder="Institusi" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Institusi</label>
                </div>
              </div>

              {{-- BUTTON SUBMIT --}}
              <div class="center-align">
                <button class="btn waves-effect waves-light" type="submit" name="action"><span class="white-text">Simpan</span><i class="material-icons right">send</i>
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
