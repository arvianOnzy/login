
<x-guest-layout>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' /> -->
        <link href="{{ asset('css/login/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    
        <title>DMS | Login</title>
    </head>
    
    <body>
        <div class="card-login">
            <div class="row" style="height:100%;">
                <div class="col bg-blue text-center">
                    <div class="container left-container">
                        <h2 class="left-welcome">Selamat Datang</h2>
                        <img class="left-image" src="/img/login/undraw_programming_re_kg9v.svg">
                        <h5 class="left-appsname">Dokumen Manajemen Sistem</h5>
                    </div>
                </div>
                <div class="col me-2">
                    <div class="container">
                        <h2 class="text-center mt-4 mb-3">Daftar</h2>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
    
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
                        <form method="POST" action="/tambah-user/store" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nip">NIP</label>
                                <input value="{{old('nip')}}" style="border-radius: 10px"  type="text" class="form-control @error('') is-invalid @enderror" id="nip" name="nip" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="name">Nama</label>
                                <input value="{{old('name')}}" style="border-radius: 10px"  type="text" class="form-control @error('') is-invalid @enderror" id="name" name="name" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input value="{{old('email')}}" style="border-radius: 10px"  type="text" class="form-control @error('') is-invalid @enderror" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="role">Role</label>
                                <select class="form-select" aria-label="Default select example" style="border-radius: 10px" name="role_id" id="role_id">
                                    
                                    {{-- @foreach ($role as $role)
                                    <option value="{{ $role->role_id }} {{ $role == $role ? 'selected' : '' }}">{{ $role->nama }}</option>
                                    @endforeach --}}
                                    @foreach($role as $role)
                                    <option value="{{ $role->id }}" {{ isset($_GET['nama']) && $_GET['nama'] == $role->id ? 'selected' : '' }}>{{ $role->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="unit">Unit</label>
                                <select class="form-select" aria-label="Default select example" style="border-radius: 10px" name="role_id" id="role_id">
                                    
                                    {{-- @foreach ($unit as $unit)
                                    <option value="{{ $unit->role_id }} {{ $unit == $unit ? 'selected' : '' }}">{{ $unit->nama }}</option>
                                    @endforeach --}}
                                    @foreach($unit as $unit)
                                    <option value="{{ $unit->id }}" {{ isset($_GET['nama_unit']) && $_GET['nama_unit'] == $unit->id ? 'selected' : '' }}>{{ $unit->nama_unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input value="{{old('password')}}" style="border-radius: 10px"  type="password" class="form-control @error('') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation">Ulangi Password</label>
                                <input value="{{old('password')}}" style="border-radius: 10px"  type="password" class="form-control @error('') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required >
                            </div>
                            <div class="mb-3">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>
                            </div>
                            <button class="btn btn-outline-primary mt-3" style="width: 100%;">Daftar</button>
                            {{-- <x-button class="ml-4">
                                {{ __('Register') }}
                            </x-button> --}}
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    </body>
    </x-guest-layout>
