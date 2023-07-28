@extends('user.template.master')

@section('content')
<div class="row overflow-auto" style="max-height: 60vh;">
    @php
        $no = 1;
    @endphp
    @foreach ($data as $d)
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-body d-flex align-items-end justify-content-between">
                    <div>
                        <div class="h5 text-truncate"><b>{{ $d['pemesan_pesanan'] }}</b></div>
                        <div>
                            <p class="text-xs">{{ $d['tanggal_pesanan'] }}</p>
                        </div>

                        <div class="text-sm text-gray-500">{{ 'Rp ' . number_format($d['total_pesanan']) }}</div>

                        <div class="mt-3 d-flex">
                            <form action="{{ route('pesanan.delete', ['kd_pesanan' => $d['kd_pesanan']]) }}" class="ml-2" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete data" type="submit"><i class="fas fa-fw fa-trash"></i></button>
                            </form>

                            <button type="button" class="btn btn-primary btn-sm ml-2" data-toggle="modal" data-target="#detail-modal-{{ $no }}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Detail Pesanan">
                                <i class="fas fa-eye fa-fw"></i>
                            </button>

                            {{-- Modal Detail Pesanan --}}
                            <div class="modal fade" id="detail-modal-{{ $no }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan {{ $d['kd_pesanan'] }}</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row">
                                            <dt class="col-sm-4">Tanggal Pesan</dt>
                                            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($d['tanggal_pesanan'])->format('d F Y') }}</dd>
                                          
                                            <dt class="col-sm-4">Nama Pemesan</dt>
                                            <dd class="col-sm-8">{{ $d['pemesan_pesanan'] }}</dd>

                                            <dt class="col-sm-4">Tanggal Bayar</dt>
                                            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($d->payment->created_at)->format('d F Y') }}</dd>

                                            <dt class="col-sm-4">Daftar Belanja</dt>
                                            <dd class="col-sm-8">
                                                <ul class="list-unstyled">
                                                    @foreach ($d->detailPesanan as $item)
                                                        <li>{{ $item->menu->nama_menu . ' - ' . $item->qty }}</li>
                                                    @endforeach
                                                </ul>
                                            </dd>

                                            <dt class="col-sm-4">Total Bayar</dt>
                                            <dd class="col-sm-8">{{ 'Rp. ' . number_format($d['total_pesanan']) }}</dd>

                                            <dt class="col-sm-4">Nominal Payment</dt>
                                            <dd class="col-sm-8">{{ 'Rp. ' . number_format($d->payment->nominal_payment) }}</dd>

                                            <dt class="col-sm-4">Kembali Payment</dt>
                                            <dd class="col-sm-8">{{ 'Rp. ' . number_format($d->payment->kembalian_payment) }}</dd>
                                        </dl>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $no++;
        @endphp
    @endforeach
</div>
@endsection