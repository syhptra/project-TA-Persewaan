<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('barang')->insert([
            [
                'nama' => 'Tenda Dome Kapasitas 4 Orang',
                'deskripsi' => 'Tenda anti air dengan ventilasi udara dan alas tahan lembap. Cocok untuk keluarga kecil.',
                'harga' => 75000,
                'gambar' => 'https://cdn.pixabay.com/photo/2017/06/20/19/22/tent-2425235_1280.jpg',
            ],
            [
                'nama' => 'Sleeping Bag Polar',
                'deskripsi' => 'Sleeping bag berbahan polar, hangat dan nyaman untuk suhu malam di gunung.',
                'harga' => 30000,
                'gambar' => 'https://cdn.pixabay.com/photo/2018/03/25/21/19/sleeping-bag-3265601_1280.jpg',
            ],
            [
                'nama' => 'Kompor Portable Gas Butane',
                'deskripsi' => 'Kompor portabel ringan dengan pengaturan api stabil, cocok untuk memasak di alam.',
                'harga' => 25000,
                'gambar' => 'https://cdn.pixabay.com/photo/2020/07/25/18/24/camping-stove-5436693_1280.jpg',
            ],
            [
                'nama' => 'Matras Gulung Waterproof',
                'deskripsi' => 'Matras gulung ringan, tidak tembus air, nyaman untuk alas tidur.',
                'harga' => 15000,
                'gambar' => 'https://cdn.pixabay.com/photo/2017/03/15/14/21/mat-2148573_1280.jpg',
            ],
            [
                'nama' => 'Lampu Camping Rechargeable',
                'deskripsi' => 'Lampu LED dengan daya tahan hingga 10 jam, bisa dicharge via USB.',
                'harga' => 20000,
                'gambar' => 'https://cdn.pixabay.com/photo/2017/03/02/12/20/lantern-2118810_1280.jpg',
            ],
            [
                'nama' => 'Tas Carrier 60L',
                'deskripsi' => 'Tas gunung 60 liter, banyak kompartemen dan bahan anti air.',
                'harga' => 40000,
                'gambar' => 'https://cdn.pixabay.com/photo/2015/10/12/14/59/backpack-984611_1280.jpg',
            ],
        ]);
    }
}
