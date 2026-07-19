<?php

namespace App\Policies;

use App\Models\Barang;
use App\Models\User;

class BarangPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view barang');
    }

    public function view(User $user, Barang $barang): bool
    {
        return $user->can('view barang');
    }

    public function create(User $user): bool
    {
        return $user->can('create barang');
    }

    public function update(User $user, Barang $barang): bool
    {
        return $user->can('update barang');
    }

    public function delete(User $user, Barang $barang): bool
    {
        return $user->can('delete barang');
    }
}
