
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
  <title>EDIT BORANG</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/hibah.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/borang.css') }}">
    <!--<link rel="stylesheet" href="assets/css/buatButton.css">-->

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
      var max_fields      = 10; //maximum input boxes allowed
      var wrapper         = $(".input_fields_wrap"); //Fields wrapper
      var add_button      = $(".add_field_button"); //Add button ID
      
      var x = 1; //initlal text box count
      $(add_button).click(function(e){ //on add input button click
          e.preventDefault();
          if(x < max_fields){ //max input box allowed
              x++; //text box increment
              $(wrapper).append('<div class="col s6"><input type="text" name="komponen[]" value="" placeholder="Isi komponen" class="validate"><a href="#" class="remove_field">Hapus</a></div></div>'); //add input box
          }
      });
      
      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
          e.preventDefault(); $(this).parent('div').remove(); x--;
      })
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
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- CONTENT EDIT BORANG --}}
    <div class="container">
      <div id="buat-borang">
        <div class="header"><h4>Edit Borang</h4></div>
        <div class="kelola-content">
          <form class="" action="/editborang/{{$borang->id}}" method="post">
            <div class="input_fields_wrap">
              <div class="col s6">
                <input type="text" name="komponen" value="{{$borang->komponen}}" placeholder="Isi komponen" class="validate">
              </div>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
            <div align="center">
              <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" value="post">
              <span class="white-text">Simpan Borang</span><i class="material-icons right">send</i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- END OF CONTENT EDIT BORANG --}}
  </div>
  {{-- END OF PAGE CONTENT --}}
  @stop
</body>
</html>
