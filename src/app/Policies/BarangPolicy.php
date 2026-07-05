<?php

namespace App\Policies;

use App\Models\Barang;
use App\Models\User;

class BarangPolicy
{
    /**
     * Semua user yang sudah login (role apa pun) boleh melihat data.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Barang $barang): bool
    {
        return true;
    }

    /**
     * Hanya admin yang boleh tambah, ubah, hapus data barang.
     * User biasa bersifat read-only total sesuai kebijakan yang ditetapkan.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Barang $barang): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Barang $barang): bool
    {
        return $user->role === 'admin';
    }
}
