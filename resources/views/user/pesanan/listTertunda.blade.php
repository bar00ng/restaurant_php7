@extends('user.template.master')

@section('content')
<div class="row overflow-auto" style="max-height: 60vh;">
    @foreach ($data as $d)
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-body d-flex align-items-end justify-content-between">
                    <div>
                        <div class="h5 text-truncate"><b>{{ $d['pemesan_pesanan'] }}</b></div>
                        <div><p class="text-xs">{{ $d['tanggal_pesanan'] }}</p></div>
                        <div class="text-sm text-gray-500">{{ 'Rp ' . number_format($d['total_pesanan']) }}</div>
                    </div>
                    <div>
                        <a href="{{ route('pesanan.checkout', ['kd_pesanan' => $d['kd_pesanan']]) }}" class="btn btn-google btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Checkout">
                            <i class="fas fa-wallet fa-fw"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection