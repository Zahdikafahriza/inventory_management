<?php

namespace App\Http\Controllers;

use App\Models\RbacAuditLog;
use Illuminate\Support\Facades\Gate;

class RbacAuditController extends Controller
{
    public function index()
    {
        Gate::authorize('view role_management');

        $logs = RbacAuditLog::latest('created_at')->paginate(30);

        return view('roles.audit', compact('logs'));
    }
}
