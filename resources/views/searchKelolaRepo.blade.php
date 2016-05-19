<?php 
  //CHECK USER'S ROLE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role'];
?>

@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>KELOLA REPORSITORY</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/repository.css') }}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
  <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> 
  <!--FOR MATERIALIZE DONT DELETE THIS-->

  <script>
    $(document).ready(function(){
      
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
          <li id="kelola"><a href="/kelolaRepository">Kembali</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- SEARCH --}}
    <div class="container">
      <div id="search-kelola-repository">
        @if ($kategori == "publikasi")
          <div class="header"><h4>Hasil Search Publikasi</h4></div>
        @elseif ($kategori == "kegiatan")
          <div class="header"><h4>Hasil Search Kegiatan</h4></div>
        @endif
        <div class="search-kelola-repository-content row">
          <div class="col s12">
            <div class="row">
              @if($kategori == "publikasi")
                {{-- CONTENT SEARCH BUKU --}}
                @foreach($dataBuku as $buku)
                <div class="col s12 m6">
                  <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                      <span class="card-title">{{ $buku->judul }}</span>
                      <p>
                        <div class="Penulis truncate">Penulis : {{ $buku->penulis }}</div>
                        {{-- GET ALL ANGGOTA FROM SPECIFIC BUKU --}}
                        <?php 
                          $anggotas = $buku::find($buku->id)->getPenulis;
                          $list = ""; 
                        
                          foreach ($anggotas as $anggota) {
                            $list = $list . $anggota->nama_anggota . ", " ;
                          }
                        ?>
                        <div class="anggota truncate">Anggota  : <?php echo substr($list, 0, -2) ?></div>
                        {{-- END OF GET ALL EXPERTISE --}}
                        <div class="penerbit truncate">Penerbit/Tahun  : {{ $buku->penerbit . "/" . $buku->tahun }}</div>
                        <div class="kategori truncate">Kategori : Buku</div>
                        <div class="nav-link right-align">
                          {{-- BUTTON FOR EDIT PAGE --}}
                          <a class="btn-floating" href="/kelolaRepository/buku/edit/{{$buku->id}}">
                            <i class="material-icons right">mode_edit</i></a>
                          {{-- END OF BUTTON EDIT PAGE --}}

                          {{-- MODAL DETAIL BUKU --}}
                          <button data-target="modal{{$buku->id}}detail" class="btn-floating btn modal-trigger">
                            <i class="material-icons right">info</i>
                          </button>
                          {{-- MODAL STRUCTURE DETAIL BUKU --}}
                          <div id="modal{{$buku->id}}detail" class="modal modal-fixed-footer">
                            <div class="modal-content left-align" style="color:black;">
                              <h4>Detail Buku</h4>
                              Judul       : {{ $buku->judul }} <br>
                              ISBN        : {{ $buku->isbn }} <br>
                              Halaman     : {{ $buku->jumlah_hlm }} <br>
                              Penulis     : {{ $buku->penulis }} <br>
                              Anggota     : <?php echo substr($list, 0, -2) ?> <br>
                              Penerbit    : {{ $buku->penerbit }} <br>
                              Tahun Terbit: {{ $buku->tahun }} <br>
                              Sampul Buku : <br>
                              <img src="../../upload/buku/{{ $buku->sampul }}" width="700" class="materialboxed">
                            </div>
                            <div class="modal-footer">
                              <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Tutup</a>
                            </div>
                          </div>
                          {{-- END OF MODAL DETAIL BUKU --}}

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
                        </div>
                      </p>
                    </div>
                  </div>
                </div>
                @endforeach

                {{-- CONTENT SEARCH ARTIKEL IlMIAH --}}
                @foreach($dataArtikelIlmiah as $artikelIlmiah)
                <div class="col s12 m6">
                  <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                      <span class="card-title">{{ $artikelIlmiah->judul }}</span>
                      <p>
                        <div class="Penulis truncate">Penulis : {{ $artikelIlmiah->penulis_utama }}</div>
                        {{-- GET ALL ANGGOTA FROM SPECIFIC BUKU --}}
                        <?php 
                          $anggotas = $artikelIlmiah::find($artikelIlmiah->id)->getAnggota;
                          $list = ""; 
                        
                          foreach ($anggotas as $anggota) {
                            $list = $list . $anggota->nama_anggota . ", " ;
                          }
                        ?>
                        <div class="anggota truncate">Anggota  : <?php echo substr($list, 0, -2) ?></div>
                        {{-- END OF GET ALL EXPERTISE --}}
                        <div class="penerbit truncate">Penerbit/Tahun  : 
                          {{ $artikelIlmiah->penerbit . "/" . $artikelIlmiah->tahun }}</div>
                        <div class="kategori truncate">Kategori : Artikel Ilmiah</div>
                        <div class="nav-link right-align">
                          {{-- BUTTON FOR EDIT PAGE --}}
                          <a class="btn-floating" href="/kelolaRepository/artikelIlmiah/edit/{{$artikelIlmiah->id}}">
                            <i class="material-icons right">mode_edit</i></a>
                          {{-- END OF BUTTON EDIT PAGE --}}

                          {{-- MODAL DETAIL BUKU --}}
                          <button data-target="modal{{$artikelIlmiah->id}}detail" class="btn-floating btn modal-trigger">
                            <i class="material-icons right">info</i>
                          </button>
                          {{-- MODAL STRUCTURE DETAIL BUKU --}}
                          <div id="modal{{$artikelIlmiah->id}}detail" class="modal modal-fixed-footer">
                            <div class="modal-content left-align" style="color:black;">
                              <h4>Detail Artikel Ilmiah</h4>
                              Judul       : {{ $artikelIlmiah->judul }} <br>
                              ISSN        : {{ $artikelIlmiah->issn }} <br>
                              Level       : {{ $artikelIlmiah->level }} <br>
                              Penulis     : {{ $artikelIlmiah->penulis_utama }} <br>
                              Anggota     : <?php echo substr($list, 0, -2) ?> <br>
                              No/Vol/Hal  : {{ $artikelIlmiah->no . "/" . $artikelIlmiah->volume . 
                                "/" . $artikelIlmiah->halaman }} <br>
                              Penerbit/Tahun : {{ $artikelIlmiah->penerbit . "/" . $artikelIlmiah->tahun}} <br>
                              URL         : {{ $artikelIlmiah->url }}
                            </div>
                            <div class="modal-footer">
                              <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Tutup</a>
                            </div>
                          </div>
                          {{-- END OF MODAL DETAIL BUKU --}}

                          {{-- MODAL DELETE BUKU --}}
                          <button data-target="modal{{$artikelIlmiah->id}}" class="btn-floating btn modal-trigger">
                            <i class="material-icons right">delete</i>
                          </button>
                          {{-- MODAL STRUCTURE DELETE BUKU --}}
                          <div id="modal{{$artikelIlmiah->id}}" class="modal">
                            <div class="modal-content">
                              <h4>Hapus {{$artikelIlmiah->judul}}?</h4>
                              <p>Buku akan dihapus secara permanen</p>
                            </div>
                            <div class="modal-footer center-align">
                              <a href="/kelolaRepository/artikelIlmiah/delete/{{$artikelIlmiah->id}}" 
                                class="modal-action modal-close btn-flat">Ya</a>
                              <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                            </div>
                          </div>
                          {{-- END OF MODAL DELETE BUKU --}}
                        </div>
                      </p>
                    </div>
                  </div>
                </div>
                @endforeach

                {{-- CONTENT SEARCH ARTIKEL POPULER --}}
                @foreach($dataArtikelPopuler as $artikelPopuler)
                <div class="col s12 m6">
                  <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                      <span class="card-title">{{ $artikelPopuler->judul }}</span>
                      <p>
                        <div class="Penulis truncate">Penulis : {{ $artikelPopuler->penulis_utama }}</div>
                        {{-- GET ALL ANGGOTA FROM SPECIFIC ARTIKEL POPULER --}}
                        <?php 
                          $anggotas = $artikelPopuler::find($artikelPopuler->id)->getAnggota;
                          $list = ""; 
                        
                          foreach ($anggotas as $anggota) {
                            $list = $list . $anggota->nama_anggota . ", " ;
                          }
                        ?>
                        <div class="anggota truncate">Anggota  : <?php echo substr($list, 0, -2) ?></div>
                        {{-- END OF GET ALL EXPERTISE --}}
                        <div class="penerbit truncate">Penerbit/Tahun  : 
                          {{ $artikelPopuler->penerbit . "/" . $artikelPopuler->tahun }}</div>
                        <div class="kategori truncate">Kategori : Artikel Populer</div>
                        <div class="nav-link right-align">
                          {{-- BUTTON FOR EDIT PAGE --}}
                          <a class="btn-floating" href="/kelolaRepository/artikelPopuler/edit/{{$artikelPopuler->id}}">
                            <i class="material-icons right">mode_edit</i></a>
                          {{-- END OF BUTTON EDIT PAGE --}}

                          {{-- MODAL DETAIL BUKU --}}
                          <button data-target="modal{{$artikelPopuler->id}}detail" class="btn-floating btn modal-trigger">
                            <i class="material-icons right">info</i>
                          </button>
                          {{-- MODAL STRUCTURE DETAIL BUKU --}}
                          <div id="modal{{$artikelPopuler->id}}detail" class="modal modal-fixed-footer">
                            <div class="modal-content left-align" style="color:black;">
                              <h4>Detail Artikel Populer</h4>
                              Judul       : {{ $artikelPopuler->judul }} <br>
                              ISSN        : {{ $artikelPopuler->issn }} <br>
                              Penulis     : {{ $artikelPopuler->penulis_utama }} <br>
                              Anggota     : <?php echo substr($list, 0, -2) ?> <br>
                              Dimuat Pada : {{ $artikelPopuler->dimuat_di }} <br>
                              No/Halaman  : {{ $artikelPopuler->no . "/" . $artikelPopuler->halaman }} <br>
                              Penerbit/Tahun : {{ $artikelPopuler->penerbit . "/" . $artikelPopuler->tahun}} <br>
                              URL         : {{ $artikelPopuler->url }}
                            </div>
                            <div class="modal-footer">
                              <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Tutup</a>
                            </div>
                          </div>
                          {{-- END OF MODAL DETAIL BUKU --}}

                          {{-- MODAL DELETE BUKU --}}
                          <button data-target="modal{{$artikelPopuler->id}}" class="btn-floating btn modal-trigger">
                            <i class="material-icons right">delete</i>
                          </button>
                          {{-- MODAL STRUCTURE DELETE BUKU --}}
                          <div id="modal{{$artikelPopuler->id}}" class="modal">
                            <div class="modal-content">
                              <h4>Hapus {{$artikelPopuler->judul}}?</h4>
                              <p>Buku akan dihapus secara permanen</p>
                            </div>
                            <div class="modal-footer center-align">
                              <a href="/kelolaRepository/artikelPopuler/delete/{{$artikelPopuler->id}}" 
                                class="modal-action modal-close btn-flat">Ya</a>
                              <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                            </div>
                          </div>
                          {{-- END OF MODAL DELETE BUKU --}}
                        </div>
                      </p>
                    </div>
                  </div>
                </div>
                @endforeach

              @elseif ($kategori == "kegiatan")
                @if ($dataPenelitian != "")
                  {{-- CONTENT SEARCH PENELITIAN --}}
                  @foreach($dataPenelitian as $penelitian)
                  <div class="col s12 m6">
                    <div class="card blue-grey darken-1">
                      <div class="card-content white-text">
                        <span class="card-title">{{ $penelitian->judul }}</span>
                        <p>
                          <div class="Penulis truncate">Ketua : {{ $penelitian->ketua }}</div>
                          {{-- GET ALL ANGGOTA FROM SPECIFIC PENELITIAN --}}
                          <?php 
                            $anggotas = $penelitian::find($penelitian->id)->getAnggota;
                            $listAnggota = ""; 
                          
                            foreach ($anggotas as $anggota) {
                              $listAnggota = $listAnggota . $anggota->nama_anggota . ", " ;
                            }
                          ?>
                          <div class="anggota truncate">Anggota  : <?php echo substr($listAnggota, 0, -2) ?></div>
                          {{-- END OF GET ALL ANGGOTA --}}
                          {{-- GET ALL MHS TERLIBAT FROM SPECIFIC PENELITIAN --}}
                          <?php 
                            $mhsTerlibats = $penelitian::find($penelitian->id)->getMhsTerlibat;
                            $listMhs = ""; 
                          
                            foreach ($mhsTerlibats as $mhsTerlibat) {
                              $listMhs = $listMhs . $mhsTerlibat->nama_mhs . ", " ;
                            }
                          ?>
                          <div class="anggota truncate">Mahasiswa Terlibat  : <?php echo substr($listMhs, 0, -2) ?></div>
                          <div class="Penulis truncate">Besar Dana : {{ $penelitian->besar_dana }}</div>
                          {{-- END OF GET ALL ANGGOTA --}}
                          <div class="kategori truncate">Kategori : Penelitian</div>
                          <div class="nav-link right-align">
                            {{-- BUTTON FOR EDIT PAGE --}}
                            <a class="btn-floating" href="/kelolaRepository/penelitian/edit/{{$penelitian->id}}">
                              <i class="material-icons right">mode_edit</i></a>
                            {{-- END OF BUTTON EDIT PAGE --}}

                            {{-- MODAL DETAIL PENELITIAN --}}
                            <button data-target="modal{{$penelitian->id}}detail" class="btn-floating btn modal-trigger">
                              <i class="material-icons right">info</i>
                            </button>
                            {{-- MODAL STRUCTURE DETAIL PENELITIAN --}}
                            <div id="modal{{$penelitian->id}}detail" class="modal modal-fixed-footer">
                              <div class="modal-content left-align" style="color:black;">
                                <h4>Detail Penelitian</h4>
                                Judul       : {{ $penelitian->judul }} <br>
                                Ketua       : {{ $penelitian->ketua }} <br>
                                Anggota     : <?php echo substr($listAnggota, 0, -2) ?> <br>
                                Mahasiswa   : <?php echo substr($listMhs, 0, -2) ?> <br>
                                Sumber Dana : {{ $penelitian->sumber_dana }} <br>
                                Besar Dana  : {{ $penelitian->besar_dana }} <br>
                              </div>
                              <div class="modal-footer">
                                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Tutup</a>
                              </div>
                            </div>
                            {{-- END OF MODAL DETAIL PENELITIAN --}}

                            {{-- MODAL DELETE PENELITIAN --}}
                            <button data-target="modal{{$penelitian->id}}" class="btn-floating btn modal-trigger">
                              <i class="material-icons right">delete</i>
                            </button>
                            {{-- MODAL STRUCTURE DELETE PENELITIAN --}}
                            <div id="modal{{$penelitian->id}}" class="modal">
                              <div class="modal-content">
                                <h4>Hapus {{$penelitian->judul}}?</h4>
                                <p>Buku akan dihapus secara permanen</p>
                              </div>
                              <div class="modal-footer center-align">
                                <a href="/kelolaRepository/penelitian/delete/{{$penelitian->id}}" class="modal-action modal-close btn-flat">Ya</a>
                                <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                              </div>
                            </div>
                            {{-- END OF MODAL DELETE PENELITIAN --}}
                          </div>
                        </p>
                      </div>
                    </div>
                  </div>
                  @endforeach
                @endif

                @if ($dataPengmas != "")
                  {{-- CONTENT SEARCH PENGABDIAN MASYARAKAT --}}
                  @foreach($dataPengmas as $pengmas)
                  <div class="col s12 m6">
                    <div class="card blue-grey darken-1">
                      <div class="card-content white-text">
                        <span class="card-title">{{ $pengmas->nama_kegiatan }}</span>
                        <p>
                          <div class="penyelenggara truncate">Penyelenggara : {{ $pengmas->penyelenggara }}</div>
                          <div class="Penulis truncate">Ketua : {{ $pengmas->ketua }}</div>
                          {{-- GET ALL ANGGOTA FROM SPECIFIC PENGMAS --}}
                          <?php 
                            $anggotas = $pengmas::find($pengmas->id)->getAnggota;
                            $list = ""; 
                          
                            foreach ($anggotas as $anggota) {
                              $list = $list . $anggota->nama_anggota . ", " ;
                            }
                          ?>
                          <div class="anggota truncate">Anggota  : <?php echo substr($list, 0, -2) ?></div>
                          {{-- END OF GET ALL ANGGOTA --}}
                          <div class="penyelenggara truncate">Besar Dana : {{ $pengmas->besar_danax }}</div>
                          <div class="kategori truncate">Kategori : Pengabdian Masyarakat</div>
                          <div class="nav-link right-align">
                            {{-- BUTTON FOR EDIT PAGE --}}
                            <a class="btn-floating" href="/kelolaRepository/pengmas/edit/{{$pengmas->id}}">
                              <i class="material-icons right">mode_edit</i></a>
                            {{-- END OF BUTTON EDIT PAGE --}}

                            {{-- MODAL DETAIL PENGABDIAN MASYARAKAT --}}
                            <button data-target="modal{{$pengmas->id}}detail" class="btn-floating btn modal-trigger">
                              <i class="material-icons right">info</i>
                            </button>
                            {{-- MODAL STRUCTURE DETAIL PENGABDIAN MASYARAKAT --}}
                            <div id="modal{{$pengmas->id}}detail" class="modal modal-fixed-footer">
                              <div class="modal-content left-align" style="color:black;">
                                <h4>Detail Pengabdian Masyarakat</h4>
                                Nama Kegiatan : {{ $pengmas->nama_kegiatan }} <br>
                                Penyelenggara : {{ $pengmas->penyelenggara }} <br>
                                Ketua         : {{ $pengmas->ketua }} <br>
                                Anggota       : <?php echo substr($list, 0, -2) ?> <br>
                                Peranan       : {{ $pengmas->peranan }} <br>
                                Besar_Dana    : {{ $pengmas->besar_dana }}
                                Tempat/Tanggal: {{ $pengmas->tempat . " / " . $pengmas->waktu }} <br>
                              </div>
                              <div class="modal-footer">
                                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Tutup</a>
                              </div>
                            </div>
                            {{-- END OF MODAL DETAIL PENGABDIAN MASYARAKAT --}}

                            {{-- MODAL DELETE PENGABDIAN MASYARAKAT --}}
                            <button data-target="modal{{$pengmas->id}}" class="btn-floating btn modal-trigger">
                              <i class="material-icons right">delete</i>
                            </button>
                            {{-- MODAL STRUCTURE DELETE PENGABDIAN MASYARAKAT --}}
                            <div id="modal{{$pengmas->id}}" class="modal">
                              <div class="modal-content">
                                <h4>Hapus {{$pengmas->nama_kegiatan}}?</h4>
                                <p>Pengabdian Masyarakat akan dihapus secara permanen</p>
                              </div>
                              <div class="modal-footer center-align">
                                <a href="/kelolaRepository/pengmas/delete/{{$pengmas->id}}" 
                                  class="modal-action modal-close btn-flat">Ya</a>
                                <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                              </div>
                            </div>
                            {{-- END OF MODAL DELETE PENGABDIAN MASYARAKAT --}}
                          </div>
                        </p>
                      </div>
                    </div>
                  </div>
                  @endforeach
                @endif

                @if ($dataKegiatanIlmiah != "")
                  {{-- CONTENT SEARCH KEGIATAN ILMIAH --}}
                  @foreach($dataKegiatanIlmiah as $kegiatanIlmiah)
                  <div class="col s12 m6">
                    <div class="card blue-grey darken-1">
                      <div class="card-content white-text">
                        <span class="card-title">{{ $kegiatanIlmiah->nama }}</span>
                        <p>
                        <div class="Penulis truncate">Judul Kegiatan : {{ $kegiatanIlmiah->judul }}</div>
                          <div class="Penulis truncate">Jenis : {{ $kegiatanIlmiah->Jenis }}</div>
                          <div class="Penulis truncate">Skala : {{ $kegiatanIlmiah->skala }}</div>
                          <div class="Penulis truncate">Pembicara : {{ $kegiatanIlmiah->pembicara }}</div>  
                          <div class="kategori truncate">Kategori : Kegiatan Ilmiah</div>
                          <div class="nav-link right-align">
                            {{-- BUTTON FOR EDIT KEGIATAN ILMIAH --}}
                            <a class="btn-floating" href="/kelolaRepository/kegiatanIlmiah/edit/{{$kegiatanIlmiah->id}}">
                              <i class="material-icons right">mode_edit</i></a>
                            {{-- END OF BUTTON EDIT KEGIATAN ILMIAH --}}

                            {{-- MODAL DETAIL KEGIATAN ILMIAH --}}
                            <button data-target="modal{{$kegiatanIlmiah->id}}detail" class="btn-floating btn modal-trigger">
                              <i class="material-icons right">info</i>
                            </button>
                            {{-- MODAL STRUCTURE DETAIL KEGIATAN ILMIAH --}}
                            <div id="modal{{$kegiatanIlmiah->id}}detail" class="modal modal-fixed-footer">
                              <div class="modal-content left-align" style="color:black;">
                                <h4>Detail Kegiatan Ilmiah</h4>
                                Nama Kegiatan  : {{ $kegiatanIlmiah->nama }} <br>
                                Judul Kegiatan : {{ $kegiatanIlmiah->judul }} <br>
                                Jenis          : {{ $kegiatanIlmiah->jenis }} <br>
                                Skala          : {{ $kegiatanIlmiah->skala }} <br>
                                Pembicara      : {{ $kegiatanIlmiah->pembicara }} <br>
                                Sumber Dana    : {{ $kegiatanIlmiah->sumber_dana }} <br>
                                Tempat/Waktu   : {{ $kegiatanIlmiah->tempat . " / " . $kegiatanIlmiah->waktu}} <br>
                              </div>
                              <div class="modal-footer">
                                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Tutup</a>
                              </div>
                            </div>
                            {{-- END OF MODAL DETAIL KEGIATAN ILMIAH --}}

                            {{-- MODAL DELETE KEGIATAN ILMIAH --}}
                            <button data-target="modal{{$kegiatanIlmiah->id}}" class="btn-floating btn modal-trigger">
                              <i class="material-icons right">delete</i>
                            </button>
                            {{-- MODAL STRUCTURE DELETE KEGIATAN ILMIAH --}}
                            <div id="modal{{$kegiatanIlmiah->id}}" class="modal">
                              <div class="modal-content">
                                <h4>Hapus {{$kegiatanIlmiah->nama}}?</h4>
                                <p>Kegiatan Ilmiah akan dihapus secara permanen</p>
                              </div>
                              <div class="modal-footer center-align">
                                <a href="/kelolaRepository/kegiatanIlmiah/delete/{{$kegiatanIlmiah->id}}" 
                                  class="modal-action modal-close btn-flat">Ya</a>
                                <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                              </div>
                            </div>
                            {{-- END OF MODAL DELETE KEGIATAN ILMIAH --}}
                          </div>
                        </p>
                      </div>
                    </div>
                  </div>
                  @endforeach
                @endif
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- END OF SEARCH --}}
  </div>
  {{-- END OF PAGE CONTENT --}}
  <script>
    $('ul.tabs').tabs();
    $('ul.tabs').tabs('select_tab', 'tab_id');
    $('select').material_select();  //FOR FORM SELECT
    $('.modal-trigger').leanModal(); //FOR MODAL
  </script>
  @stop
</body>
</html>