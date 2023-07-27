@extends('user.template.master')

@php
    $cartItems = Cart::content();

    $totalWithoutTax = 0;
    $totalTax = 0;

    foreach ($cartItems as $item) {
        // Total harga dari masing-masing item tanpa tax
        $totalWithoutTax += $item->price * $item->qty;

        // Total tax dari masing-masing item
        $totalTax += $item->options->tax * $item->qty;
    }

    // Total harga dengan tax
    $totalWithTax = $totalWithoutTax + $totalTax;
@endphp

@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Belanja</h6>
            </a>
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                    <th>Quantity</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                    <th>Quantity</th>
                                    <th>Sub Total</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if (Cart::content()->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">List Kategori Kosong</td>
                                    </tr>
                                @else
                                    @php
                                        $no = 1
                                    @endphp
                                    @foreach (Cart::content() as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ 'Rp. ' . number_format($item->price) }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ 'Rp. ' . number_format($item->subtotal) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Checkout Form</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pesanan.store') }}" method="POST">
                    <!-- CSRF Token -->
                    @csrf
                    
                    <!-- Nama Pemesan Field -->
                    <div class="mb-3 has-validation">
                        <label for="nama" class="form-label">Nama Pemesan</label>
                        <input type="text" class="form-control {{ $errors->has('pemesan_pesanan') ? 'is-invalid' : '' }}" id="nama" name="pemesan_pesanan" placeholder="Masukkan Nama Pemesan" value="{{ old('pemesan_pesanan') }}">
                        <div class="invalid-feedback">{{ $errors->first('pemesan_pesanan') }}</div>
                    </div>
        
                    <!-- Total Belanja Field -->
                    <div class="mb-5">
                        <label for="email" class="form-label">Total Belanja (Rp)</label>
                        <div class="input-group mb-3 has-validation">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">Rp</span>
                            </div>
                            <input type="number" class="form-control {{ $errors->has('total_pesanan') ? 'is-invalid' : '' }}" id="total_pesanan" name="total_pesanan" value="{{ (!Cart::content()->isEmpty()) ? $totalWithoutTax : old('total_pesanan') }}">
                            <div class="invalid-feedback">{{ $errors->first('total_pesanan') }}</div>
                        </div>
                    </div>
        
                    <!-- Button Submit -->
                    <div class="row gap-2">
                        <div class="col-lg-6 col-sm-12">
                            <button type="submit" class="btn btn-primary btn-block">Open Bill</button>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <a href="#" class="btn btn-secondary btn-block" role="button">Payment</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/assets/js/demo/datatables-demo.js"></script>
@endsection

@section('styles')
     <!-- Custom styles for this page -->
     <link href="/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection