@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="css/bidangKeahlian/style.css">    
@endsection

@section('body')
    @include('sections.cardOpen')
        <div class="row mb-4 mt-2">
            <div class="col-6">
                <h5 class="card-title">Halaman Dokumen</h5>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="/dosen/create" role="button">Tambahkan Dosen</a>
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
                            {{-- <th class="th" scope="col">Keahlian</th> --}}
                            {{-- <th class="th" scope="col">Jabatan</th> --}}
                            <th class="th" scope="col"></th>
                            <th class="th" scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                              <td>BKK</td>
                              <td>abal</td>    
                              <td>5</td>
                                
                              <td>
                                <a href="" style="background:none;border:none;outline:none;"><i class='bx bx-pencil tableAction'></i></a>
                              </td>
                            </tr>
                            <tr>
                              <td>1</td>
                              <td>abal</td>    
                              <td>5</td>
                                
                              <td>
                                <a href="" style="background:none;border:none;outline:none;"><i class='bx bx-pencil tableAction'></i></a>
                              </td>
                            </tr>
                            <tr>
                              <td>1</td>
                              <td>abal</td>    
                              <td>5</td>
                                
                              <td>
                                <a href="" style="background:none;border:none;outline:none;"><i class='bx bx-pencil tableAction'></i></a>
                              </td>
                            </tr>
                            
                        </tbody>
                    </table>                    
                </div>
            </div>
    @include('sections.cardClose')
@endsection


@section('js')
    <script type="text/javascript" src="js/bidangKeahlian/script.js"></script> 
@endsection
