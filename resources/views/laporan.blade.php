<?php 
  //CHECK USER'S ROLE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role'];
  //$id_proposal    = $_SESSION['id_proposal']; buat masukin id proposal
?>

@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>LAPORAN</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/laporan.css">

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

      $role="<?php echo $spesifik_role ?>";
      if ($role="dosen") {
        $("#laporan-tidak-berhibah").hide();
        $("#laporan-berhibah").hide();
        $("#upload-laporan-akhir").hide();
        $("#berhibah").hide();
        $("#tidak-hibah").hide();
      } 

        $("#berhibah").click(function(){
            $("#laporan-berhibah").fadeIn(500);
            $("#laporan-tidak-berhibah").hide();
            $("#upload-laporan-kemajuan").hide();
            $("#upload-laporan-akhir").hide();
        });

        $("#tidak-hibah").click(function(){
            $("#laporan-tidak-berhibah").fadeIn(500);
            $("#laporan-berhibah").hide();
            $("#upload-laporan-kemajuan").hide();
            $("#upload-laporan-akhir").hide();
        });

         $("#upload-kemajuan").click(function(){
            $("#upload-laporan-kemajuan").fadeIn(500);
            $("#laporan-berhibah").hide();
            $("#laporan-tidak-berhibah").hide();
            $("#upload-laporan-akhir").hide();
        });

          $("#upload-akhir").click(function(){
            $("#upload-laporan-akhir").fadeIn(500);
            $("#laporan-berhibah").hide();
            $("#upload-laporan-kemajuan").hide();
            $("#laporan-tidak-berhibah").hide();
        });

          $('tr').click( function() {
    window.location = $(this).find('a').attr('href');
}).hover( function() {
    $(this).toggleClass('hover');
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
          <li id="berhibah"><a href="#">Laporan Berhibah</a></li>
          <li id="tidak-hibah"><a href="#">Laporan Tidak Berhibah</a></li>
          <li id="upload-kemajuan"><a href="#">Upload Laporan Kemajuan</a></li>
          <li id="upload-akhir"><a href="#">Upload Laporan Akhir</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
        </ul>
      </div>
    </nav>

    <!-- CONTENT LAPORAN BERHIBAH -->
    <div class="container">
      <div id="laporan-berhibah">
        <div class="header"><h4>Pilih Hibah</h4></div>
          <div class="berhibah-content">
            <table class="highlight centered">
             <tbody>
                <tr>
                  <td><a href="{{action('LaporanController@laporankemajuan')}}">Hibah Riset UI 2015</a></td>
                </tr>
                 <tr>
                  <td><a href="{{action('LaporanController@laporankemajuan')}}">Hibah Riset UI 2014</a></td>
                </tr>
                 <tr>
                  <td><a href="{{action('LaporanController@laporankemajuan')}}">Hibah Riset UI 2013</a></td>
                </tr>             
              </tbody>
            </table>
          </div>
      </div>
    </div>
      <!-- END OF CONTENT LAPORAN BERHIBAH -->

    <!-- CONTENT tidak-hibah HIBAH -->
    <div class="container">
      <div id="laporan-tidak-berhibah">
      <div class="header"><h4>Laporan Akhir</h4></div>
          <div class="kemajuan-content">
           <table class="highlight centered">
              <thead>
                <tr>
                    <th data-field="id">Judul Laporan</th>
                    <th data-field="name">Pengaju</th>
                    <th data-field="price">Tanggal Submit</th>
                    <th data-field="price">File</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td>Hibah Riset 2015</td>              
                  <td>Milki</td>
                  <td>11/04/2015</td>
                  <td>
                    <a class="waves-effect waves-teal btn-flat"><i class="material-icons">system_update_alt</i></a>
                  </td>
                </tr>
                <tr>
                  <td>Hibah Riset 2015</td>
                  <td>Rangga</td>
                  <td>11/04/2015</td>
                  <td>
                    <a class="waves-effect waves-teal btn-flat"><i class="material-icons">system_update_alt</i></a>
                  </td>
                </tr>
                <tr>
                  <td>Hibah Riset 2016</td>
                  <td>Cinta</td>
                  <td>11/04/2015</td>
                  <td>
                    <a class="waves-effect waves-teal btn-flat"><i class="material-icons">system_update_alt</i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
    </div>
    <!-- END OF CONTENT tidak-hibah HIBAH -->


    <div class="container">
      <div id="upload-laporan-kemajuan">
        <div class="header"><h4>Judul Proposal Terkait</h4></div>
           @if(Session::has('flash_message'))
              <div class="card-panel red darken-2">
                <span class="white-text">{{ Session::get('flash_message') }}</span>
              </div>

          @endif
          <div class="kemajuan-content">
          <table>
              <thead>
                  <th>Judul Proposal</th>
                  <th>Kategori</th>
                  <th>Status</th>
              </thead>

              @foreach($proposals as $proposal)

                  <tr>
                      <td>{{ $proposal->judul_proposal }}</td>
                      <td>{{ $proposal->kategori }}</td>
                      <td>{{ $proposal->status }}</td>
                      <td>
                      <button class="btn" type="submit" id="edit">
                        <a class="white-text" href="/uploadkemajuan/{{$proposal->id}}">Upload</a>
                        </button>
                      </td>
                  </tr>

              @endforeach
              
          </table>

          </div>
      </div>
    </div>

     <div class="container">
      <div id="upload-laporan-akhir">
        <div class="header"><h4>Pilih Hibah</h4></div>

          <div class="row">
              <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                  <div align="center">
                  <div class="card-content white-text">
                    <span class="card-title">Laporan Berhibah</span>
                    <p>Klik link di bawah ini jika Anda telah mendapatkan hibah dan ingin meng-upload laporan akhir.</p>
                  </div>
                  <div class="card-action">
                    <a href="{{action('LaporanController@uploadlaporanberhibah')}}">Laporan Berhibah</a>
                  </div>
                </div>
              </div>
            </div>
           </div>

           <div class="row">
              <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                  <div align="center">
                  <div class="card-content white-text">
                    <span class="card-title">Laporan Tidak Berhibah</span>
                    <p>Klik link di bawah ini jika Anda ingin meng-upload laporan akhir tanpa hibah.</p>
                  </div>
                  <div class="card-action">
                    <a href="{{action('LaporanController@uploadlaporantdkberhibah')}}">Laporan Tidak Berhibah</a>
                  </div>
                </div>
              </div>
            </div>
           </div>
          </div>
          </div>



    </div>
  @stop
</body>
</html>
