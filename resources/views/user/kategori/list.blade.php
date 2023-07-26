@extends('user.template.master')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if ($kategori->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">List Kategori Kosong</td>
                            </tr>
                        @else
                            @php
                                $no = 1
                            @endphp
                            @foreach ($kategori as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item['nama_kategori'] }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('kategori.form.edit', ['kategori_id' => $item['id']]) }}" class="mr-2">
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit data"><i class="fas fa-fw fa-pen"></i></button>
                                        </a>
                                        <form action="{{ route('kategori.delete', ['kategori_id' => $item['id']]) }}" class="ml-2" method="post">
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