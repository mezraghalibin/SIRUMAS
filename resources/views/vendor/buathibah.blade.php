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
	<title></title>
</head>
<body>
	@yield('buat_hibah_content')
		{{-- FLASH MESSAGE AFTER UPLOAD MOU --}}
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
		{{-- END OF FLASH MESSAGE AFTER UPLOAD MOU --}}

		{{-- CONTENT BUAT HIBAH --}}
		<div class="container">
		  <div id="buat-hibah">
		    <div class="header"><h4>Buat Hibah</h4></div>
		    <div class="buat-content">
		      <div class="row">
		        <form method="post" action="createhibah" class="col s12" enctype="multipart/form-data">
		          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		          {{-- FIRST ROW = CATEGORY, TIME START, TIME END --}}
		          <div class="row">                
		            <div class="input-field col s6">
		              <select name="kategori_hibah">
		                <option value="" disabled selected>Kategori</option>
		                <option value="Riset">Riset</option>
		                <option value="Pengmas">Pengmas</option>
		              </select>
		            </div>
		            <div class="input-field col s3">
		              <input type="date" name="tgl_awal" class="datepicker">
		              <label>Waktu Mulai</label>
		            </div>
		            <div class="input-field col s3">
		              <input type="date" name="tgl_akhir" class="datepicker">
		              <label>Waktu Selesai</label>
		            </div>
		          </div>

		          {{-- SECOND ROW = NAMA --}}
		          <div class="row">
		            <div class="input-field col s12">
		              <input placeholder="Nama" id="nama" name="nama_hibah" type="text" class="validate">            
		              <label for="nama">Nama Hibah</label>
		            </div>
		          </div>

		          {{-- THIRD ROW = BESAR DANA --}}
		          <div class="row">
		            <div class="input-field col s12">
		              <input placeholder="Tuliskan Nominalnya Saja" id="besarDana" name="besar_dana" type="text" class="validate">
		              <label for="nama">Besar Dana</label>
		            </div>
		          </div>

		          {{-- FOUR ROW = PEMBERI DANA --}}
		          <div class="row">
		            <div class="input-field col s12">
		              <input placeholder="Pemberi Dana" id="pemberiDana" name="pemberi" type="text" class="validate">
		              <label for="nama">Pemberi Dana Hibah</label>
		            </div>
		          </div>

		          {{-- FIFTH ROW = DESKRIPSI --}}
		          <div class="row">
		            <div class="input-field col s12">
		              <textarea placeholder="Deskripsi Hibah" id="deskripsi" name="deskripsi" class="materialize-textarea"></textarea>
		              <label for="deksripsi">Deskripsi</label>
		            </div>
		          </div>

		          {{-- INPUT ID OF STAF RISET --}}
		          <div class="row">
		            <div class="input-field col s6 offset-s3">
		              <input type="hidden" id="staf_riset" name="staf_riset" value="">
		            </div>
		          </div>

		          {{-- BUTTON SUMBIT --}}
		          <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action"><span class="white-text">Submit</span>
		            <i class="material-icons right">send</i>
		          </button>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>
		{{-- END OF CONTENT BUAT HIBAH --}}
</body>
</html>