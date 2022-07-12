@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="css/bidangKeahlian/style.css">    
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
                            <th class="th" scope="col">Lokasi</th>
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
                              <td>{{ $dokumen->lokasi }}</td>
                             
                                
                              <td class="d-flex py-3">
                                <a href="/edit-data/{{ $dokumen->id }}" style="background:none;border:none;outline:none;"><i class='bx bx-pencil tableAction'></i></a>
                                <form action="/hapus-data/{{ $dokumen->id }}" method="post">
                                  @method('delete')
                                  @csrf
                                  <button style="background:none;border:none;outline:none;"><i class='bx bx-trash tableAction'></i>
                                  </button>
                                </form>
                                <a href="/edit-data/{{ $dokumen->id }}" style="background:none;border:none;outline:none;"><i class='bx bx-show tableAction'></i></a>
                              </td>
                            </tr>
                           
                          @endforeach
                        </tbody>
                    </table>                    
                </div>
            </div>
    @include('sections.cardClose')
    <div class="container-fluid p-4">
        {{-- <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
              <li class="page-item disabled" >
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>
            </ul>
          </nav> --}}
          
        {{ $dokumen_master->links() }}
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
        var url = '{{ route('dashboard') }}' + '?' + query;
        window.location.replace(url);
      }
    })
    </script>
@endsection
