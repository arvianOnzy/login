@extends('layouts.main')

@section('body')
@include('sections.cardOpen')
<form method="POST" action="/update-data/{{ $dokumen_master->id }}" enctype="multipart/form-data">
    @method('put')
    @csrf
    <h5 class="card-title">Tambahkan - Dokumen</h5>
    @if(isset($errorMessage))
    <div class="alert-danger mt-1 p-2">{{ $errorMessage }}</div>
    @endif
    <div style="max-height: 60vh; overflow-y:auto;">
        <input type="hidden" name="id" id="id" value="{{ $dokumen_master->id }}">
        <div class="card-text me-3">
        <div class="py-2">
            <label for="inputDok">Nama Dokumen</label>
            <input value="{{$dokumen_master->nama_dok}}" type="text" class="form-control @if ($errors->first('nama_dok')) is-invalid @endif" id="inputdokumen" name="nama_dok">
            @error('nama_dok')
            <div class="alert-danger mt-1 p-2">{{ $message }}</div>
            @enderror
        </div>
        </div>
        <div class="card-text me-3">
            <div class="py-2">
                <label for="inputJenis">Jenis Dokumen</label>
                <select class="form-select" aria-label="Default select example" style="border-radius: 10px" id="jenis">
                    {{-- <option value="0">-- pilih --</option> --}}
                    @foreach($jenis_dokumen as $jenis)
                    <option value="{{ $jenis->jenis }}" {{ isset($_GET['jenis']) && $_GET['jenis'] == $jenis->id ? 'selected' : '' }}>{{ $jenis->jenis }}</option>
                    @endforeach
                  </select>
            </div>
        </div>
            <div class="card-text me-3">
                <div class="py-2">
                    <label for="inputno_dok">No Dokumen</label>
                    <input value="{{$dokumen_master->no_dok}}" type="text" class="form-control @error('') is-invalid @enderror" id="inputno_dok" name="jenis_dok">
                    @error('no_dok')
                    <div class="alert-danger mt-1 p-2">{{ $message }}</div>
                    @enderror
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