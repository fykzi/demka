<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ];

    public function isAdmin()
    {
        if (!(Auth::user()->login == 'copp' && Hash::check('password', Auth::user()->password))) {
            abort(403, 'Доступ запрещен');
        }

        return true;
    }

    public function adminPanel()
    {
        $this->isAdmin();

        $reports = DB::table('reports')
            ->join('users', 'users.id', '=', 'reports.user_id')
            ->select('reports.*', 'users.name AS full_name')
            ->orderBy('status', 'asc', 'updated_at', 'desc')
            ->get()
            ->map(function ($report) {
                return (array)$report;
            });

        return view('admin.panel', ['reports' => $reports]);
    }

    public function approve(Request $request)
    {
        Report::where('id', $request['id'])->update(['status' => 'подтверждено']);
        return back()->with('success', 'Заявка отклонена!');
    }

    public function reject(Request $request)
    {
        Report::where('id', $request['id'])->update(['status' => 'отклонено']);
        return back()->with('success', 'Заявка отклонена!');
    }
}
