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
    <link rel="stylesheet" href="assets/css/pesan.css">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
        $("#buat-pesan").hide();
        $('select').material_select();

        $("#kelola").click(function(){
            $("#kelola-pesan").fadeIn(500);
            $("#buat-pesan").hide();
        });

        $("#buat").click(function(){
            $("#buat-pesan").fadeIn(500);
            $("#kelola-pesan").hide();
        });
      });
    </script>
</head>
<body>
  @section('main_content')
  <div class="page-content">
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
          <li id="kelola"><a href="#">Daftar Pesan</a></li>
          <!-- if buat nampilin tab buat pesan khusus ke divisi riset-->
          @if($spesifik_role == 'divisi riset')
            <li id="buat"><a href="#">Buat Pesan</a></li>
          @endif
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai <?php echo $username ?> - <?php echo $spesifik_role ?></a></li>
        </ul>
      </div>
    </nav>

<<<<<<< HEAD
    {{-- FLASH MESSAGE  --}}
    @if(Session::has('flash_message'))
      <div class="card-panel teal">
        <span class="white-text">{{ Session::get('flash_message') }}</span>
      </div>
    @endif
    {{-- END OF FLASH MESSAGE  --}}
      
    {{--  CONTENT DAFTAR PESAN --}}
    <div class="container">
      <div id="kelola-pesan">
        <div class="header"><h4>Daftar Pesan</h4></div>
        <div class="kelola-content">
          <table class="highlight centered">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Subjek</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <!--foreach untuk setiap message yg diambil bakal ngeprint tanggal dan subjeknya-->
              <?php foreach($messages as $message){
                echo '<tr>
                <td>'.$message->created_at.'</td>
                <td>'.$message->subjek.'</td>
                </tr>';
              }?>
            </tbody>
          </table>
=======
      <!--IF BUAT NAMPILIN SUCCESS MESSAGE-->
      @if(Session::has('flash_message'))
        <div class="card-panel teal">
          <span class="white-text">{{ Session::get('flash_message') }}</span>
        </div>
      @endif
      
      <!-- CONTENT DAFTAR PESAN-->
      <div class="container">
        <div id="kelola-pesan">
          <div class="header"><h4>Daftar Pesan</h4></div>
          <div class="kelola-content">
            <table class="highlight centered">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  @if($spesifik_role == 'divisi riset')
                  <th>Pesan Terkirim</th>
                  @endif
                  @if($spesifik_role == 'dosen')
                  <th>Pesan Masuk</th>
                  @endif
                </tr>
              </thead>
              <tbody>
              <!--foreach untuk setiap message yg diambil bakal ngeprint tanggal dan subjeknya-->
              <?php foreach($messages as $message){
                  echo '<tr>
                  <td>'.$message->created_at.'</td>
                  <td><a href="/detailPesan/'.$message->id.'">'.$message->subjek.'</a></td>
                  </tr>';
                }?>
              </tbody>
            </table>
          </div>
>>>>>>> 896703dbc6025a47aad621d90322d29d5c249d1c
        </div>
      </div>
    </div>
    {{-- END OF CONTENT DAFTAR PESAN --}}

    {{-- CONTENT BUAT PESAN --}}
    @if($spesifik_role == 'divisi riset')
      <div class="container">
        <div id="buat-pesan">
          <div class="header"><h4>Buat Pesan</h4></div>
          <div class="kelola-content">
            <div class="row">
              <form method="post" action="kirimpesan" class="col s6" enctype="multipart/form-data">            
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="id_pengirim" value="<?php echo $id ?>">
                <div class="row">
                  <div class="input-field col s6">
                    <input placeholder="Subjek" id="subjek" name="subjek" type="text" class="validate">
                    <label for="subjek">Subjek</label>
                  </div>
                  <div class="input-field col s6">
                    <select name="penerima">
                      <option value="" disabled selected>Pilih</option>
                      <!-- foreach untuk menampilkan user yg bisa dipilih ketika mengirim pesan -->
                      <?php foreach ($users as $user) {
                            echo "<option value=".$user->id.">".$user->nama."</option>";
                          }
                      ?>
                    </select>
                    <label>Kepada</label>
                  </div>
                </div>

                <div class="row">
                  <div class="col s12">
                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="textarea1" name="pesan" placeholder="Isi Pesan" 
                          class="materialize-textarea"></textarea>
                        <label for="textarea1">Pesan</label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col s12">
                  <div class="file-field input-field">
                    <div class="btn card-panel red darken-2">
                      <span class="white-text">File</span>
                      <input type="file" name="file">
                    </div>
                    <br>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text" placeholder="Belum ada file yang dipilih">
                    </div>
                  </div>
                </div>
              
                <div class="col s12">
                  <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action" value="submit"><span class="white-text">SEND</span>
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

    {{-- Import jQuery before materialize.js --}}
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
  @stop
</body>
</html>
