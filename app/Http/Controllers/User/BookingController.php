<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Show the booking page
     */
    public function index()
    {
        return view('pages.booking.index');
    }

    /**
     * Redirect to WhatsApp with booking template
     */
    public function redirectToWhatsApp(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'date' => 'required|date|after:today',
            'time' => 'required|string',
            'phone' => 'nullable|string|max:20'
        ]);

        // WhatsApp business number (ganti dengan nomor WhatsApp bisnis Anda)
        $whatsappNumber = env('WHATSAPP_BUSINESS_NUMBER', '6281234567890'); // Format: 62 untuk Indonesia + nomor tanpa 0 di depan
        
        // Create booking message template
        $message = $this->createBookingMessage(
            $request->name,
            $request->service,
            $request->date,
            $request->time,
            $request->phone
        );

        // Encode message for URL
        $encodedMessage = urlencode($message);
        
        // Create WhatsApp URL
        $whatsappUrl = "https://wa.me/{$whatsappNumber}?text={$encodedMessage}";
        
        return redirect($whatsappUrl);
    }

    /**
     * Create booking message template
     */
    private function createBookingMessage($name, $service, $date, $time, $phone = null)
    {
        $formattedDate = date('d F Y', strtotime($date));
        
        $message = "🔥 *BOOKING JADWAL BARBERSHOP* 🔥\n\n";
        $message .= "Halo! Saya ingin booking jadwal untuk:\n\n";
        $message .= "👤 *Nama:* {$name}\n";
        $message .= "✂️ *Layanan:* {$service}\n";
        $message .= "📅 *Tanggal:* {$formattedDate}\n";
        $message .= "🕐 *Waktu:* {$time}\n";
        
        if ($phone) {
            $message .= "📞 *No. HP:* {$phone}\n";
        }
        
        $message .= "\nMohon konfirmasi ketersediaan jadwal ini. Terima kasih! 🙏";
        
        return $message;
    }

    /**
     * Quick booking - direct WhatsApp redirect
     */
    public function quickBook()
    {
        // WhatsApp business number
        $whatsappNumber = env('WHATSAPP_BUSINESS_NUMBER', '6281234567890'); // Ganti dengan nomor WhatsApp bisnis Anda
        
        // Quick booking message
        $message = "🔥 *BOOKING JADWAL BARBERSHOP* 🔥\n\n";
        $message .= "Halo! Saya ingin booking jadwal untuk potong rambut.\n";
        $message .= "Mohon informasi jadwal yang tersedia. Terima kasih! 🙏";
        
        $encodedMessage = urlencode($message);
        $whatsappUrl = "https://wa.me/{$whatsappNumber}?text={$encodedMessage}";
        
        return redirect($whatsappUrl);
    }
}
