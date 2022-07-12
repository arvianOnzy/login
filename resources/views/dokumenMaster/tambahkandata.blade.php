@extends('layouts.main')

@section('body')
@include('sections.cardOpen')
<form method="POST" action="/tambah-data/store" enctype="multipart/form-data">
    @csrf
    <h5 class="card-title">Tambahkan - Dokumen</h5>
    @if(isset($errorMessage))
    <div class="alert-danger mt-1 p-2">{{ $errorMessage }}</div>
    @endif
    <div style="max-height: 60vh; overflow-y:auto;">
        <div class="py-2">
            <div class="card-text me-3">
            <label for="inputDok">Nama Dokumen</label>
            <input value="{{old('nama_dok')}}" type="text" class="form-control @if ($errors->first('nama_dok')) is-invalid @endif" id="inputdokumen" name="nama_dok">
            @error('nama_dok')
            <div class="alert-danger mt-1 p-2">{{ $message }}</div>
            @enderror
        </div>
        </div>
        <div class="card-text me-3">
            <div class="py-2">
                <label for="inputJenis">Jenis Dokumen</label>
                <select class="form-select" aria-label="Default select example" style="border-radius: 10px" id="jenis" name="jenisdok_id">
                    @foreach($jenis_dokumen as $jenis)
                    <option value="{{ $jenis->id }}" {{ isset($_GET['jenis']) && $_GET['jenis'] == $jenis->id ? 'selected' : '' }}>{{ $jenis->jenis }}</option>
                    @endforeach
                  </select>
            </div>
        </div>
            <div class="card-text me-3">
            <div class="py-2">
                <label for="inputJenis">No Dokumen</label>
                <input value="{{old('no_dok')}}" type="text" class="form-control @error('') is-invalid @enderror" id="inputno_dok" name="no_dok">
                @error('no_dok')
                <div class="alert-danger mt-1 p-2">{{ $message }}</div>
                @enderror
            </div>
            </div>
            <div class="card-text me-3">
            <div class="py-2">
                <label for="inputlokasi">Lokasi</label>
                <select class="form-select" aria-label="Default select example" style="border-radius: 10px" id="lokasi" name="lokasi_id">
                    @foreach($lokasi as $lokasi)
                    <option value="{{ $lokasi->id }}" {{ isset($_GET['lokasi']) && $_GET['lokasi'] == $lokasi->id ? 'selected' : '' }}>{{ $lokasi->lokasi }}</option>
                    @endforeach
                  </select>
            </div>
        </div>
    </div>
    <div class="float-end mt-4 mb-3 me-3">
        <a class="btn btn-outline-secondary" href="/dashboard">Cancel</a>
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
</form>
@include('sections.cardClose')
@endsection