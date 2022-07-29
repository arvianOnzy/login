@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="css/bidangKeahlian/style.css">    
@endsection

@section('body')
    @include('sections.cardOpen')
        <div class="row mb-4 mt-2">
            <div class="col-6">
                <h3 class="card-title">Halaman Unit</h3>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="/tambah-unit" role="button">Tambahkan Unit</a>
                </div>
            </div>
        </div>
            <div style="max-height: 60vh; overflow-y:auto;">
                <div class="card-text me-3">
                    <table class="table">
                        <thead class="thead">
                          <tr>
                            <th class="th" scope="col">No</th>
                            <th class="th" scope="col">Nama Unit</th>
                            {{-- <th class="th" scope="col">Jenis Dokumen</th>
                            <th class="th" scope="col">No Dok</th>
                            <th class="th" scope="col">a</th> --}}
                            <th class="th" scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($unit as $unit)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $unit->nama_unit }}</td>    

                            <td class="d-flex py-3">
                              <a href="/edit-unit/{{ $unit->id }}" style="background:none;border:none;outline:none;"><i class='bx bx-pencil tableAction'></i></a>
                              <form action="/hapus-unit/{{ $unit->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button style="background:none;border:none;outline:none;"><i class='bx bx-trash tableAction'></i>
                                </button>
                              </form>
                              {{-- <a href="/edit-unit/{{ $unit->id }}" style="background:none;border:none;outline:none;"><i class='bx bx-show tableAction'></i></a> --}}
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
