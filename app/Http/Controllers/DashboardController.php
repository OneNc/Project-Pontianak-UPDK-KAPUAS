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
            'disconnect' => Meter::where('status', 'disconnect')->where('active', 'yes')->count(),
            'invalid' => Meter::where('status', 'invalid')->count(),
            'deactive' => Meter::where('active', 'no')->count()
        ];
        return view('dashboard', compact('meters'));
    }
    public function api_meters_status(Request $request)
    {
        $status = $request->query('status');
        if ($status) {
            if ($status != "deactive") {
                $meters = \App\Models\Meter::where('status', $status)->where('active', 'yes')->get();
            } else {
                $meters = \App\Models\Meter::where('active', 'no')->get();
            }
            return DataTables::of($meters)
                ->editcolumn('status', function ($meter) {
                    if ($meter->active == "yes") {
                        $status = $meter->status;
                        $badgeClass = match ($status) {
                            'connect' => 'success',
                            'disconnect' => 'danger',
                            'invalid' => 'info',
                            default => 'secondary',
                        };
                        return "<span class='badge bg-{$badgeClass} text-capitalize'>{$status}</span>";
                    } else if ($meter->active == "no") {
                        return "<span class='badge bg-gray text-black text-capitalize'>Deactive</span>";
                    }
                })
                ->rawColumns(['status'])
                ->make(true);
        }
        return response()->json(['error' => 'Status parameter is required'], 400);
    }
}
