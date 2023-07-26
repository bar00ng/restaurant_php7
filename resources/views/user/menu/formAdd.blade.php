@extends('user.template.master')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Menu Baru</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('menu.store') }}" method="POST">
            <!-- CSRF Token -->
            @csrf

            <!-- Nama Menu Field -->
            <div class="mb-3 has-validation">
                <label for="nama_menu" class="form-label">Nama Menu</label>
                <input type="text" class="form-control {{ $errors->has('nama_menu') ? 'is-invalid' : '' }}" id="nama_menu" name="nama_menu" placeholder="Masukkan nama menu..." value="{{ old('nama_menu') }}">
                <div class="invalid-feedback">{{ $errors->first('nama_menu') }}</div>
            </div>

            <!-- Harga Field -->
            <div class="mb-3 form-group">
                <label for="harga" class="form-label">Harga Menu</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control {{ $errors->has('harga_menu') ? 'is-invalid' : '' }}" id="harga" name="harga_menu" placeholder="000.00" value="{{ old('harga_menu') }}">
                    <div class="invalid-feedback">{{ $errors->first('harga_menu') }}</div>
                </div>
            </div>

            <!-- Kategori Field -->
            <div class="form-gorup mb-3 has-validation">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-control" id="kategori_id" name="kategori_id">
                    <option value="">Pilih kategori</option>
                    @foreach ($kategori as $item)
                        <option value="{{ $item['id'] }}" {{ old('kategori_id') == $item['id'] ? 'selected' : '' }}>{{ $item['nama_kategori'] }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('kategori_id') }}</div>
            </div>

            <!-- Button Submit -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection