<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Menu;

class KategoriMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeder untuk tabel Kategori
        $kategoriData = [
            'Makanan Ringan',
            'Makanan Berat',
            'Minuman Dingin',
            'Minuman Hangat',
            'Makanan Penutup',
            'Makanan Sehat',
            'Makanan Goreng',
            'Makanan Tradisional',
            'Makanan Internasional',
            'Makanan Nusantara',
        ];

        foreach ($kategoriData as $kategoriName) {
            Kategori::create([
                'nama_kategori' => $kategoriName,
            ]);
        }

        // Seeder untuk tabel Menu
        $kategoriIds = Kategori::pluck('id')->toArray();

        for ($i = 1; $i <= 10; $i++) {
            foreach ($kategoriIds as $kategoriId) {
                Menu::create([
                    'nama_menu' => 'Menu ' . $i . ' Kategori ' . $kategoriId,
                    'harga_modal_menu' => rand(5, 20) * 1000,
                    'harga_jual_menu' => rand(25, 50) * 1000,
                    'kategori_id' => $kategoriId,
                ]);
            }
        }
    }
}
