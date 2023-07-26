<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function store($menu_id) {
        $menu = Menu::find($menu_id);

        $cart = Cart::add([
            'id' => $menu->id, 
            'name' => $menu->nama_menu,
            'price' => $menu->harga_jual_menu,
            'qty' => 1,
            'tax' => 0,
            'harga_modal' => $menu->harga_modal_menu,
            
        ]);

        return back()->with('success', 'Berhasil manambahkan item ke keranjang.');
    }

    public function remove($cart_item_id) {
        $cart = Cart::remove($cart_item_id);

        return back()->with('success', 'Berhasil menghapus item dari keranjang.');
    }
}
