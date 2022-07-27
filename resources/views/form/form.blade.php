
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">

    <link rel="stylesheet" href="{{ asset('boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jstree/dist/themes/default/style.min.css') }}" />
  
    <title>Pinjam</title>
</head>
<body>

   <div class="container">
        
        <div class="card container-fluid " style="
        width: 60%; 
        max-height: 90%; 
        margin-top: 13rem;
        margin-right: 2rem;
        margin-left: 2rem;
        border-radius: 15px;
        padding-top: 20px;
        

        position:absolute;
        overflow: auto;        
        display: block;
    ">
        <form method="POST" action="/pinjam-dokumen/store" enctype="multipart/form-data">
            @csrf
            <h5 class="card-title">Pinjam Dokumen</h5>
            
            <div style="max-height: 60vh; overflow-y:auto;">
                <div class="py-2">
                    <div class="card-text me-3">
                    <label for="inputDok">Nama Dokumen</label>
                    <input value="" type="text" class="form-control @if ($errors->first('nama_dok')) is-invalid @endif" id="inputdokumen" name="nama_dok"style="border-radius: 10px"> 
                    @error('nama_dok')
                    <div class="alert-danger mt-1 p-2">{{ $message }}</div>
                    @enderror
                    
                </div>
                </div>
                <div class="card-text me-3">
                    <div class="py-2">
                        <label for="inputno_dok">No Dokumen</label>
                        <input value="" type="text" class="form-control @if ($errors->first('nama_dok')) is-invalid @endif"  id="inputno_dok" name="no_dok"style="border-radius: 10px">
                        @error('nama_dok')
                        <div class="alert-danger mt-1 p-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-text me-3">
                    <div class="py-2">
                        <label for="inputJenis">Jenis Dokumen</label>
                        <select class="form-select" aria-label="Default select example" style="border-radius: 10px" id="jenisdok_id" name="jenisdok_id">
                            @foreach($jenis_dokumen as $jenis)
                            <option value="{{ $jenis->id }}" {{ isset($_GET['jenis']) && $_GET['jenis'] == $jenis->id ? 'selected' : '' }}>{{ $jenis->jenis }}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
                {{-- <div class="card-text me-3">
                    <div class="py-2">
                        <label for="inputlokasi">Lokasi</label>
                            <select class="form-select" aria-label="Default select example" style="border-radius: 10px" id="lokasi" name="lokasi_id">
                                @foreach($lokasi as $lokasi)
                                <option value="{{ $lokasi->id }}" {{ isset($_GET['lokasi']) && $_GET['lokasi'] == $lokasi->id ? 'selected' : '' }}>{{ $lokasi->lokasi }}</option>
                                @endforeach
                            </select>
                    </div>
                </div> --}}
            </div>
            <div class="float-end mt-4 mb-3 me-3">
                <a class="btn btn-outline-secondary" href="/">Cancel</a>
                <button class="btn btn-primary" type="submit">Submit</button>


            </div>
        </form>
        
    </div>
</div>
    
    <script type="text/javascript" src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('boxicons/boxicons.js') }}"></script>
    <script src="{{ asset('jstree/dist/jstree.min.js') }}"></script>
    @include('sweetalert::alert')
<script>   

</script>


    
</body>
</html>
