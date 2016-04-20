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
  	<title>HIBAH</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/pengumuman.css">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
    <!--FOR MATERIALIZE DONT DELETE THIS-->

    <script>
      $(document).ready(function(){
        $("#buat-pengumuman").hide();

        $("#kelola").click(function(){
            $("#kelola-pengumuman").fadeIn(500);
            $("#buat-pengumuman").hide();
        });

        $("#buat").click(function(){
            $("#buat-pengumuman").fadeIn(500);
            $("#kelola-pengumuman").hide();
        });
        $('select').material_select();
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
	            <li id="kelola"><a href="{{action('PengumumanController@index')}}">Kelola Pengumuman</a></li>
	            
	          </ul>
	          <ul class="right hide-on-med-and-down">
	            <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
	          </ul>
	        </div>
      	</nav>
      	{{-- END of SECOND NAVBAR --}}
		
		{{-- CONTENT KELOLA PENGUMUMAN --}}
		<div class="container">  
			<div id="kelola-pengumuman">
          		<div class="header"><h4>Kelola Pengumuman</h4></div>
          		{{-- ROW I --}}
		    	<div class="row">
			        <form class="col s12">
			            <div class="row">
			                <div class="input-field col s4">
			                  <input value="Hibah Riset UI 2015" id="judul_hibah" type="text" class="validate">
			                  <label class="active" for="judul_hibah">Judul</label>
			                </div>
			                <div class="input-field col s4">
			                  <input value="123456" id="nomor_hibah" type="text" class="validate">
			                  <label class="active" for="nomor_hibah">Nomor</label>
			                </div>
			                <div class="input-field col s2">
			                  <select>
				                  <option value="1">Riset</option>
				                  <option value="2">Pengmas</option>
			                  </select>
			                  <label>Ketegori</label>
			                </div>
		            	</div>
			        </form>
		      	</div>

		      	{{-- ROW II --}}
		      	<div class="row">
			        <form class="col s12">
			          	<div class="row">
				            <div class="input-field col s10">
				              <textarea id="konten_pengumuman_isi" class="materialize-textarea"></textarea>
				              <label for="konten_pengumuman_isi">Konten Pengumuman</label>
				            </div>
			          	</div>
			        </form>
			        <form action="#" class="col s5">
			          <div class="file-field input-field">
			            <div class="btn card-panel red darken-2">
			              <span class="white-text">File</span>
			              <input type="file" multiple>
			            </div>
			            <div class="file-path-wrapper">
			              <input class="file-path validate" type="text" placeholder="Upload one or more files">
			            </div>
			          </div>
			        </form>
			        <div class="col s12">
			          <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action"><span class="white-text">Simpan Pengumuman</span>
			          <i class="material-icons right">send</i>
			          </button>
			        </div>
		    	</div>
          	</div>
        </div>
        {{-- END OF CONTENT KELOLA PENGUMUMAN --}}
    </div>
    {{-- END OF PAGE CONTENT --}}
@stop
</body>
</html>
