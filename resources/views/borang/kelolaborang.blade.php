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

    <!-- CSS FOR PAGE BORANG -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/borang.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/hibah.css') }}">
    <!--<link rel="stylesheet" href="assets/css/buatButton.css">-->

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
          <li id="kelola"><a href="/borang/editborang">Kelola Borang</a></li>
          <li id="buat"><a href="/borang/buatborang">Buat Borang</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- CONTENT KELOLA BORANG --}}
    <div class="container">
      <div id="kelola-borang">
      <div class="header"><h4>Kelola Borang</h4></div>
        @if(Session::has('flash_message'))
          <div class="card-panel red darken-2">
            <span class="white-text">{{ Session::get('flash_message') }}</span>
          </div>
        @endif
        <table>
          <thead>
              <th>ID Komponen</th>
              <th>Nama Komponen</th>
          </thead>
          @foreach($borangs as $borang)
            <tr>
              <td>{{ $borang->id }}</td>
              <td>{{ $borang->komponen }}</td>
              <td>
                <form class="" action="/borang/hapusborang/{{$borang->id}}" method="post">
                  {{-- Modal Trigger --}}
                  <button data-target="modal{{$borang->id}}" class="btn btn modal-trigger card-panel red darken-2" 
                    type="submit" value="post">Hapus</button>
                  {{-- Modal Structure --}}
                  <div id="modal{{$borang->id}}" class="modal">
                    <div class="modal-content">
                      <h4>Hapus Pengumuman?</h4>
                      <p>Pengumuman akan dihapus</p>
                    </div>
                    <div class="modal-footer">
                      <input type="submit" name="name" value="Hapus" class="btn">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="" value="Tidak" class="modal-close btn">    
                    </div>
                  </div>
                </form>
              </td>
              <td>
                <button class="btn card-panel red darken-2" type="submit" id="edit">
                  <a class="white-text" href="/borang/editborang/{{$borang->id}}">Edit</a>
                </button>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
    {{-- END OF CONTENT KELOLA BORANG --}}
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
