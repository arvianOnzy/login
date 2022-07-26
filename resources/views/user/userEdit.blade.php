@extends('layouts.main')

@section('style')
       
@endsection

@section('body')
    @include('sections.cardOpen')
    <div class="row mb-4 mt-2">
        <div class="col-6">
            <h3 class="card-title">Halaman Ubah Profil</h3>
        </div>
        {{-- <div class="col-6">
            <div class="d-flex justify-content-end">
                <a class="btn btn-primary" href="/tambah-user" role="button">Tambahkan User</a>
            </div>
        </div> --}}
    </div>

    <form method="POST" action="/update-user/{{ $user->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="nip">NIP</label>
            <input value="{{old('nip')}}"style="border-radius: 10px"  type="text" class="form-control @error('') is-invalid @enderror" id="nip" name="nip" required autofocus>
        </div>
        <div class="mb-3">
            <label for="name">Nama</label>
            <input value="{{old('name')}}"style="border-radius: 10px"  type="text" class="form-control @error('') is-invalid @enderror" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email">Email</label>
            <input value="{{old('email')}}"style="border-radius: 10px"  type="text" class="form-control @error('') is-invalid @enderror" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="role">Role</label>
            <select class="form-select" aria-label="Default select example" style="border-radius: 10px" id="role" name="role">
                <option value="{{ old('role') }}"></option>
                @foreach ($role as $role)
                    <option value="{{ $role->id }} {{ $role == $role ? 'selected' : '' }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="password">Password</label>
            <input value="{{old('password')}}" type="password" class="form-control @error('') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">
        </div>
        <div class="mb-3">
            <label for="password_confirmation">Ulangi Password</label>
            <input value="{{old('password')}}" type="password" class="form-control @error('') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required >
        </div>
        
        <button class="btn btn-outline-primary mt-3" type="submit" >Simpan</button>
        {{-- <x-button class="ml-4">
            {{ __('Register') }}
        </x-button> --}}
    </form>
@endsection