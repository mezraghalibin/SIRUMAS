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
  <title>BORANG</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/borang.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/hibah.css') }}">
    <!--<link rel="stylesheet" href="assets/css/buatButton.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

     <script>
      $(document).ready(function(){
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
          <li id="kelola"><a href="/borang/kelolaborang">Kelola Borang</a></li>
          <li id="buat"><a href="/borang/buatborang">Buat Borang</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- CONTENT BUAT BORANG --}}
    <div class="container">
      <div id="buat-borang">
        <div class="header"><h4>Buat Borang</h4></div>
        <div id="flash-msg">
          @if(Session::has('flash_message'))
            <div class="card-panel teal darken-2">
              <span class="white-text">{{ Session::get('flash_message') }}</span>
              <a id="clear" class="collection-item" style="cursor:pointer">
              <i class="material-icons white right">clear</i></a>
            </div>
          @endif
        </div>
        <div class="kelola-content">
          <form class="action" action="/borang/create" method="post">
            <div class="input_fields_wrap">
              <button class="add_field_button btn-floating btn-large card-panel teal darken-2" type="submit">
                <i class="material-icons">add</i></button>
              <div class="col s6"><input type="text" name="komponen[]" 
                value="" placeholder="Isi komponen" class="validate">
              </div>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
            <div align="center">
              <button class="btn waves-effect waves-light card-panel teal darken-2"  value="post">
              <span class="white-text">Simpan</span><i class="material-icons right">send</i></button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- END OF CONTENT BUAT BORANG --}}
  </div>

  <div>
    <script>
      $(document).ready(function() {
        $('.modal-trigger').leanModal();
      });
    </script>
  </div>
  @stop
</body>
</html>
