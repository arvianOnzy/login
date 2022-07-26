@extends('layouts.main')

@section('style')
       
@endsection

@section('body')
    @include('sections.cardOpen')
        <div class="row mb-4 mt-2">
            <div class="col-6">
                <h3 class="card-title">Halaman User</h3>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="/tambah-user" role="button">Tambahkan User</a>
                </div>
            </div>
        </div>
            <div style="max-height: 60vh; overflow-y:auto; ">
                <div class="card-text me-3">
                    <table class="table">
                        <thead class="thead">
                          <tr>
                            <th class="th" scope="col">No</th>
                            <th class="th" scope="col">NIP</th>
                            <th class="th" scope="col">Nama</th>
                            <th class="th" scope="col">Email</th>
                            <th class="th" scope="col">Role</th>
                            <th class="th" scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($user as $u)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $u->nip }}</td>    
                            <td>{{ $u->name }}</td>    
                            <td>{{ $u->email }}</td>    
                            <td>{{ $u->ruangan }}</td>    
                            <td>{{ $u->rak }}</td>    
                            <td>{{ $u->kardus }}</td>    
                            {{-- <td><span class="badge rounded-pill bg-warning">Request</span></td>     --}}
                            {{-- <input type="text" name="status" value="disetujui" hidden> --}}
                      {{-- <button class="badge bg-success border-0 p-2"
                        onclick="return confirm('Apakah Anda Yakin Ingin Menyetujui penelitian Tersebut??')"><i
                          class="fa-solid fa-check me-2" style="width: 15px"></i>Setuju</button> --}}
                            <td class="d-flex py-3">
                              {{-- <form action="" method="post" enctype="multipart/form-data">
                              <a class="btn btn-primary" role="button" type="submit">Verifikasi</a>
                            </form> --}}
                              <a href="/edit-user/{{ $u->id }}" style="background:none;border:none;outline:none;"><i class='bx bx-pencil tableAction'></i></a>
                              <form action="/hapus-user/{{ $u->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button style="background:none;border:none;outline:none;"><i class='bx bx-trash tableAction'></i>
                                </button>
                              </form>
                              <a href="/profil/{{ $u->id }}" style="background:none;border:none;outline:none;"><i class='bx bx-show tableAction'></i></a>
                            </td>
                          </tr>
                         
                          @endforeach
                        </tbody>
                    </table>                    
                </div>
            </div>
    @include('sections.cardClose')
    <div class="d-flex justify-content-end py-3 px-5">

      {{-- {{ $user->links() }} --}}

  </div>
@endsection


@section('script')
    
{{-- <script>
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
</script> --}}
@endsection
