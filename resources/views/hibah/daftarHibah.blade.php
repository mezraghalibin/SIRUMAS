@extends('master')
<?php 
  //GET USER'S PROFILE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role']; 
?>

<!DOCTYPE html>
<html>
<head>
  <title>HIBAH</title>
  <link rel="author" href="humans.txt">
  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/hibah.css') }}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
  <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
  <!--FOR MATERIALIZE DONT DELETE THIS-->

  <script>
    $(document).ready(function(){
      //CLEAR FLASH MESSAGE
      $("#clear").click(function(){
        $("#flash-msg").fadeOut(1000);
      });

      //DATE PICKER
      $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
      });

      //INPUT ID STAF RISET PENGUPLOAD HIBAH
      var id_staf = "<?php echo $id ?>";
      document.getElementById('staf_riset').value = id_staf;
    });
  </script>
</head>
<body>
  @section('main_content')
  {{-- PAGE CONTENT --}}
  <div class="page-content">
    {{-- CONTENT SECOND NAVBAR --}}
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
          @if($spesifik_role == 'dosen')
            <li id="daftar"><a href="/hibah/daftarHibah">Daftar Hibah</a></li>
          @endif
          @if($spesifik_role == 'divisi riset')
            <li id="kelola"><a href="/hibah/kelolaHibah">Kelola Hibah</a></li>
            <li id="buat"><a href="/hibah/buatHibah">Buat Hibah</a></li>
          @endif
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a id="user" href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF CONTENT SECOND NAVBAR --}}

    {{-- FLASH MESSAGE --}}
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
    {{-- END OF FLASH MESSAGE --}}
    
    {{-- CONTENT DAFTAR HIBAH --}}
    <div class="container">
      <div id="daftar-hibah">
        <div class="header"><h4>Daftar Hibah</h4></div>
        <div class="daftar-content">
          <table class="highlight centered">
            <tbody>
              @if (count($dataHibah))
                @foreach ($dataHibah as $hibah)
                  @if ($hibah->status === 1) {{-- IF PUBLISH MUNCUL --}}
                    <tr>
                      <td>{{ $hibah->nama_hibah }}</td>
                      <td><a href="/hibah/applyHibah/{{$hibah->id}}" class="waves-effect waves-light btn card-panel teal darken-2"><span class="white-text">Info & Daftar</span></a></td>
                    </tr>
                  @endif
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{-- END OF CONTENT DAFTAR HIBAH --}}
    <div class="center-align">
      {!! $dataHibah->render() !!}
    </div>

  </div>
  {{-- END OF PAGE CONTENT --}}
  
  <script>
  $(document).ready(function() {
      $('select').material_select();  //FOR FORM SELECT
      $('.modal-trigger').leanModal(); //FOR MODAL
  });
  </script>
  @stop
</body>
</html>
