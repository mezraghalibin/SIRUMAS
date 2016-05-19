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
  <title>MoU</title>
    <meta charset="utf-8">
    <link rel="author" href="humans.txt">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/mou.css') }}">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!--FOR MATERIALIZE DONT DELETE THIS-->

    <script>
    $(document).ready(function(){
      //FUNCTION CLEAR
      $("#clear").click(function(){
        $("#flash-msg").fadeOut(1000);
      });

      //INPUT NAMA STAF RISET PENGUPLOAD MOU
      var id_staf = "<?php echo $id ?>";
      document.getElementById('staf_riset').value = id_staf;
    });
    </script>
</head>
<body>
@section('main_content')
  <div class="page-content">
    {{-- NAVBAR EVERY PAGE --}}
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
          <li id="kelola"><a href="/mou/upload">Upload MoU</a></li>
          <li id="buat"><a href="/mou/arsip">Arsip MoU</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF NAVBAR EVERY PAGE --}}

    {{-- CONTENT ARSIP MOU --}}
    <div class="container">
      <div id="arsip-mou">
        <div class="header"><h5>Arsip MoU</h5></div>
        <div id="flash-msg">
          @if(Session::has('flash_message'))
            <div class="card-panel teal darken-2">
              <span class="white-text">{{ Session::get('flash_message') }}</span>
              <a id="clear" class="collection-item" style="cursor:pointer">
              <i class="material-icons white right">clear</i></a>
            </div>
          @endif
        </div>
          <table class="highlight centered">
            <thead>
              <tr>
                <th>Judul</th>
                <th>Peneliti</th>
                <th>Created</th>
                <th>Updated By</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @if (count($dataMoU))
                @foreach ($dataMoU as $MoU)
                  <tr>
                    <td>{{ $MoU->judul }}</td>
                    <td>{{ $MoU->peneliti }}</td>
                    <td>{{ $MoU->nama }}</td>
                    <td>{{ $MoU->updated_by }}</td>
                    <td>
                      <a class="btn-floating" href="<?php echo "/upload/MoU/" . $MoU->file;?>">
                        <i class="material-icons right">file_download</i></a>
                    </td>
                    <td>
                      <a class="btn-floating" href="/mou/update/{{$MoU->id}}">
                        <i class="material-icons right">mode_edit</i></a>
                    </td>
                    <td> {{-- BUTTON ICON UNTUK HAPUS HIBAH --}}
                      <!-- Modal Trigger -->
                      <button data-target="modal{{$MoU->id}}" class="btn-floating modal-trigger">
                        <i class="material-icons right">delete</i>
                      </button>
                      <!-- Modal Structure -->
                      <div id="modal{{$MoU->id}}" class="modal">
                        <div class="modal-content">
                          <h4>Hapus {{$MoU->judul}} ?</h4>
                          <p>MoU akan dihapus secara permanen</p>
                        </div>
                        <div class="modal-footer center-align">
                          <a href="/mou/delete/{{$MoU->id}}" class="modal-action modal-close btn-flat">Ya</a>
                          <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
      </div>
    </div>
    {{-- END OF CONTENT ARSIP MOU --}}
  </div>
  <script>
    $(document).ready(function() {
      $('select').material_select();  //FOR FORM SELECT
      $('.modal-trigger').leanModal(); //FOR MODAL
    });
  </script>
@stop
</body>
</html>
