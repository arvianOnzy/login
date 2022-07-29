@extends('layouts.main')

@section('body')
@include('sections.cardOpen')

    <h5 class="card-title">Halaman Profil</h5>
    <div class="container">
        @foreach($user as $user)
        <h5>{{ $user->nip }}</h5>
        <h5>{{ $user->name }}</h5>
        <h5>{{ $user->email }}</h5>
        <h5>{{ $user->role }}</h5>
        <h5>{{ $user->nama_unit }}</h5>
        @endforeach
    </div>
   
    <div class="float-end mt-4 mb-3 me-3">
        <a class="btn btn-outline-secondary" href="/dashboard">Cancel</a>
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>

@include('sections.cardClose')
@endsection