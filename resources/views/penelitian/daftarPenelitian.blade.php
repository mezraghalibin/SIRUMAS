
       <!-- {{-- CONTENT DAFTAR PENELITIAN --}}
       <div id="buat-penelitian-konten">
       <div class="container">
          <div class="header"><h4>Buat Penelitian</h4></div>
          <div class="hibah-riset-content">
             <div class="row">
            <form class="col s12">

              {{-- FIRST ROW = NAMA --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Judul penelitian" id="nama" name="nama_pengaju" type="text" class="validate">
                  <label for="nama">Judul Penelitian</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Ketua penelitian" id="nip/nup" name="nip/nup" type="text" class="validate">
                  <label for="nip/nup">Ketua Peneliti</label>
                </div>

              </div>

              {{-- SECOND ROW = JUDUL PROPOSAL --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Sumber dana penelitian" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Sumber Dana</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Nama anggota peneliti" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">Anggota Peneliti</label>
                </div>
                <label><button class="add_field_button btn-floating btn-large card-panel red darken-2">
                <i class="material-icons">add</i></button></label>
              </div>

                {{-- FOURTH ROW --}}
              <div class="row">
               <div class="input-field col s6 offset-s1">
                  <input placeholder="Besar dana" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Besar Dana</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Penerbit" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">Mahasiswa yang Terlibat</label>
                </div>
                <label><button class="add_field_button btn-floating btn-large card-panel red darken-2">
                <i class="material-icons">add</i></button></label>
              </div>


              {{-- FIFTH ROW --}}
              <div class="row">
                <div class="file-field input-field col s6 offset-s1">
                  <div class="btn">
                    <span class="white-text">File</span>
                    <input name="file" type="file" placeholder="Masukkan bukti kontrak penelitian">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Masukkan bukti artikel">
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