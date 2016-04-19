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
  <title>BORANG</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/hibah.css">
    <link rel="stylesheet" href="assets/css/borang.css">
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
      $(document).ready(function(){
        $("#buat-borang").hide();

        $("#kelola").click(function(){
            $("#kelola-borang").fadeIn(500);
            $("#buat-borang").hide();
        });

        $("#buat").click(function(){
            $("#buat-borang").fadeIn(500);
            $("#kelola-borang").hide();
        });

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
  <div class="page-content">
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
          <li id="kelola"><a href="#">Kelola Borang</a></li>
          <li id="buat"><a href="#">Buat Borang</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai <?php echo $username ?> - <?php echo $spesifik_role ?></a></li>
        </ul>
      </div>
    </nav>

    <!-- CONTENT BUAT BORANG -->
    <div class="container">
    <div id="buat-borang">
      <div class="header"><h4>Buat Borang</h4></div>

      @if(Session::has('flash_message'))
        <div class="card-panel red darken-2">
          <span class="white-text alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</span>
        </div>
      @endif

      <div class="kelola-content">
        <form class="action" action="borang" method="post">
         
          <div class="input_fields_wrap">
            <button class="add_field_button btn-floating btn-large card-panel red darken-2"><i class="material-icons">add</i></button>
            <div class="col s6"><input type="text" name="komponen[]" value="" placeholder="Isi komponen" class="validate">
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
           
          </div>
          <div align="center"><button class="btn waves-effect waves-light card-panel red darken-2" type="submit" value="post"><span class="white-text">Simpan Borang</span><i class="material-icons right">send</i></button></div>
    
        </form>
          </div>
      </div>
      </div>
      <!-- END OF CONTENT BUAT BORANG -->

      <!-- CONTENT KELOLA BORANG -->
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
                      <form class="" action="/hapusborang/{{$borang->id}}" method="post">
                      
                       <!-- Modal Trigger -->
                      <button data-target="modal{{$borang->id}}" class="btn btn modal-trigger" type="submit" value="post">Hapus</button>
                      <!-- Modal Structure -->
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
                      </button>
                      
                      </form>
                      </td>
                      <td>
                      <button class="btn" type="submit" id="edit">
                        <a class="white-text" href="/editborang/{{$borang->id}}">Edit</a>
                        </button>
                      </td>
                  </tr>

              @endforeach
              
          </table>
        </div>
      </div>
      <!-- END OF CONTENT KELOLA BORANG -->

  </div>

  <div>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
      <script>
        $(document).ready(function() {
          $('.modal-trigger').leanModal();
        });
      </script>
  </div>

  @stop
</body>
</html>
