@extends('user.template.master')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Owner Baru</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('owner.store') }}" method="POST">
            <!-- CSRF Token -->
            @csrf

            <!-- Nama Field -->
            <div class="mb-3 has-validation">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="nama" name="name" placeholder="Masukkan Nama Anda" value="{{ old('name') }}">
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            </div>

            <!-- Email Field -->
            <div class="mb-3 has-validation">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" placeholder="Masukkan Email Anda"  value="{{ old('email') }}">
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            </div>

            <!-- Password Field -->
            <div class="mb-3 has-validation">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password" placeholder="Masukkan Password Anda"  value="{{ old('password') }}">
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            </div>

            <!-- Button Submit -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection