@extends('layouts.main')

@section('body')
    @include('sections.cardOpen')
    <form method="POST" action="/tambah-unit/store" enctype="multipart/form-data">
        @csrf
        <h5 class="card-title">Tambahkan - Unit</h5>
        @if(isset($errorMessage))
        <div class="alert-danger mt-1 p-2">{{ $errorMessage }}</div>
        @endif
        <div style="max-height: 60vh; overflow-y:auto;">
            <div class="card-text me-3">          
                <div class="py-2">
                    <label for="inputUnit">Unit</label>
                    <input value="{{old('nama_unit')}}" type="text" class="form-control @error('nama_unit') is-invalid @enderror" id="nama_unit" name="nama_unit">
                    @error('nama_unit')
                    <div class="alert-danger mt-1 p-2">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>
        </div>
        <div class="float-end mt-4 mb-3 me-3">
            <a class="btn btn-outline-secondary" href="/unit">Cancel</a>
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
        </form>
    @include('sections.cardClose')
@endsection
