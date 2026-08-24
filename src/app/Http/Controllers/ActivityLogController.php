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
        $query = ActivityLog::query()->with('loggable')->latest('created_at');

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
}
