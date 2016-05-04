<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<!--CSS FOR MASTER DONT DELETE THIS -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/master.css') }}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
    <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
  <!--FOR MATERIALIZE DONT DELETE THIS-->

  {{-- SCRIPT OF JAVASCRIPT --}}
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
  });
  </script>
  {{-- END OF JAVASCRIPT --}}
</head>

<body>
{{-- <div style="width:15%">
 <ul class="collapsible" data-collapsible="accordion">
 	<li>
    <div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
  </li>
  <li>
    <div class="collapsible-header"><i class="material-icons">place</i>Second</div>
    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
  </li>
  <li>
    <div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>
    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
  </li>
 </ul>
</div> --}}

<div class="row center-align">
	<h3>LOGIN</h3>
	<form method="post" action="{{action('SSOController@index')}}" class="col s12" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<div class="row">			
			<div class="input-field col s4 offset-s4">
		    <input placeholder="Username" name="username" id="first_name" type="text" class="validate">
		  </div>
		</div>
		<div class="row">			
		  <div class="input-field col s4 offset-s4">
		    <input placeholder="Password" id="password" name="password" type="password" class="validate">
		  </div>
		</div>
		<div class="row">			
			<button class="btn waves-effect waves-light" type="submit" name="action">Submit
			  <i class="material-icons right">send</i>
			</button>
		</div>
	</form>
</div>
</body>
</html>