<?php

namespace App\Http\Controllers;

use App\Models\Meter;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        $meters = [
            'connect' => Meter::where('status', 'connect')->count(),
            'disconnect' => Meter::where('status', 'disconnect')->count(),
            'invalid' => Meter::where('status', 'invalid')->count(),
        ];
        return view('dashboard', compact('meters'));
    }
    public function api_meters_status(Request $request)
    {
        $status = $request->query('status');
        if ($status) {
            $meters = \App\Models\Meter::where('status', $status)->get();
            return DataTables::of($meters)
                ->editcolumn('status', function ($meter) {
                    $status = $meter->status;
                    $badgeClass = match ($status) {
                        'connect' => 'success',
                        'disconnect' => 'warning',
                        'invalid' => 'danger',
                        default => 'secondary',
                    };
                    return "<span class='badge bg-{$badgeClass} text-capitalize'>{$status}</span>";
                })
                ->rawColumns(['status'])
                ->make(true);
        }
        return response()->json(['error' => 'Status parameter is required'], 400);
    }
}
