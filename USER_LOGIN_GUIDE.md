# User Login Instructions

## 🔐 **Cara Login Sebagai User**

### **1. Akses Halaman Login**
- Klik menu **"Login"** di navbar pada halaman apapun (Home, Stores, Booking)
- Atau langsung ke: `http://127.0.0.1:8000/login`

### **2. Credentials Test User**
Gunakan akun test yang sudah dibuat:
- **Email**: `test@example.com`
- **Password**: `password`

### **3. Step by Step Login:**
1. ✅ Buka `http://127.0.0.1:8000/login`
2. ✅ Input Email: `test@example.com`
3. ✅ Input Password: `password`
4. ✅ Klik tombol "Login"
5. ✅ Akan redirect ke dashboard user

### **4. Atau Daftar User Baru:**
1. ✅ Buka `http://127.0.0.1:8000/register`
2. ✅ Isi form pendaftaran
3. ✅ Setelah berhasil, login dengan akun baru

## 🎯 **Setelah Login Berhasil**

### **Dashboard User akan menampilkan:**
- ✅ Profile user (nama, email, points)
- ✅ Menu navigasi user (Review, History, Redeem Code)
- ✅ Informasi point yang dimiliki
- ✅ Akses ke fitur-fitur user

### **Menu Navbar berubah menjadi:**
- **Login** → **Dashboard** (setelah user login)
- Tambahan menu logout

## 🔄 **Flow Navigation**

### **Sebelum Login:**
```
Home → Our Stores → Booking → [Login]
```

### **Setelah Login:**
```
Home → Our Stores → Booking → [Dashboard] → Logout
```

## 🎊 **Testing Login:**

### **Quick Test:**
1. Buka: `http://127.0.0.1:8000/login`
2. Email: `test@example.com`
3. Password: `password`
4. Login → Dashboard

### **Create New User Test:**
1. Buka: `http://127.0.0.1:8000/register`
2. Isi data lengkap
3. Register → Login → Dashboard

## 📋 **Features Available After Login:**
- ✅ **Dashboard**: Overview user profile dan points
- ✅ **Review**: Memberikan review untuk barbershop
- ✅ **History Point**: Melihat riwayat transaksi point
- ✅ **Redeem Code**: Menukar kode reward
- ✅ **Logout**: Keluar dari sistem

**🎯 Test sekarang dengan credentials: `test@example.com` / `password`**
