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
                    <a class="btn btn-primary" href="/tambah-jenis" role="button">Tambahkan Jenis</a>
                </div>
            </div>
        </div>
            <div style="max-height: 60vh; overflow-y:auto;">
                <div class="card-text me-3">
                    <table class="table">
                        <thead class="thead">
                          <tr>
                            <th class="th" scope="col">No</th>
                            <th class="th" scope="col">Nama Jenis</th>
                            {{-- <th class="th" scope="col">Jenis Dokumen</th>
                            <th class="th" scope="col">No Dok</th>
                            <th class="th" scope="col">a</th> --}}
                            <th class="th" scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($jenis_dokumen as $jenis_dokumen)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $jenis_dokumen->jenis }}</td>    
                            
                           
                              
                            <td class="d-flex py-3">
                              <a href="/edit-jenis/{{ $jenis_dokumen->id }}" style="background:none;border:none;outline:none;"><i class='bx bx-pencil tableAction'></i></a>
                              <form action="/hapus-jenis/{{ $jenis_dokumen->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button style="background:none;border:none;outline:none;"><i class='bx bx-trash tableAction'></i>
                                </button>
                              </form>
                              <a href="/edit-data/{{ $jenis_dokumen->id }}" style="background:none;border:none;outline:none;"><i class='bx bx-show tableAction'></i></a>
                            </td>
                          </tr>
                         
                          @endforeach
                        </tbody>
                    </table>                    
                </div>
            </div>
    @include('sections.cardClose')
@endsection


@section('js')
    <script type="text/javascript" src="js/bidangKeahlian/script.js"></script> 
@endsection
