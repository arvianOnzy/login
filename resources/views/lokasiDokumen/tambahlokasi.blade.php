@extends('layouts.main')

@section('body')
    @include('sections.cardOpen')
    <form method="POST" action="/tambah-lokasi/store" enctype="multipart/form-data">
        @csrf
        <h5 class="card-title">Tambahkan Lokasi</h5>
        @if(isset($errorMessage))
        <div class="alert-danger mt-1 p-2">{{ $errorMessage }}</div>
        @endif
        <div style="max-height: 60vh; overflow-y:auto;">
            <div class="card-text me-3">          
                <div class="py-2">
                    <label for="inputJenis">Lokasi</label>
                    <input value="{{old('lokasi')}}" type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi">
                    @error('lokasi')
                    <div class="alert-danger mt-1 p-2">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>
        </div>
        <div class="float-end mt-4 mb-3 me-3">
            <a class="btn btn-outline-secondary" href="/lokasi">Cancel</a>
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
        </form>
    @include('sections.cardClose')
@endsection
