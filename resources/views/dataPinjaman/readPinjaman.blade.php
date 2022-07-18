@extends('layouts.main')

@section('style')
       
@endsection

@section('body')
@include('sections.cardOpen')
<div class="row mb-2 mt-2">
    <div class="col-4">
        <span>Jenis Dokumen</span>
        <select class="form-select" aria-label="Default select example" style="border-radius: 10px" id="jenis">
            <option value="0">Pilih Jenis</option>
            @foreach($jenis_dokumen as $jenis)
            <option value="{{ $jenis->id }}" {{ isset($_GET['jenis']) && $_GET['jenis'] == $jenis->id ? 'selected' : '' }}>{{ $jenis->jenis }}</option>
            @endforeach
          </select>
    </div>
    <div class="col-4">
        <span>Lokasi</span>
        <select class="form-select" aria-label="Default select example" style="border-radius: 10px" id="lokasi">
        <option selected value="0">pilih lokasi</option>
        @foreach($lokasi as $lokasi)
            <option value="{{ $lokasi->id }}" {{ isset($_GET['lokasi']) && $_GET['lokasi'] == $lokasi->id ? 'selected' : '' }}>{{ $lokasi->lokasi }}</option>
        @endforeach
      </select>

        {{-- <div class="d-flex justify-content-end">
        </div> --}}
    </div>
    <div class="col-4">
      <form action="{{ route('search') }}" method="GET">
        <span>Cari</span>
        <input value="{{ request('keyword') }}" class="form-control" type="search" placeholder="Cari data..." aria-label="default input example" style="border-radius: 10px" id="search" name="search">
      </form>
    </div>
</div>
@include('sections.cardClose')
    @include('sections.cardOpen')
        <div class="row mb-4 mt-2">
            <div class="col-6">
                <h3 class="card-title">Halaman Pinjaman</h3>
            </div>
            {{-- <div class="col-6">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="/tambahkan-jenis" role="button">Tambahkan Jenis</a>
                </div>
            </div> --}}
        </div>
            <div style="max-height: 60vh; overflow-y:auto; ">
                <div class="card-text me-3">
                    <table class="table">
                        <thead class="thead">
                          <tr>
                            <th class="th" scope="col">No</th>
                            <th class="th" scope="col">Nama Dokumen</th>
                            <th class="th" scope="col">No Dokumen</th>
                            <th class="th" scope="col">Jenis Dokumen</th>
                            <th class="th" scope="col">Lokasi</th>
                            <th class="th" scope="col">Status</th>
                            <th class="th" scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($permintaan as $p)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $p->nama_dok }}</td>    
                            <td>{{ $p->no_dok }}</td>    
                            <td>{{ $p->jenis }}</td>    
                            <td>{{ $p->lokasi }}</td>    
                            <td><span class="badge rounded-pill bg-warning">Request</span></td>    
                            {{-- <input type="text" name="status" value="disetujui" hidden> --}}
                      {{-- <button class="badge bg-success border-0 p-2"
                        onclick="return confirm('Apakah Anda Yakin Ingin Menyetujui penelitian Tersebut??')"><i
                          class="fa-solid fa-check me-2" style="width: 15px"></i>Setuju</button> --}}
                            <td class="d-flex py-3">
                              <form action="" method="post" enctype="multipart/form-data">>
                              <a class="btn btn-primary" role="button" type="submit">Verifikasi</a>
                            </form>
                              {{-- <a href="/edit-pinjaman/{{ $p->id }}" style="background:none;border:none;outline:none;"><i class='bx bx-pencil tableAction'></i></a>
                              <form action="/hapus-pinjaman/{{ $p->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button style="background:none;border:none;outline:none;"><i class='bx bx-trash tableAction'></i>
                                </button>
                              </form>
                              <a href="/edit-data/{{ $p->id }}" style="background:none;border:none;outline:none;"><i class='bx bx-show tableAction'></i></a> --}}
                            </td>
                          </tr>
                         
                          @endforeach
                        </tbody>
                    </table>                    
                </div>
            </div>
    @include('sections.cardClose')
    <div class="d-flex justify-content-end py-3 px-5">

      {{ $permintaan->links() }}

  </div>
@endsection


@section('script')
    
    <script>
        $(document).ready(function(){
      $("#jenis").on('change', function(){
        getDataDokumen();
      })
      $("#lokasi").on('change', function(){
        getDataDokumen();
      })

      function getDataDokumen(){
        var params = {
          jenis : $("#jenis").val(),
          lokasi : $("#lokasi").val()
        }
        var query = $.param(params);
        var url = '{{ route('Data Pinjaman') }}' + '?' + query;
        window.location.replace(url);
      }
    })
        </script>
@endsection
