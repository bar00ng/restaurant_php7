@extends('user.template.master')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Menu Baru</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('menu.patch', ['menu_id' => $menu['id']]) }}" method="POST">
            @method('PATCH')
            <!-- CSRF Token -->
            @csrf

            <!-- Nama Menu Field -->
            <div class="mb-3 has-validation">
                <label for="nama_menu" class="form-label">Nama Menu</label>
                <input type="text" class="form-control {{ $errors->has('nama_menu') ? 'is-invalid' : '' }}" id="nama_menu" name="nama_menu" placeholder="Masukkan nama menu..." value="{{ $errors->has('nama_menu') ? old('nama_menu') : $menu['nama_menu'] }}">
                <div class="invalid-feedback">{{ $errors->first('nama_menu') }}</div>
            </div>

            <!-- Harga Modal Field -->
            <div class="mb-3 form-group">
                <label for="harga" class="form-label">Harga Modal Menu</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control {{ $errors->has('harga_modal_menu') ? 'is-invalid' : '' }}" id="harga" name="harga_modal_menu" placeholder="000.00" value="{{ $errors->has('harga_modal_menu') ? old('harga_modal_menu') : $menu['harga_modal_menu'] }}">
                    <div class="invalid-feedback">{{ $errors->first('harga_modal_menu') }}</div>
                </div>
            </div>

            <!-- Harga Jual Field -->
            <div class="mb-3 form-group">
                <label for="harga" class="form-label">Harga Jual Menu</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control {{ $errors->has('harga_jual_menu') ? 'is-invalid' : '' }}" id="harga" name="harga_jual_menu" placeholder="000.00" value="{{ $errors->has('harga_jual_menu') ? old('harga_jual_menu') : $menu['harga_jual_menu'] }}">
                    <div class="invalid-feedback">{{ $errors->first('harga_jual_menu') }}</div>
                </div>
            </div>

            <!-- Kategori Field -->
            <div class="form-gorup mb-3 has-validation">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-control" id="kategori_id" name="kategori_id">
                    <option>Pilih kategori</option>
                    @foreach ($kategori as $item)
                        <option value="{{ $item['id'] }}" {{ old('kategori_id') == $item['id'] ? 'selected' : '' }} {{ $menu['kategori_id'] == $item['id'] ? 'selected' : ''}}>{{ $item['nama_kategori'] }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('kategori_id') }}</div>
            </div>

            <!-- In Stock Field -->
            <div class="mb-3">
                <label class="form-label">In Stock</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inStock" id="inStockYes" value="1" {{ $menu['inStock'] == 1? 'checked' : '' }}>
                    <label class="form-check-label" for="inStockYes">Ya</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inStock" id="inStockNo" value="0" {{ $menu['inStock'] == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="inStockNo">Tidak</label>
                    <div class="invalid-feedback">Pilih salah satu pilihan.</div>
                </div>
            </div>

            <!-- Button Submit -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection