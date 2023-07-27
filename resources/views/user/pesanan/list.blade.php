@extends('user.template.master')

@section('content')
    <div class="row overflow-auto" style="max-height: 60vh;">
        @foreach ($inStockMenus as $menu)
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body d-flex align-items-end justify-content-between">
                        <div>
                            <div class="h6 text-truncate">{{ $menu['nama_menu'] }}</div>
                            <div class="text-sm text-gray-500">{{ 'Rp ' . number_format($menu['harga_jual_menu']) }}</div>
                        </div>
                        <div>
                            <form action="{{ route('cart.store', ['menu_id' => $menu->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm add-to-cart" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to Cart" data-id={{ $menu['id'] }}><i class="fas fa-shopping-cart fa-fw"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
