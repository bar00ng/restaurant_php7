@extends('user.template.master')

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
                                @if ($data_detail->isEmpty())
                                    <tr>
                                        <td colspan="10" class="text-center">List Belanja Kosong</td>
                                    </tr>
                                @else
                                    @php
                                        $no = 1
                                    @endphp
                                    @foreach ($data_detail as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->menu->nama_menu }}</td>
                                            <td>{{ 'Rp. ' . number_format($item->menu->harga_jual_menu) }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ 'Rp. ' . number_format($item->sub_total) }}</td>
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
                <form action="{{ route('payment.store', ['kd_pesanan' => $data['kd_pesanan']]) }}" method="POST">
                    <!-- CSRF Token -->
                    @csrf
                    <div class="form-row">
                        <!-- Tgl Pesanan Field -->
                        <div class="col-6 mb-3 has-validation">
                            <label for="nama" class="form-label">Tanggal Pesanan</label>
                            <input type="date" class="form-control" value="{{ $data['tanggal_pesanan'] }}" readonly>
                        </div>

                        <!-- Tgl Pesanan Field -->
                        <div class="col-6 mb-3 has-validation">
                            <label for="nama" class="form-label">Kode Pesanan</label>
                            <input type="text" class="form-control" value="{{ $data['kd_pesanan'] }}" readonly>
                        </div>
                    </div>

                    <!-- Nama Pemesan Field -->
                    <div class="mb-3 has-validation">
                        <label for="nama" class="form-label">Nama Pemesan</label>
                        <input type="text" class="form-control" value="{{ $data['pemesan_pesanan'] }}" readonly>
                    </div>
        
                    <!-- Total Belanja Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Total Belanja (Rp)</label>
                        <div class="input-group mb-3 has-validation">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">Rp</span>
                            </div>
                            <input type="number" class="form-control" value="{{ $data['total_pesanan'] }}" name="total_pesanan" readonly>
                        </div>
                    </div>

                    <div class="form-row mb-5">
                        {{-- Nomninal Pembayaran Field --}}
                        <div class="col-6">
                            <label for="email" class="form-label">Nominal Bayar (Rp)</label>
                            <div class="input-group mb-3 has-validation">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                </div>
                                <input type="number" class="form-control {{ $errors->has('nominal_payment') ? 'is-invalid' : '' }}" name="nominal_payment" placeholder="Masukkan Nominal Bayar..." id="nominal-payment" value="{{ old('nominal_payment') }}" autofocus>
                                <div class="invalid-feedback">{{ $errors->first('nominal_payment') }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="email" class="form-label">Nominal Kembalian (Rp)</label>
                            <div class="input-group mb-3 has-validation">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                </div>
                                <input type="number" class="form-control {{ $errors->has('kembalian_payment') ? 'is-invalid' : '' }}" name="kembalian_payment" id="kembalian-payment" value="{{ $errors->has('kembalian_payment') ? old('kembalian_payment') : '0' }}" readonly>
                                <div class="invalid-feedback">{{ $errors->first('kembalian_payment') }}</div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Button Submit -->
                    <div class="row gap-2">
                        <div class="col-lg-6 col-sm-12">
                            <button type="submit" class="btn btn-primary btn-block">Bayar Sekarang</button>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <a href="#" class="btn btn-danger btn-block" role="button">Cancel</a>
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

    {{-- Jquery Kalkulasi Kembalian --}}
    <script>
        $(document).ready(function() {
            var totalBelanja = {{ $data['total_pesanan'] }};
            
            $("#nominal-payment").keyup(function() {
                var nominalPayment = parseFloat($(this).val());

                $("#kembalian-payment").val(nominalPayment - totalBelanja);
            });
        });
    </script>
@endsection

@section('styles')
     <!-- Custom styles for this page -->
     <link href="/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection