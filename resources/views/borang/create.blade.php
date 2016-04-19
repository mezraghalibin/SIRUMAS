
 <h1>Buat Borang Baru</h1>
    <hr/>

    <form class="action" action="/borang" method="post">
      <input type="text" name="nama_komp" value="" placeholder="Isi komponen"><br>
      {{ ($errors->has('nama_komp')) ? $errors->first('komponen') : '' }}<br>
      <input type="text" name="nilai" value="" placeholder="Isi bobot"><br>
      {{ ($errors->has('nilai')) ? $errors->first('nilai') : '' }}<br>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="submit" name="name" value="post">
    </form>



