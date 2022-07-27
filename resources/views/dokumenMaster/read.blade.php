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
    {{-- <div class="col-4">
        <span>Lokasi</span>
        <select class="form-select" aria-label="Default select example" style="border-radius: 10px" id="lokasi">
        <option selected value="0">pilih lokasi</option>
        @foreach($lokasi as $lokasi)
            <option value="{{ $lokasi->id }}" {{ isset($_GET['lokasi']) && $_GET['lokasi'] == $lokasi->id ? 'selected' : '' }}>{{ $lokasi->lokasi }}</option>
        @endforeach
      </select>
    </div> --}}
    <div class="col-4">
      <form action="{{ route('cari') }}" method="GET">
        <span>Cari</span>
        <input value="{{ request('keyword') }}" class="form-control" type="search" placeholder="Cari data..." aria-label="default input example" style="border-radius: 10px" id="search" name="search">
      </form>
    </div>
</div>
@include('sections.cardClose')
    @include('sections.cardOpen')
        <div class="row mb-4 mt-2">
            <div class="col-6">
                <h3 class="card-title">Halaman Dokumen</h3>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="/tambah-data" role="button">Tambahkan Dokumen</a>
                </div>
            </div>
        </div>
            <div style="max-height: 60vh; width:auto; overflow-y:auto;">
                <div class="card-text me-3">
                    <table class="table">
                        <thead class="thead">
                          <tr>
                            <th class="th" scope="col">No</th>
                            <th class="th" scope="col">Nama Dokumen</th>
                            <th class="th" scope="col">No Dok</th>
                            <th class="th" scope="col">Jenis</th>
                            <th class="th" scope="col">Ruangan</th>
                            <th class="th" scope="col">Rak</th>
                            <th class="th" scope="col">Kardus</th>
                            {{-- <th class="th" scope="col">Gambar</th> --}}
                            <th class="th" scope="col">Action</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($dokumen_master as $dokumen)
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{ $dokumen->nama_dok }}</td>    
                              <td>{{ $dokumen->no_dok }}</td>    
                              <td>{{ $dokumen->jenis }}</td>
                              <td>{{ $dokumen->ruangan }}</td>
                              <td>{{ $dokumen->rak }}</td>
                              <td>{{ $dokumen->kardus }}</td>
                              {{-- <td><img src="{{ asset('/storage/' . $dokumen->gambar) }}"></td> --}}
                             
                                
                              <td class="d-flex py-3">
                                <a href="/edit-data/{{ $dokumen->id }}" style="background:none;border:none;outline:none;"><i class='bx bx-pencil tableAction'></i></a>
                                <form action="/hapus-data/{{ $dokumen->id }}" method="post">
                                  @method('delete')
                                  @csrf
                                  <button hidden style="background:none; border:none; outline:none" class="{{ 'btn-'.$dokumen->id }}">
                                  </button>
                                </form>
                                <a href=""><i dokid="{{ $dokumen->id }}" class=' btn-hapus bx bx-trash tableAction'></i></a>
                                <a href="{{ asset('/storage/' . $dokumen->gambar) }}" style="background:none;border:none;outline:none;"><i class='bx bx-show tableAction'></i></a>
                              </td>
                            </tr>
                           
                          @endforeach
                        </tbody>
                    </table>                    
                </div>
            </div>
    @include('sections.cardClose')
    <div class="d-flex justify-content-end py-3 px-5">

        {{ $dokumen_master->links() }}

    </div>
@endsection

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('script')  
    <script>
      
    $(document).ready(function(){
      $("#jenis").on('change', function(){
        getDataDokumen();
      })
      $("#lokasi").on('change', function(){
        getDataDokumen();
      })
      $(".btn-hapus").on('click', function(e){
        e.preventDefault();
        var id= $(this).attr('dokid');
        Swal.fire({
          title: 'Apakah anda yakin?',
          text: "Data ini akan dihapus!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
          if (result.isConfirmed) {
            $(".btn-" + id).trigger('click');
          }
        })
      })

      function getDataDokumen(){
        var params = {
          jenis : $("#jenis").val(),
          lokasi : $("#lokasi").val()
        }
        var query = $.param(params);
        var url = '{{ route('dashboard') }}' + '?' + query;
        window.location.replace(url);
      }
      
      function getHapus(e){
        e.preventDefault();
        var params = $("#hapus").val()
        var action = $(this).attr(action);

       
      }
    })
    </script>
@endsection
