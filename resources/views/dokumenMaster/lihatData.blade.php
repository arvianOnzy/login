@extends('layouts.main')

@section('body')
@include('sections.cardOpen')


    <h5 class="card-title">Tambahkan - Dokumen</h5>
    @foreach($dokumen_master as $dokumen)
    <h6>{{ $dokumen->nama_dok }}</h6>    
    <h6>{{ $dokumen->no_dok }}</h6>    
    <h6>{{ $dokumen->jenis }}</h6>
    <h6>{{ $dokumen->ruangan }}</h6>
    <h6>{{ $dokumen->rak }}</h6>
    <h6>{{ $dokumen->kardus }}</h6>
    <img src="{{ asset('/storage/' . $dokumen->gambar) }}">
    
    @endforeach
@include('sections.cardClose')
@endsection