<?php

namespace App\Http\Controllers;

use App\Models\RbacAuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected array $protectedRoles;

    public function __construct()
    {
        $this->protectedRoles = config('rbac.protected_roles', []);
    }

    public function index(Request $request)
    {
        Gate::authorize('view role_management');

        $roles = Role::withCount(['users', 'permissions'])->orderBy('name')->get();

        return view('roles.index', compact('roles'));
    }

    public function create(Request $request)
    {
        Gate::authorize('create role_management');

        return view('roles.form', [
            'role'    => new Role(),
            'matrix'  => $this->buildMatrix(null),
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('create role_management');

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('roles', 'name')],
        ]);

        $role = Role::create(['name' => $data['name'], 'guard_name' => 'web']);

        RbacAuditLog::record('role.created', 'Role', $role->name);

        return redirect()->route('roles.edit', $role)
            ->with('success', "Role \"{$role->name}\" dibuat. Silakan atur hak aksesnya.");
    }

    public function edit(Role $role)
    {
        Gate::authorize('view role_management');

        return view('roles.form', [
            'role'   => $role,
            'matrix' => $this->buildMatrix($role),
        ]);
    }

    public function update(Request $request, Role $role)
    {
        Gate::authorize('update role_management');
        $this->guardProtected($role);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('roles', 'name')->ignore($role->id)],
        ]);

        $old = $role->name;
        $role->update(['name' => $data['name']]);

        RbacAuditLog::record('role.updated', 'Role', $role->name, ['from' => $old, 'to' => $role->name]);

        return redirect()->route('roles.index')->with('success', 'Role diperbarui.');
    }

    public function destroy(Role $role)
    {
        Gate::authorize('delete role_management');
        $this->guardProtected($role);

        abort_if($role->users()->count() > 0, 422, 'Role masih dipakai user, tidak dapat dihapus.');

        $name = $role->name;
        $role->delete();

        RbacAuditLog::record('role.deleted', 'Role', $name);

        return redirect()->route('roles.index')->with('success', "Role \"{$name}\" dihapus.");
    }

    /**
     * AUTOSAVE: toggle satu permission untuk role (dipanggil via fetch, tanpa reload).
     */
    public function togglePermission(Request $request, Role $role)
    {
        Gate::authorize('update role_management');
        $this->guardProtected($role);

        $data = $request->validate([
            'permission' => ['required', 'string'],
            'granted'    => ['required', 'boolean'],
        ]);

        $permission = Permission::findOrCreate($data['permission'], 'web');

        if ($data['granted']) {
            $role->givePermissionTo($permission);
        } else {
            $role->revokePermissionTo($permission);
        }

        RbacAuditLog::record(
            $data['granted'] ? 'permission.granted' : 'permission.revoked',
            'Role',
            $role->name,
            ['permission' => $permission->name],
        );

        return response()->json([
            'ok'         => true,
            'permission' => $permission->name,
            'granted'    => $data['granted'],
            'saved_at'   => now()->format('H:i:s'),
        ]);
    }

    protected function guardProtected(Role $role): void
    {
        abort_if(in_array($role->name, $this->protectedRoles, true), 403, 'Role sistem tidak dapat diubah.');
    }

    /**
     * Bangun struktur matriks fitur x ability untuk view, tandai yang aktif.
     */
    protected function buildMatrix(?Role $role): array
    {
        $granted = $role ? $role->permissions->pluck('name')->all() : [];
        $matrix = [];

        foreach (config('rbac.features') as $key => $feature) {
            $row = ['key' => $key, 'label' => $feature['label'], 'icon' => $feature['icon'], 'abilities' => []];
            foreach ($feature['abilities'] as $ability) {
                $perm = "{$ability} {$key}";
                $row['abilities'][] = [
                    'ability' => $ability,
                    'label'   => config("rbac.ability_labels.$ability", ucfirst($ability)),
                    'permission' => $perm,
                    'granted' => in_array($perm, $granted, true),
                ];
            }
            $matrix[] = $row;
        }

        return $matrix;
    }
}
