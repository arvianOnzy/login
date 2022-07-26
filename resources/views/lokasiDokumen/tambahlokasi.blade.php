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
                    <label for="inputJenis">Ruangan</label>
                    <input value="{{old('ruangan')}}" type="text" class="form-control @error('ruangan') is-invalid @enderror" id="ruangan" name="ruangan">
                    @error('ruangan')
                    <div class="alert-danger mt-1 p-2">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>
            <div class="card-text me-3">          
                <div class="py-2">
                    <label for="inputJenis">Rak</label>
                    <input value="{{old('rak')}}" type="text" class="form-control @error('rak') is-invalid @enderror" id="rak" name="rak">
                    @error('rak')
                    <div class="alert-danger mt-1 p-2">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>
            <div class="card-text me-3">          
                <div class="py-2">
                    <label for="inputJenis">Kardus</label>
                    <input value="{{old('kardus')}}" type="text" class="form-control @error('kardus') is-invalid @enderror" id="kardus" name="kardus">
                    @error('kardus')
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
