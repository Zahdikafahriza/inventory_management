<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

/**
 * Controller ini sengaja HANYA punya method index().
 * Tidak ada store/update/destroy — log tidak boleh dimanipulasi
 * dari aplikasi web oleh siapa pun, termasuk admin.
 */
class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::query()->with('loggable')
            ->whereNotIn('action', ['login', 'logout', 'login_failed'])
            ->latest('created_at');

        if ($request->filled('source')) {
            $query->where('source', $request->string('source'));
        }

        if ($request->filled('action')) {
            $query->where('action', $request->string('action'));
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date('date_to'));
        }

        $logs = $query->paginate(25)->withQueryString();

        $actionOptions = ActivityLog::query()
            ->select('action')
            ->whereNotIn('action', ['login', 'logout', 'login_failed']) // exclude aktivitas login, sudah ada halaman sendiri
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        if ($request->ajax()) {
            return response()->json([
                'html' => view('activity-logs.partials.results', compact('logs'))->render(),
            ]);
        }

        return view('activity-logs.index', compact('logs', 'actionOptions'));
    }

    /**
     * Aktivitas login web saja: login, logout, percobaan login gagal.
     * source selalu 'web' karena hanya listener LogAuthActivity yang
     * mencatat action ini (lihat app/Listeners/LogAuthActivity.php).
     */
    public function login(Request $request)
    {
        $query = ActivityLog::query()
            ->with('loggable')
            ->where('source', 'web')
            ->whereIn('action', ['login', 'logout', 'login_failed'])
            ->latest('created_at');

        if ($request->filled('action')) {
            $query->where('action', $request->string('action'));
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date('date_to'));
        }

        if ($request->filled('q')) {
            $search = $request->string('q');
            $query->where(function ($sub) use ($search) {
                $sub->where('actor_name', 'like', "%{$search}%")
                    ->orWhere('metadata->email', 'like', "%{$search}%")
                    ->orWhere('metadata->nama', 'like', "%{$search}%");
            });
        }

        $logs = $query->paginate(25)->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('activity-logs.partials.results', compact('logs'))->render(),
            ]);
        }

        return view('activity-logs.login', compact('logs'));
    }
}
