<?php

namespace App\Http\Controllers\report;

use Carbon\Carbon;
use App\Models\Group;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class InstantaneousController extends Controller
{
    public function index()
    {
        $groups = Group::get();
        return view('report.instantaneous', compact('groups'));
    }
    public function api(Request $request)
    {
        $meterId = $request->input('meter_id'); # 1
        $range = Str::of(trim($request->input('range')))->explode(' - ');
        $start = Carbon::parse($range[0])->startOfDay(); // 00:00:00
        $end   = Carbon::parse($range[1])->endOfDay();   // 23:59:59
        $startAt = $start->toDateTimeString();
        $endAt   = $end->toDateTimeString();
        if (blank($meterId)) {
            return DataTables::of(collect())->make(true);
        }
        $sorter = strtolower($request->get('sorter', 'asc'));
        $sorter = in_array($sorter, ['asc', 'desc']) ? $sorter : 'asc';

        $query = \App\Models\Instantaneous::query()
            ->where('id_meter', $meterId)
            ->whereBetween('created_at', [$startAt, $endAt])
            ->orderBy('created_at', $sorter);

        return DataTables::of($query)
            ->editColumn('created_at', function ($r) {
                return $r->created_at->format('Y-m-d H:i:s');
            })
            ->make(true);
    }
}
