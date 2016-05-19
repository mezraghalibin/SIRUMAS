@extends('master')

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
  <title>Proposal Hibah</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/proposalhibah.css')}}">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

</head>
<body>
  @section('main_content')
  {{-- PAGE CONTENT --}}
  <div class="page-content">
    {{-- SECOND NAVBAR --}}
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
            <li id="navbar-hibah-riset"><a href="/proposalriset">Kembali</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
        </div>
    </nav>
    {{-- END of SECOND NAVBAR --}}

    {{-- LIST OF PROPOSAL HIBAH RISET --}}
    <div class="container">    
      <!-- TABLE DAFTAR PROPOSAL-->
      <div id="daftar-proposal-riset">
        <div class="header"><h4>Daftar Proposal</h4></div>
        <div class="hibah-riset-content">
          <table class="highlight centered">
            <thead>
              <tr>
                <th>Judul</th>
                <th>Pengaju</th>
                <th>Tanggal Submit</th>
                <th>Hibah</th>                           
                @if($spesifik_role == "divisi riset")
                <th>Nilai</th>
                @endif
                @if($spesifik_role == "divisi keuangan")
                <th>Penyesuaian</th>
                @endif
                <th>Status</th>
                <th></th>
                <th>File</th>
              </tr>
            </thead>
            <tbody>
            {{-- KALAU DIVISI KEUANGAN DIA GABISA LIAT NILAI  --}}
              @if($spesifik_role=="divisi keuangan")
              @foreach ($allDataForKeuangan as $proposal)
                <tr>
                  <td>{{ $proposal->judul_proposal }}</td>
                  <td>{{ $proposal->nama_pengaju}}</td>
                  <td>{{ $proposal->created_at}}</td>
                  <td>{{ $proposal->nama_hibah}}</td>
                  @if($spesifik_role == "divisi riset")
                  <td>
                    @if($proposal->nilai_proposal == null)
                    <a href='/daftarproposalhibahriset/nilaiproposalriset/{{$proposal->id_proposal}}'>
                    <button class="btn waves-effect waves-teal card-panel red darken-2">
                    <span class="white-text">Nilai</span></button></a>
                    @else
                    {{$proposal->nilai_proposal}}
                    @endif
                  </td>
                  @endif
                  @if($spesifik_role == "divisi keuangan")
                  <td>
                    @if($proposal->komentar == null)
                      <a href='/daftarproposalhibahriset/sesuaikanproposalriset/{{$proposal->id_proposal}}'>
                      <button class="btn waves-effect waves-teal card-panel red darken-2" type="button">
                      <span class="white-text">Sesuaikan</span></button></a>
                    @else
                    {{$proposal->komentar}}
                    @endif
                  </td>
                  @endif
                  <form method="POST" action="/ubahstatus/{{$proposal->id_proposal}}/" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <td>
                    <select name="status" value="" class="browser-default validate" style="width:100px">
                      <option disabled selected>{{$proposal->status}}</option>
                      <option>Menunggu Penyesuaian Dana</option>
                      <option>Lolos Seleksi</option>
                      <option>Ditolak</option>
                    </select>
                  </td>
                  <td>
                  <!-- <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action" value="post"> -->
                  <!-- <span class="white-text">Ubah</span><i class="material-icons right">send</i></button> -->
                  </td>
                  </form>
                  <td> 
                    <a href="/upload/proposal/{{$proposal->file}}">
                      <i class="material-icons">file_download</i>
                    </a>
                  </td>
                </tr>
              @endforeach
              {{-- KALAU DIVISI RISET DIA BISA LIAT SEMUA  --}}
              @elseif($spesifik_role=="divisi riset")
              @foreach ($allData as $proposal)
              <tr>
                  <td>{{ $proposal->judul_proposal }}</td>
                  <td>{{ $proposal->nama_pengaju}}</td>
                  <td>{{ $proposal->created_at}}</td>
                  <td>{{ $proposal->nama_hibah}}</td>
                  @if($spesifik_role == "divisi riset")
                  <td>
                    @if($proposal->nilai_proposal == null)
                    <a href='/daftarproposalhibahriset/nilaiproposalriset/{{$proposal->id_proposal}}'>
                    <button class="btn waves-effect waves-teal card-panel red darken-2">
                    <span class="white-text">Nilai</span></button></a>
                    @else
                    {{$proposal->nilai_proposal}}
                    @endif
                  </td>
                  @endif
                  @if($spesifik_role == "divisi keuangan")
                  <td>
                    @if($proposal->komentar == null)
                      <a href='/daftarproposalhibahriset/sesuaikanproposalriset/{{$proposal->id_proposal}}'>
                      <button class="btn waves-effect waves-teal card-panel red darken-2" type="button">
                      <span class="white-text">Sesuaikan</span></button></a>
                    @else
                    {{$proposal->komentar}}
                    @endif
                  </td>
                  @endif
                  <form method="POST" action="/ubahstatus/{{$proposal->id_proposal}}/" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <td>
                    <select name="status" value="" class="browser-default validate" style="width:100px">
                      <option disabled selected>{{$proposal->status}}</option>
                      <option>Menunggu Penyesuaian Dana</option>
                      <option>Lolos Seleksi</option>
                      <option>Ditolak</option>
                    </select>
                  </td>
                  <td>
                  <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action" value="post">
                  <span class="white-text">Ubah</span><i class="material-icons right">send</i></button>
                  </td>
                  </form>
                  <td> 
                    <a href="/upload/proposal/{{$proposal->file}}">
                      <i class="material-icons">file_download</i>
                    </a>
                  </td>
                </tr>
              @endforeach
              @endif
            </tbody>
          </table>
          
        </div>
      </div>
      <!-- END OF TABEL DAFTAR PROPOSAL -->
    </div>
    {{-- END OF LIST OF PROPOSAL HIBAH RISET --}}
  </div>
  {{-- PAGE CONTENT --}}
  @stop
</body>
</html>
