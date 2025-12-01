<?php

namespace App\Http\Controllers\report;

use Carbon\Carbon;
use App\Models\Group;
use App\Models\Meter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\ExportReport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class LoadProfileController extends Controller
{
    public function index()
    {
        $groups = Group::get();
        return view('report.loadprofile', compact('groups'));
    }
    public function api(Request $request)
    {
        $meterId = $request->input('meter_id'); # 1
        $range = Str::of(trim($request->input('range')))->explode(' - ');
        $start = Carbon::parse($range[0])->startOfDay();
        $end   = Carbon::parse($range[1])->addDay()->startOfDay();
        if (blank($meterId)) {
            return DataTables::of(collect())->make(true);
        }
        $sorter = strtolower($request->get('sorter', 'asc'));
        $sorter = in_array($sorter, ['asc', 'desc']) ? $sorter : 'asc';

        $query = \App\Models\LoadProfile::query()
            ->where('id_meter', $meterId)
            ->where('created_at', '>', $start)
            ->where('created_at', '<=',  $end)
            ->orderBy('created_at', $sorter);

        return DataTables::of($query)
            ->editColumn('created_at', function ($r) {
                return $r->created_at->format('Y-m-d H:i:s');
            })
            ->make(true);
    }
    public function export(Request $request)
    {
        $meterId = $request->input('meter_id');
        $meter = Meter::where('id',  $meterId)->with('group')->first();
        $meterId = $request->input('meter_id'); # 1
        $range = Str::of(trim($request->input('range')))->explode(' - ');
        $start = Carbon::parse($range[0])->startOfDay();
        $end   = Carbon::parse($range[1])->addDay()->startOfDay();
        if (blank($meterId)) {
            return DataTables::of(collect())->make(true);
        }
        $sorter = strtolower($request->get('sorter', 'asc'));
        $sorter = in_array($sorter, ['asc', 'desc']) ? $sorter : 'asc';

        $data = \App\Models\LoadProfile::query()
            ->where('id_meter', $meterId)
            ->where('created_at', '>', $start)
            ->where('created_at', '<=',  $end)
            ->orderBy('created_at', $sorter)->get();
        $meter->start = $data->min('created_at');
        $meter->end   = $data->max('created_at');
        $title = 'LOADPROFILE';
        $name = Str::upper(Str::slug($meter->name ?? 'meter', '_'));
        $startDate  = $meter->start ? $meter->start->format('YmdHi') : '';
        $endDate    = $meter->end ? $meter->end->format('YmdHi') : '';
        $exportDate = now()->format('YmdHis');
        $filename = "{$exportDate}_{$title}_{$name}_{$startDate}-{$endDate}.xlsx";
        return Excel::download(new ExportReport($meter, $data, "export.report.loadprofile"), $filename);
    }
}
