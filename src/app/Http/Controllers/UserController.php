<?php

namespace App\Http\Controllers;

use App\Models\RbacAuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('view user_management');

        $search = trim((string) $request->get('q', ''));

        $users = User::with('roles')
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($w) use ($search) {
                    $w->where('name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('users.index', compact('users', 'search'));
    }

    public function create()
    {
        Gate::authorize('create user_management');

        return view('users.form', [
            'user'  => new User(),
            'roles' => Role::orderBy('name')->pluck('name'),
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('create user_management');

        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:100', Rule::unique('users', 'username')],
            'email'    => ['nullable', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', Password::defaults()],
            'roles'    => ['required', 'array', 'min:1'],
            'roles.*'  => ['string', Rule::exists('roles', 'name')],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'username' => $data['username'],
            'email'    => $data['email'] ?? null,
            'password' => Hash::make($data['password']),
        ]);

        $user->syncRoles($data['roles']);

        RbacAuditLog::record('user.created', 'User', $user->name, ['roles' => $data['roles']]);

        return redirect()->route('users.index')->with('success', "User \"{$user->name}\" dibuat.");
    }

    public function edit(User $user)
    {
        Gate::authorize('view user_management');

        return view('users.form', [
            'user'  => $user,
            'roles' => Role::orderBy('name')->pluck('name'),
        ]);
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('update user_management');

        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:100', Rule::unique('users', 'username')->ignore($user->id)],
            'email'    => ['nullable', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'roles'    => ['required', 'array', 'min:1'],
            'roles.*'  => ['string', Rule::exists('roles', 'name')],
        ]);

        $user->update([
            'name'     => $data['name'],
            'username' => $data['username'],
            'email'    => $data['email'] ?? null,
        ]);

        if (!empty($data['password'])) {
            $user->update(['password' => Hash::make($data['password'])]);
        }

        $oldRoles = $user->getRoleNames()->all();
        $user->syncRoles($data['roles']);

        RbacAuditLog::record('user.updated', 'User', $user->name, [
            'roles_from' => $oldRoles,
            'roles_to'   => $data['roles'],
        ]);

        return redirect()->route('users.index')->with('success', 'User diperbarui.');
    }

    public function destroy(Request $request, User $user)
    {
        Gate::authorize('delete user_management');

        abort_if($user->id === $request->user()->id, 422, 'Tidak dapat menghapus akun sendiri.');
        abort_if($user->hasRole('Super Admin') && User::role('Super Admin')->count() <= 1, 422, 'Super Admin terakhir tidak dapat dihapus.');

        $name = $user->name;
        $user->delete();

        RbacAuditLog::record('user.deleted', 'User', $name);

        return redirect()->route('users.index')->with('success', "User \"{$name}\" dihapus.");
    }
}
