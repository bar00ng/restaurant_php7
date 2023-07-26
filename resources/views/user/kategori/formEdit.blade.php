@extends('user.template.master')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Kategori</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('kategori.patch', ['kategori_id' => $kategori['id']]) }}" method="POST">
            @method('PATCH')
            @csrf

            <!-- Nama Kategori Field -->
            <div class="mb-3 has-validation">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control {{ $errors->has('nama_kategori') ? 'is-invalid' : '' }}" name="nama_kategori" placeholder="Masukkan Nama Kategori" value="{{ $errors->has('nama_kategori') ? old('nama_kategori') : $kategori['nama_kategori'] }}">
                <div class="invalid-feedback">
                    {{ $errors->first('nama_kategori') }}
                </div>
            </div>

            <!-- Button Submit -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection