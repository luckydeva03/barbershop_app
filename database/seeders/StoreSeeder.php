<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = [
            [
                'name' => 'Altoz BarberShop - Central Jakarta',
                'description' => 'Our flagship store in the heart of Jakarta, offering premium grooming services with modern facilities and experienced barbers.',
                'address' => 'Jl. Thamrin No. 1, Central Jakarta, DKI Jakarta 10310',
                'phone' => '+62 21 3919 2004',
                'hours' => '09:00 - 21:00',
                'latitude' => -6.1944,
                'longitude' => 106.8229,
                'image' => 'images/stores/store-1.jpg',
                'is_active' => true,
                'order_sort' => 1,
            ],
            [
                'name' => 'Altoz BarberShop - South Jakarta',
                'description' => 'Located in the bustling Kebayoran area, providing top-notch haircuts and beard styling services.',
                'address' => 'Jl. Senopati No. 45, South Jakarta, DKI Jakarta 12190',
                'phone' => '+62 21 7209 8765',
                'hours' => '10:00 - 22:00',
                'latitude' => -6.2297,
                'longitude' => 106.8175,
                'image' => 'images/stores/store-2.jpg',
                'is_active' => true,
                'order_sort' => 2,
            ],
            [
                'name' => 'Altoz BarberShop - West Jakarta',
                'description' => 'Serving the West Jakarta community with professional grooming services in a comfortable and stylish environment.',
                'address' => 'Jl. Puri Indah Raya No. 88, West Jakarta, DKI Jakarta 11610',
                'phone' => '+62 21 5890 4321',
                'hours' => '09:30 - 21:30',
                'latitude' => -6.1887,
                'longitude' => 106.7334,
                'image' => 'images/stores/store-3.jpg',
                'is_active' => true,
                'order_sort' => 3,
            ],
            [
                'name' => 'Altoz BarberShop - East Jakarta',
                'description' => 'Premium barbershop services for the East Jakarta area, featuring skilled barbers and quality products.',
                'address' => 'Jl. Bekasi Raya No. 123, East Jakarta, DKI Jakarta 13920',
                'phone' => '+62 21 8765 1234',
                'hours' => '08:00 - 20:00',
                'latitude' => -6.2146,
                'longitude' => 106.9227,
                'image' => 'images/stores/store-4.jpg',
                'is_active' => true,
                'order_sort' => 4,
            ],
        ];

        foreach ($stores as $store) {
            Store::create($store);
        }
    }
}
