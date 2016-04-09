@extends('master')
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
        $('select').material_select();
      });
    </script>
</head>

<body>
  @section('main_content')
    <div class="page-content">
      <!-- SECOND NAVBAR -->
      <nav class="second-navbar">
        <div class="nav-wrapper">
          <ul class="left hide-on-med-and-down">
            <li id="kelola"><a href="#">Kelola Pengumuman</a></li>
            <li id="buat"><a href="#">Buat Pengumuman</a></li>
          </ul>
          <ul class="right hide-on-med-and-down">
            <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
          </ul>
        </div>
      </nav>
      <!-- END of SECOND NAVBAR -->

      <!-- CONTENT KELOLA PENGUMUMAN -->
      <div class="container">        
        <div id="kelola-pengumuman">
          <div class="header">KELOLA PENGUMUMAN</div>
            <div class="kelola-content">
              <table class="highlight centered">  
                <thead>
                  <tr>
                    <th>Judul</th>
                    <th>Nomor</th>
                    <th>Kategori</th>
                    <th>Konten</th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Hibah Riset UI 2015</td>
                    <td>123456</td>
                    <td>Riset</td>
                    <td>Lorem ipsum dolor ....</td>
                    <td>
                      <!-- Modal Trigger -->
                      <button data-target="modal1" class="btn-flat btn modal-trigger">Hapus</button>
                      <!-- Modal Structure -->
                      <div id="modal1" class="modal">
                        <div class="modal-content">
                          <h4>Hapus Pengumuman?</h4>
                          <p>Pengumuman akan dihapus</p>
                        </div>
                        <div class="modal-footer">
                          <a href="#!" class=" modal-action modal-close btn-flat">Ya</a>
                          <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                        </div>
                      </div>
                      </button>
                      

                    </td>
                    <td>
                        <button class="waves-effect waves-teal btn-flat" type="submit" id="edit-pengumuman">
                        <a href="{{action('PengumumanController@kelola')}}">
                          Edit
                        </a>
                        </button>
                    </td>
                    <td>
                      <!-- Modal Trigger -->
                      <button data-target="modal2" class="btn-flat btn modal-trigger">Publish</button>
                      <!-- Modal Structure -->
                      <div id="modal2" class="modal">
                        <div class="modal-content">
                          <h4>Publish Pengumuman?</h4>
                          <p>Pengumuman Akan ditampilkan di Beranda</p>
                        </div>
                        <div class="modal-footer">
                          <a href="#!" class=" modal-action modal-close btn-flat">Ya</a>
                          <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                        </div>
                      </div>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
      </div>
      <!-- END OF CONTENT KELOLA PENGUMUMAN -->


      <!-- CONTENT BUAT HIBAH -->
      <div class="container">
        <div id="buat-pengumuman">
            <div class="header">BUAT PENGUMUMAN</div>
            <!-- bagian atas -->
              <div class="row">
                <form class="col s12">
                    <div class="row">
                      <div class="input-field col s4">
                        <input id="judul_hibah" type="text" class="validate">
                        <label class="active" for="judul_hibah">Judul</label>
                      </div>
                      <div class="input-field col s4">
                        <input id="nomor_hibah" type="text" class="validate">
                        <label class="active" for="nomor_hibah">Nomor</label>
                      </div>
                      <div class="input-field col s2">
                        <select>
                        <option value="1">Riset</option>
                        <option value="2">Pengmas</option>
                        </select>
                        <label>Ketegori</label>
                      </div>
                   </div>
                </form>
              </div>

              <!-- bagian isi -->
              <div class="row">
                <form class="col s12">
                  <div class="row">
                    <div class="input-field col s10">
                      <textarea id="konten_pengumuman" class="materialize-textarea"></textarea>
                      <label for="konten_pengumuman">Konten Pengumuman</label>
                    </div>
                  </div>
                </form>
                <form action="#" class="col s5">
                  <div class="file-field input-field">
                    <div class="btn">
                      <span>File</span>
                      <input type="file" multiple>
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text" placeholder="Upload one or more files">
                    </div>
                  </div>
                </form>
                <div class="col s12">
                  <button class="btn waves-effect waves-light" type="submit" name="action">Buat Pengumuman
                  <i class="material-icons right">send</i>
                  </button>
                </div>
              </div>
        </div>
      </div>
      <!-- END OF CONTENT BUAT HIBAH -->
    </div>

    <div>
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
    </div>
  @stop
</body>
</html>