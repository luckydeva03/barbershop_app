# 🏪 Store Management - Kode Langsung

## 📋 Update: Admin Panel Dihapus

**⚠️ PENTING**: Pengelolaan stores dilakukan melalui **kode langsung**.

## 🔧 Cara Mengelola Stores Melalui Kode

### ✅ **1. Menggunakan Database Seeder**

**File**: `database/seeders/StoreSeeder.php`
- **Edit data stores**: Ubah array `$stores` di dalam seeder
- **Jalankan ulang**: `php artisan db:seed --class=StoreSeeder`
- **Table**: `stores`

### ✅ **Frontend Integration**
- **URL Public**: `http://127.0.0.1:8000/stores`
- **Auto fallback**: Jika database kosong, gunakan hardcoded data
- **Google Maps**: Otomatis terintegrasi
- **Responsive**: Bootstrap 5 design

## 🔧 Struktur Database

```sql
CREATE TABLE stores (
    id BIGINT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    hours VARCHAR(255) DEFAULT '09:00 - 21:00',
    latitude DECIMAL(10,7) NOT NULL,
    longitude DECIMAL(10,7) NOT NULL,
    image VARCHAR(255) NULL,
    is_active BOOLEAN DEFAULT TRUE,
    order_sort INTEGER DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP NULL
);
```

## 🎯 Cara Menggunakan

### 1. **Login ke Admin Panel**
```
URL: http://127.0.0.1:8000/sudut-potong/admin/login

Available Admin Credentials:
- Email: admin@haircut.com | Password: password123
```

### ⚠️ **Troubleshooting Tampilan**

Jika mengalami masalah tampilan (background putih, text tidak terlihat):

1. **Clear Cache:**
```bash
php artisan view:clear
php artisan config:clear  
php artisan route:clear
```

2. **Pastikan Admin Seeder Sudah Dijalankan:**
```bash
php artisan db:seed --class=AdminSeeder
```

3. **Restart Server:**
```bash
php artisan serve
```

4. **Hard Refresh Browser:**
- Windows: `Ctrl + F5`
- Mac: `Cmd + Shift + R`

### 2. **Akses Store Management**
- Klik **"Store Management"** di sidebar admin
- Atau langsung ke: `http://127.0.0.1:8000/sudut-potong/admin/stores`

### 3. **Menambah Store Baru**
- Klik tombol **"Add New Store"**
- Isi form dengan informasi store:
  - **Name**: Nama store (required)
  - **Description**: Deskripsi store (optional)
  - **Address**: Alamat lengkap (required)
  - **Phone**: Nomor telepon (required)
  - **Hours**: Jam operasional (required)
  - **Latitude**: Koordinat lintang (required, -90 to 90)
  - **Longitude**: Koordinat bujur (required, -180 to 180)
  - **Image**: Upload gambar store (optional, max 2MB)
  - **Display Order**: Urutan tampilan (optional, default 0)
  - **Active Status**: Aktif/tidak aktif (checkbox)

### 4. **Mengedit Store**
- Klik tombol **edit (pensil)** pada store yang ingin diubah
- Update informasi yang diperlukan
- Klik **"Update Store"**

### 5. **Mengelola Status**
- **Toggle Active/Inactive**: Klik tombol toggle untuk mengaktifkan/menonaktifkan store
- **Delete Store**: Klik tombol delete (trash) dengan konfirmasi SweetAlert

### 6. **Upload Gambar**
- **Format**: JPEG, PNG, JPG, GIF
- **Ukuran**: Maksimal 2MB
- **Storage**: `public/images/stores/`
- **Preview**: Otomatis saat upload

## 🗂️ File Structure

