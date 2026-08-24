<?php

namespace App\Listeners;

use App\Services\ActivityLogger;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

/**
 * Mencatat login, logout, dan percobaan login gagal ke activity_logs lewat
 * ActivityLogger::log(). Bekerja dengan event bawaan Laravel
 * (Illuminate\Auth\Events\*), otomatis terpasang selama proses login
 * memakai Auth::attempt() / Auth::login() standar Laravel (termasuk lewat
 * Breeze/Fortify/Jetstream).
 */
class LogAuthActivity
{
    public function handleLogin(Login $event): void
    {
        ActivityLogger::log(
            loggableType: get_class($event->user),
            loggableId: (int) $event->user->getAuthIdentifier(),
            action: 'login',
            metadata: [
                'nama'  => $event->user->name ?? null,
                'email' => $event->user->email ?? null,
                'ip'    => request()->ip(),
            ],
        );
    }

    public function handleLogout(Logout $event): void
    {
        // $event->user bisa null kalau sesi sudah tidak valid saat logout
        // dipicu (mis. token expired). Tanpa user, tidak ada loggableId
        // valid untuk dikirim (ActivityLogger::log() mewajibkan int), jadi
        // di-skip saja daripada memaksakan ID yang salah.
        if (!$event->user) {
            return;
        }

        ActivityLogger::log(
            loggableType: get_class($event->user),
            loggableId: (int) $event->user->getAuthIdentifier(),
            action: 'logout',
            metadata: [
                'nama'  => $event->user->name ?? null,
                'email' => $event->user->email ?? null,
                'ip'    => request()->ip(),
            ],
        );
    }

    public function handleFailed(Failed $event): void
    {
        // Kalau $event->user null (email/username sama sekali tidak
        // ditemukan), tidak ada ID user yang valid untuk loggable_id —
        // ActivityLogger::log() mewajibkan int, bukan nullable, jadi kita
        // TIDAK bisa memaksa loggable ke user acak/ID palsu (akan mencemari
        // data audit). Kasus ini sengaja tidak dicatat ke activity_logs;
        // kalau butuh audit trail untuk percobaan ke email yang tidak
        // terdaftar, sebaiknya pakai channel log Laravel biasa
        // (Log::warning()) dan bukan tabel activity_logs.
        if (!$event->user) {
            return;
        }

        ActivityLogger::log(
            loggableType: get_class($event->user),
            loggableId: (int) $event->user->getAuthIdentifier(),
            action: 'login_failed',
            metadata: [
                'email' => $event->user->email ?? ($event->credentials['email'] ?? null),
                'ip'    => request()->ip(),
            ],
        );
    }
}