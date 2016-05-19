<?php $count = 1 ?>
            @foreach($dataBuku as $buku)
              @if($count == 1)
                <div class="row">
              @endif

              {{-- CONTENT --}}
              <div class="col s6 buku">
                <div class="col s3 left-row">
                  
                </div>
                <div class="col s8 right-row">
                  <div class="judul truncate">{{ $buku->judul }}</div>
                  <div class="Penulis truncate">{{ $buku->penulis }}</div>
                  <div class="penerbit truncate">Penerbit/Tahun  : {{ $buku->penerbit . "/" . $buku->tahun }}</div>
                  <div class="button right">
                    {{-- MODAL DELETE BUKU --}}
                    <button data-target="modal{{$buku->id}}" class="btn-floating btn modal-trigger">
                      <i class="material-icons right">delete</i>
                    </button>
                    {{-- MODAL STRUCTURE DELETE BUKU --}}
                    <div id="modal{{$buku->id}}" class="modal">
                      <div class="modal-content">
                        <h4>Hapus {{$buku->judul}}?</h4>
                        <p>Buku akan dihapus secara permanen</p>
                      </div>
                      <div class="modal-footer center-align">
                        <a href="/kelolaRepository/buku/delete/{{$buku->id}}" class="modal-action modal-close btn-flat">Ya</a>
                        <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                      </div>
                    </div>
                    {{-- END OF MODAL DELETE BUKU --}}

                    {{-- MODAL DETAIL BUKU --}}
                    <button data-target="modal{{$buku->id}}detail" class="btn-floating btn modal-trigger">
                      <i class="material-icons right">info</i>
                    </button>
                    {{-- MODAL STRUCTURE DETAIL BUKU --}}
                    <div id="modal{{$buku->id}}detail" class="modal modal-fixed-footer">
                      <div class="modal-content">
                        <h4>Detail Buku</h4>
                        Judul       : {{ $buku->judul }} <br>
                        ISBN        : {{ $buku->isbn }} <br>
                        Halaman     : {{ $buku->halaman }} <br>
                        Penulis     : {{ $buku->penulis }} <br>
                        Penerbit    : {{ $buku->penerbit }} <br>
                        Tahun Terbit: {{ $buku->tahun }} <br>
                        Sampul Buku : <br>
                        <img src="../../upload/buku/{{ $buku->sampul }}" alt="sampul" class="materialboxed">
                      </div>
                      <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Tutup</a>
                      </div>
                    </div>
                    {{-- END OF MODAL DETAIL BUKU --}}

                    {{-- BUTTON FOR EDIT PAGE --}}
                    <a class="btn-floating" href="/kelolaRepository/buku/edit/{{$buku->id}}">
                      <i class="material-icons right">mode_edit</i></a>
                    {{-- END OF BUTTON EDIT PAGE --}}
                  </div>
                </div>
              </div>
              {{-- END OF CONTENT --}}

              @if($count == 2)
                <?php $count = 1?>
                </div>
              @else
                <?php $count = 2?>
              @endif
            @endforeach