<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Pengajuan;

class PengajuanStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    protected $pengajuan;

    /**
     * Create a new notification instance.
     */
    public function __construct(Pengajuan $pengajuan)
    {
        $this->pengajuan = $pengajuan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database']; // Kirim ke email dan simpan di database
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $status = $this->mapStatus();

        return (new MailMessage)
            ->subject('Status Pengajuan Diperbarui')
            ->greeting('Halo, ' . $notifiable->employee_name)
            ->line('Status pengajuan Anda telah berubah.')
            ->line('Status saat ini: ' . $status)
            ->action('Lihat Pengajuan', url('/pengajuan/' . $this->pengajuan->pengajuan_id))
            ->line('Terima kasih telah menggunakan sistem MySatnusa.');
    }

    /**
     * Get the array representation of the notification (untuk database).
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        $status = $this->mapStatus();

        return [
            'pengajuan_id' => $this->pengajuan->pengajuan_id,
            'title' => 'Status Pengajuan Diperbarui',
            'message' => 'Pengajuan Anda berubah menjadi status: ' . $status,
            'url' => url('/pengajuan/' . $this->pengajuan->pengajuan_id),
        ];
    }

    /**
     * Map kombinasi status ke label deskriptif seperti di controller.
     */
    private function mapStatus(): string
    {
        if ($this->pengajuan->approve_QHSE === 'pending') {
            return 'Menunggu QHSE';
        } elseif ($this->pengajuan->approve_QHSE === 'approved' && $this->pengajuan->approve_HRD === 'pending') {
            return 'Menunggu HRD';
        } elseif ($this->pengajuan->approve_QHSE === 'approved' && $this->pengajuan->approve_HRD === 'approved') {
            return 'Disetujui';
        } elseif ($this->pengajuan->approve_QHSE === 'rejected') {
            return 'Ditolak QHSE';
        } elseif ($this->pengajuan->approve_HRD === 'rejected') {
            return 'Ditolak HRD';
        }

        return 'Status tidak diketahui';
    }
}
