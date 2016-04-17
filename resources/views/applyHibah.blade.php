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
  <title>APPLY HIBAH</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/applyHibah.css') }}">

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
        $("#apply-hibah").hide(); //hide page apply hibah

        $("#apply").click(function(){
            $("#apply-hibah").fadeIn(800);
        });

        //DATE PICKER
        $('.datepicker').pickadate({
          selectMonths: true, // Creates a dropdown to control month
          selectYears: 15 // Creates a dropdown of 15 years to control year
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
          <li id="daftar"><a href="{{action('HibahController@index')}}">Daftar Hibah</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
        </ul>
      </div>
    </nav>
<<<<<<< HEAD
    
    <!--IF BUAT NAMPILIN SUCCESS MESSAGE-->
      @if(Session::has('flash_message'))
        <div class="card-panel teal">
          <span class="white-text">{{ Session::get('flash_message') }}</span>
        </div>
      @endif
      <!-- CONTENT DAFTAR PESAN-->



    <!-- CONTENT INFORMASI HIBAH -->
    





    {{-- CONTENT INFORMASI HIBAH --}}

    <div class="container">
      <div id="daftar-hibah">
        <div class="header"><h4>
          <?php 
            $namaHibah = $dataHibah->nama_hibah;
            $find = stripos($namaHibah, "Hibah");
            if ($find === false) { //MASUK IF DI NAMA HIBAH GA ADA WORD "HIBAH"
              echo "Hibah " . $namaHibah;
            }
            else {
              echo $namaHibah; //MASUK IF DI NAMA HIBAH ADA WORD "HIBAH"
            }
          ?>
          </h4></div>
          <div class="daftar-content">
            <div class="row">
              <div class="col s4">
                <table class="centered">
                  <thead>
                    <tr>
                        <th data-field="besar">Besar Dana</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td id="besar_dana">{{$dataHibah->besar_dana}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col s4">
                <table class="centered">
                  <thead>
                    <tr>
                        <th data-field="besar">Pemberi Dana</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>  
                      <td>{{$dataHibah->pemberi}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col s4">
                <table class="centered">
                  <thead>
                    <tr>
                        <th data-field="besar">Periode</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{$dataHibah->tgl_awal}} - {{$dataHibah->tgl_akhir}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col s12">
                <table>
                  <thead>
                    <tr>
                        <th class="description-head">Deskripsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="description-content">{{$dataHibah->deskripsi}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
    </div>
    {{-- END OF CONTENT INFORMASI HIBAH --}}

    <div class="container center-align">
      <button class="btn waves-effect waves-light card-panel red darken-2" id="apply" ><span class="white-text">Apply Hibah</span></button>
    </div>

    <?php 
      $id_hibah = 1;
    ?>
    <!-- CONTENT APPLY HIBAH -->
    <div class="container">
      <div id="apply-hibah">
        <div class="header">APPLY HIBAH</div>
        <div class="apply-content">
          <div class="row">
            <form class="col s12" method="post" action="applyProposal" enctype=multipart/form-data>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="dosen" value="<?php echo $id ?>">
            
            <!--ambil dari hibah-->

            <input type="hidden" name="id_hibah" value={{$id_hibah}}>
            <input type="hidden" name="kategori" value="Riset">

            <!--nanti ditentuin statusnya bakal apa-->
            <input type="hidden" name="status" value="">
            
              <!-- FIRST ROW = NAMA -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input placeholder="Nama Anda" id="nama" name="nama_pengaju" type="text" class="validate">
                  <label for="nama">Nama</label>
                </div>
              </div>

              <!-- SECOND ROW = NIP/NUP -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input placeholder="Masukan NIP/NUP Anda" id="nip/nup" name="nip/nup" type="text" class="validate">
                  <label for="nip/nup">NIP/NUP</label>
                </div>
              </div>

              <!-- THIRD ROW = EMAIL -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input placeholder="Email Anda" name="e-mail" id="email" type="email" class="validate">
                  <label for="email">Email</label>
                </div>
              </div>

              <!-- FOUR ROW = NOMOR HP -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input placeholder="Nomor HP Anda" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">Nomor HP</label>
                </div>
              </div>

              <!-- FIFTH ROW = JUDUL PROPOSAL -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input placeholder="Judul proposal yang diajukan" name="judul_proposal" id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Judul Proposal</label>
                </div>
              </div>


              
                <div class="file-field input-field col s6 offset-s3">
                  <div class="btn card-panel red darken-2">
                    <span class="white-text">File</span>
                    <input type="file" name="file">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                  </div>
                  <div class="center-align">
                <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action"><span class="white-text">Submit</span><i class="material-icons right">send</i>
                </button>
              </div>
                </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- END OF CONTENT BUAT HIBAH -->
  </div>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.js"></script>
  <script>
    $(document).ready(function() {
        $('select').material_select();
    });
  </script>
  @stop
</body>
</html>
