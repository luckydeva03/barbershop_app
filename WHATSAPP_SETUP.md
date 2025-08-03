# WhatsApp Booking Integration Setup

## Setup Nomor WhatsApp Business

1. **Edit file .env**
   Tambahkan nomor WhatsApp bisnis Anda ke file `.env`:
   ```
   WHATSAPP_BUSINESS_NUMBER=628123456789
   ```
   
   **Format Nomor:**
   - Gunakan kode negara tanpa tanda +
   - Untuk Indonesia: 62
   - Hilangkan angka 0 di depan nomor
   - Contoh: 0812-3456-789 → 6281234567890

2. **Cara Mendapatkan Nomor WhatsApp Business**
   - Buat akun WhatsApp Business
   - Atau gunakan nomor WhatsApp personal untuk bisnis kecil
   - Pastikan nomor aktif dan bisa menerima pesan

## Fitur yang Tersedia

### 1. Quick Book
- Button langsung di halaman booking
- Mengirim template pesan singkat
- URL: `/booking/quick`

### 2. Detailed Booking Form
- Form lengkap dengan data customer
- Pilihan layanan dan waktu
- Validasi form sebelum redirect
- URL: `/booking`

### 3. Template Pesan WhatsApp
Sistem akan membuat pesan dengan format:
```
🔥 BOOKING JADWAL BARBERSHOP 🔥

Halo! Saya ingin booking jadwal untuk:

👤 Nama: [Nama Customer]
✂️ Layanan: [Jenis Layanan]
📅 Tanggal: [Tanggal Booking]
🕐 Waktu: [Waktu Booking]
📞 No. HP: [Nomor HP] (opsional)

Mohon konfirmasi ketersediaan jadwal ini. Terima kasih! 🙏
```

## Keamanan dan Rate Limiting

- Rate limiting 10 request per menit untuk booking WhatsApp
- Validasi form server-side
- CSRF protection aktif
- Throttling untuk mencegah spam

## Customization

### Mengubah Template Pesan
Edit method `createBookingMessage()` di `BookingController.php`

### Menambah Layanan Baru
Edit dropdown di file `resources/views/pages/booking/index.blade.php`

### Mengubah Jam Operasional
Edit dropdown waktu di form booking

## Testing

1. Akses halaman home: `http://localhost:8000`
2. Klik button "Book Now"
3. Isi form atau gunakan "Quick Book"
4. Pastikan redirect ke WhatsApp berfungsi

## Notes
- Pastikan nomor WhatsApp di .env sudah benar
- Test dengan nomor WhatsApp yang aktif
- Pesan akan dikirim melalui WhatsApp Web/App
