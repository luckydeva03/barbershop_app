<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Show store locations page
     */
    public function index()
    {
        // Ambil data stores dari database
        $storesFromDB = Store::active()->ordered()->get();
        
        // Fallback data jika database kosong
        $fallbackStores = collect([
            (object)[
                'id' => 1,
                'name' => 'Altoz BarberShop - Jakarta Pusat',
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220',
                'phone' => '+62 21 1234-5678',
                'hours' => 'Senin - Minggu: 09:00 - 21:00',
                'latitude' => -6.2088,
                'longitude' => 106.8456,
                'image' => 'images/stores/store-jakarta.jpg',
                'description' => 'Flagship store kami di pusat Jakarta dengan fasilitas premium dan barber berpengalaman.',
                'badge' => 'Flagship Store',
                'badge_icon' => 'bi-star-fill',
                'maps_url' => 'https://maps.app.goo.gl/jakarta123',
                'is_featured' => true
            ],
            (object)[
                'id' => 2,
                'name' => 'Altoz BarberShop - Tangerang',
                'address' => 'Jl. BSD Boulevard No. 45, Tangerang Selatan, Banten 15345',
                'phone' => '+62 21 9876-5432',
                'hours' => 'Senin - Minggu: 10:00 - 22:00',
                'latitude' => -6.2624,
                'longitude' => 106.6500,
                'image' => 'images/stores/store-tangerang.jpg',
                'description' => 'Cabang modern di area BSD dengan konsep open space dan atmosfer yang nyaman.',
                'badge' => 'Modern Style',
                'badge_icon' => 'bi-building',
                'maps_url' => 'https://maps.app.goo.gl/tangerang456',
                'is_featured' => false
            ],
            (object)[
                'id' => 3,
                'name' => 'Altoz BarberShop - Arcamanik',
                'address' => 'Jl. Arcamanik No. 88, Arcamanik, Bandung, Jawa Barat 40293',
                'phone' => '+62 22 987-654',
                'hours' => 'Senin - Minggu: 09:00 - 21:00',
                'latitude' => -6.9175,
                'longitude' => 107.6191,
                'image' => 'images/stores/store-arcamanik.jpg',
                'description' => 'Cabang terbaru di Arcamanik Bandung dengan fasilitas modern dan pelayanan terbaik.',
                'badge' => 'Premium Location',
                'badge_icon' => 'bi-gem',
                'maps_url' => 'https://maps.app.goo.gl/arcamanik123',
                'is_featured' => true
            ]
        ]);
        
        // Gunakan data database jika ada, kalau tidak gunakan fallback
        $stores = $storesFromDB->count() > 0 ? $storesFromDB : $fallbackStores;
        
        // Google Maps API Key
        $googleMapsApiKey = config('services.google_maps.api_key');
        
        return view('pages.stores.index', compact('stores', 'googleMapsApiKey'));
    }

    /**
     * Get store data as JSON for AJAX requests
     */
    public function getStores()
    {
        $stores = Store::active()->ordered()->get();
        return response()->json($stores);
    }

    /**
     * Show individual store details
     */
    public function show($id)
    {
        // Cari store di database dulu
        $store = Store::active()->find($id);
        
        // Fallback jika tidak ada di database
        if (!$store) {
            $fallbackStores = [
                1 => [
                    'id' => 1,
                    'name' => 'Altoz BarberShop - Jakarta Pusat',
                    'address' => 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220',
                    'phone' => '+62 21 1234-5678',
                    'hours' => 'Senin - Minggu: 09:00 - 21:00',
                    'latitude' => -6.2088,
                    'longitude' => 106.8456,
                    'image' => 'images/store-jakarta.jpg',
                    'description' => 'Flagship store kami di pusat Jakarta dengan fasilitas premium dan barber berpengalaman.',
                    'services' => ['Premium Haircut', 'Beard Trim', 'Hair Wash', 'Styling', 'Complete Grooming']
                ],
                2 => [
                    'id' => 2,
                    'name' => 'Altoz BarberShop - Tangerang',
                    'address' => 'Jl. BSD Boulevard No. 45, Tangerang Selatan, Banten 15345',
                    'phone' => '+62 21 9876-5432',
                    'hours' => 'Senin - Minggu: 10:00 - 22:00',
                    'latitude' => -6.2624,
                    'longitude' => 106.6500,
                    'image' => 'images/store-tangerang.jpg',
                    'description' => 'Cabang modern di area BSD dengan konsep open space dan atmosfer yang nyaman.',
                    'services' => ['Premium Haircut', 'Beard Trim', 'Kids Haircut', 'Hair Wash', 'Styling']
                ],
                3 => [
                    'id' => 3,
                    'name' => 'Altoz BarberShop - Arcamanik',
                    'address' => 'Jl. Arcamanik No. 88, Arcamanik, Bandung, Jawa Barat 40293',
                    'phone' => '+62 22 987-654',
                    'hours' => 'Senin - Minggu: 09:00 - 21:00',
                    'latitude' => -6.9175,
                    'longitude' => 107.6191,
                    'image' => 'images/store-arcamanik.jpg',
                    'description' => 'Cabang terbaru di Arcamanik Bandung dengan fasilitas modern dan pelayanan terbaik.',
                    'services' => ['Premium Haircut', 'Beard Trim', 'Complete Grooming', 'VIP Package']
                ]
            ];
            
            $store = $fallbackStores[$id] ?? abort(404);
            // Convert array to object untuk konsistensi
            $store = (object) $store;
            $store->services = $store->services ?? ['Premium Haircut', 'Beard Trim', 'Hair Wash', 'Styling'];
        } else {
            // Jika dari database, tambahkan services default
            $store->services = ['Premium Haircut', 'Beard Trim', 'Hair Wash', 'Styling', 'Complete Grooming'];
        }

        $googleMapsApiKey = env('GOOGLE_MAPS_API_KEY', '');

        return view('pages.stores.show', compact('store', 'googleMapsApiKey'));
    }
}
