@extends('layouts.main')

@section('body')
@include('sections.cardOpen')


    <h5 class="card-title">Tambahkan - Dokumen</h5>
    @foreach($dokumen_master as $dokumen)
    <img src="{{ asset('/storage/' . $dokumen->gambar) }}">
    {{-- <img src="http://{{$_SERVER['HTTP_HOST']}}/storage/{{$dokumen->gambar}}"> --}}
    {{-- <img src="{{ url('/storage/img-dokumen/' . $dokumen->gambar }}"> --}}
    
    @endforeach
@include('sections.cardClose')
@endsection