```
app/
├── Models/
│   └── Store.php                              # Model Store
├── Http/Controllers/
│   ├── Admin/
│   │   └── StoreManagementController.php      # Controller admin
│   └── User/
│       └── StoreController.php                # Controller public (updated)
database/
├── migrations/
│   └── 2025_08_03_172056_create_stores_table.php
└── seeders/
    └── StoreSeeder.php
resources/views/
├── admin/stores/
│   ├── index.blade.php                        # List stores
│   ├── create.blade.php                       # Form tambah store
│   ├── edit.blade.php                         # Form edit store
│   └── show.blade.php                         # Detail store
├── components/
│   └── sidebar.blade.php                      # Updated dengan menu Store Management
└── pages/stores/
    └── index.blade.php                        # Public store page (existing)
public/images/stores/                          # Directory untuk gambar
routes/web.php                                 # Updated dengan admin routes
```

## 🔗 Routes

### Admin Routes (Protected)
```php
// Store Management - Admin Panel
Route::resource('stores', StoreManagementController::class)->names([
    'index' => 'admin.stores.index',
    'create' => 'admin.stores.create', 
    'store' => 'admin.stores.store',
    'show' => 'admin.stores.show',
    'edit' => 'admin.stores.edit',
    'update' => 'admin.stores.update',
    'destroy' => 'admin.stores.destroy'
]);

// Additional Actions
Route::post('stores/{store}/toggle-status', 'toggleStatus')->name('admin.stores.toggle-status');
Route::post('stores/update-order', 'updateOrder')->name('admin.stores.update-order');
```

### Public Routes
```php
// Public Store Pages
Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('/stores/data', [StoreController::class, 'getStores'])->name('stores.data');
Route::get('/stores/{id}', [StoreController::class, 'show'])->name('stores.show');
```

## 🚀 Sample Data

Seeder akan membuat 4 store sample:
1. **Altoz BarberShop - Central Jakarta** (Thamrin)
2. **Altoz BarberShop - South Jakarta** (Senopati)  
3. **Altoz BarberShop - West Jakarta** (Puri Indah)
4. **Altoz BarberShop - East Jakarta** (Bekasi Raya)

## 🔐 Security Features

- **Rate Limiting**: 120 requests/minute untuk admin operations
- **CSRF Protection**: Semua form menggunakan @csrf
- **File Upload Validation**: Type dan size validation
- **Input Validation**: Server-side validation lengkap
- **Soft Deletes**: Data tidak benar-benar dihapus
- **Admin Authentication**: Hanya admin yang bisa akses

## 📱 Responsive Design

- **Desktop**: Full table view dengan semua kolom
- **Tablet**: Responsive table dengan scroll horizontal
- **Mobile**: Card layout dengan essential info
- **DataTables**: Pagination, sorting, searching
- **SweetAlert**: Konfirmasi delete yang elegant

## 🌍 Google Maps Integration

- **Koordinat GPS**: Latitude/longitude untuk setiap store
- **Map Preview**: Preview lokasi di form edit
- **Public Maps**: Google Maps di halaman public stores
- **API Integration**: Menggunakan GOOGLE_MAPS_API_KEY

## ⚙️ Configuration

### Environment Variables
```env
# Google Maps (Optional)
GOOGLE_MAPS_API_KEY=your_google_maps_api_key_here
```

### Storage Permissions
Pastikan folder `public/images/stores/` memiliki write permission:
```bash
chmod 755 public/images/stores/
```

## 🎨 UI Features

- **Bootstrap 5**: Modern, responsive design
- **Bootstrap Icons**: Consistent iconography  
- **DataTables**: Advanced table functionality
- **SweetAlert2**: Beautiful confirmation dialogs
- **Image Upload**: Drag & drop dengan preview
- **Form Validation**: Real-time client-side validation
- **Loading States**: Smooth UX transitions

## 📊 Analytics (Future)

Struktur sudah siap untuk menambahkan:
- View counts per store
- Booking statistics 
- Popular locations
- Performance metrics
- Customer feedback integration

---

**✅ Status**: Fully Implemented & Ready to Use!  
**🔄 Integration**: Seamless dengan existing stores page  
**🛡️ Security**: Admin-only access dengan full validation  
**📱 Mobile Ready**: Responsive design untuk semua device  
