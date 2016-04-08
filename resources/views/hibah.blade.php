@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>HIBAH</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="author" href="humans.txt">
    <link rel="stylesheet" href="assets/css/hibah.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Josefin+Slab:600' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function(){
        $("#buat-hibah").hide();

        $("#kelola").click(function(){
            $("#kelola-hibah").fadeIn(500);
            $("#buat-hibah").hide();
        });

        $("#buat").click(function(){
            $("#buat-hibah").fadeIn(500);
            $("#kelola-hibah").hide();
        });
      });
    </script>
</head>
<body>
  @section('main_content')
  <div class="wrapper">

  <!-- SECOND NAVBAR -->
    <div class="page-content-wrapper">
      <nav class="navbar navbar-content">
        <div class="container-fluid border-bottom-box">
          <ul class="nav navbar-nav">
            <li id="kelola"><a href="#">Kelola Hibah</a></li>
            <li id="buat"><a href="#">Buat Hibah</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right menu">
            <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
          </ul>
        </div>
      </nav>
  <!-- END of SECOND NAVBAR -->

      <!-- CONTENT KELOLA HIBAH -->
      <div class="content container-fluid">
        <div id="kelola-hibah">
          <div class="header">KELOLA HIBAH</div>
          <div class="kelola-content">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Nama Hibah</th>
                  <th>Kategori</th>
                  <th>Pemberi</th>
                  <th>Besar Dana</th>
                  <th>Periode</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Universitas Indonesia Hibah</td>
                  <td>Hibah</td>
                  <td>Garuda Indonesia</td>
                  <td>RP. 150.000.000</td>
                  <td>11/04/2015 - 11/05/2016</td>
                  <td>
                    <button type="button" class="btn btn-default btn-sm">
                      Hapus 
                    </button>
                    <div class="divider"></div>
                    <button type="button" class="btn btn-default btn-sm">
                        Rubah
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- END OF CONTENT KELOLA HIBAH -->

      <!-- CONTENT BUAT HIBAH -->
      <div class="content container-fluid">
        <div id="buat-hibah">
            <div class="header">BUAT HIBAH</div>
              <div class="buat-content"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- END OF CONTENT BUAT HIBAH -->
    </div>
  </div>
  @stop
</body>
</html>
