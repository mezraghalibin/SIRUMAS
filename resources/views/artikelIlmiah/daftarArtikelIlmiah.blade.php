<!-- {{-- CONTENT DAFTAR BUKU --}}
       <div id="buat-buku-konten">
       <div class="container">
          <div class="header"><h4>Buat Buku</h4></div>
          <div class="hibah-riset-content">
             <div class="row">
            <form class="col s12">

              {{-- FIRST ROW = NAMA --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Judul buku" id="nama" name="nama_pengaju" type="text" class="validate">
                  <label for="nama">Judul</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Penulis utama" id="nip/nup" name="nip/nup" type="text" class="validate">
                  <label for="nip/nup">Penulis Utama</label>
                </div>

              </div>

              {{-- SECOND ROW = JUDUL PROPOSAL --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Penerbit" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Penerbit</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Penulis anggota (jika ada)" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">Penulis Anggota</label>
                </div>
                <label><button class="add_field_button btn-floating btn-large card-panel red darken-2">
                <i class="material-icons">add</i></button></label>
              </div>


              {{-- THIRD ROW --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Tahun terbit buku" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Tahun Terbit</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Nomor ISBN" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">ISBN</label>
                </div>
              </div>

              {{-- FOURTH ROW --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Tempat terbit buku" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Kota Terbit</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Jumlah halaman" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">Jumlah Halaman</label>
                </div>
              </div>

              {{-- FIFTH ROW --}}
              <div class="row">
                <div class="file-field input-field col s6 offset-s1">
                  <div class="btn">
                    <span class="white-text">File</span>
                    <input name="file" type="file" placeholder="Masukkan bukti halaman cover dan ISBN">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Masukkan bukti halaman cover dan ISBN">
                  </div>
                </div>
              </div>

              {{-- BUTTON SUBMIT --}}
              <div class="center-align">
                <button class="btn waves-effect waves-light" type="submit" name="action"><span class="white-text">Submit</span><i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
          </div>
          </div>
          <!-- END OF TABEL DAFTAR PROPOSAL -->