@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="css/bidangKeahlian/style.css">    
@endsection

@section('body')
    @include('sections.cardOpen')
        <div class="row mb-4 mt-2">
            <div class="col-6">
                <h3 class="card-title">Halaman Jenis Dokumen</h3>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="/tambahkan-jenis" role="button">Tambahkan Jenis</a>
                </div>
            </div>
        </div>
            <div style="max-height: 60vh; overflow-y:auto;">
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
                          @foreach($dokumen_master as $dokumen)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $dokumen->nama_dok }}</td>    
                            <td>{{ $dokumen->no_dok }}</td>    
                            <td>{{ $dokumen->jenis }}</td>    
                            <td>{{ $dokumen->lokasi }}</td>    
                            <td><span class="badge rounded-pill bg-warning">Request</span></td>    
                            <input type="text" name="status" value="disetujui" hidden>
                      <button class="badge bg-success border-0 p-2"
                        onclick="return confirm('Apakah Anda Yakin Ingin Menyetujui penelitian Tersebut??')"><i
                          class="fa-solid fa-check me-2" style="width: 15px"></i>Setuju</button>
                            <td class="d-flex py-3">
                              <a href="/edit-pinjaman/{{ $dokumen->id }}" style="background:none;border:none;outline:none;"><i class='bx bx-pencil tableAction'></i></a>
                              <form action="/hapus-pinjaman/{{ $dokumen->id }}" method="post">
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
@endsection


@section('script')
    <script type="text/javascript" src="js/bidangKeahlian/script.js"></script> 
    <script>
        $(document).ready(function(){
          $("#jenis").on('change', function(){
            var jenis = $("#jenis").val();
            var url = '{{ route('dashboard') }}' + '?jenis=' + jenis;
            window.location.replace(url);
          })
        })
        </script>
@endsection
