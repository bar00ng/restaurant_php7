@extends('user.template.master')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Menu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Harga Modal(Rp.)</th>
                            <th>Harga Jual(Rp.)</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Harga Modal(Rp.)</th>
                            <th>Harga Jual(Rp.)</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if ($menu->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">List Menu Kosong</td>
                            </tr>
                        @else
                            @php
                                $no = 1
                            @endphp
                            @foreach ($menu as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item['nama_menu'] }}</td>
                                    <td>{{ number_format($item['harga_modal_menu']) }}</td>
                                    <td>{{ number_format($item['harga_jual_menu']) }}</td>
                                    <td>{{ $item->kategori['nama_kategori'] }}</td>
                                    <td>
                                        @if ($item['inStock'])
                                            <span class="badge bg-success p-2 text-white">In Stock</span>
                                        @else
                                            <span class="badge bg-danger p-2 text-white">Out of Stock</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('menu.form.edit', ['menu_id' => $item['id']]) }}" class="mr-2">
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit data"><i class="fas fa-fw fa-pen"></i></button>
                                        </a>
                                        <form action="{{ route('menu.delete', ['menu_id' => $item['id']]) }}" class="ml-2" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete data" type="submit"><i class="fas fa-fw fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
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