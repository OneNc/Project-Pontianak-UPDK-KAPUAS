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

class InstantaneousController extends Controller
{
    public function index()
    {
        $groups = Group::get();
        return view('report.instantaneous', compact('groups'));
    }
    public function api(Request $request)
    {
        $realtime = $request->input('scheduler_only');
        $meterId  = $request->input('meter_id');
        $rangeRaw = trim($request->input('range'));
        if (blank($meterId) || blank($rangeRaw)) {
            return DataTables::of(collect())->make(true);
        }

        $range = Str::of($rangeRaw)->explode(' - ');
        if ($range->count() < 2 || blank($range[0]) || blank($range[1])) {
            return DataTables::of(collect())->make(true);
        }

        $start = Carbon::parse($range[0])->startOfDay();
        $end   = Carbon::parse($range[1])->addDay()->startOfDay();

        $sorter = strtolower($request->get('sorter', 'asc'));
        $sorter = in_array($sorter, ['asc', 'desc']) ? $sorter : 'asc';

        $query = \App\Models\Instantaneous::query()
            ->where('id_meter', $meterId)
            ->when($realtime, function ($q) {
                $q->where('status', 'scheduler');
            })
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
        $realtime = $request->input('scheduler_only');
        $range = Str::of(trim($request->input('range')))->explode(' - ');
        $start = Carbon::parse($range[0])->startOfDay();
        $end   = Carbon::parse($range[1])->addDay()->startOfDay();
        $sorter = strtolower($request->get('sorter', 'asc'));
        $sorter = in_array($sorter, ['asc', 'desc']) ? $sorter : 'asc';
        $data = \App\Models\Instantaneous::query()
            ->where('id_meter', $meterId)
            ->when($realtime, function ($q) {
                $q->where('status', 'scheduler');
            })
            ->where('created_at', '>', $start)
            ->where('created_at', '<=',  $end)
            ->orderBy('created_at', $sorter)->get();
        $meter->start = $data->min('created_at');
        $meter->end   = $data->max('created_at');
        $title = 'INSTANTANEOUS';
        $name = Str::upper(Str::slug($meter->name ?? 'meter', '_'));
        $startDate  = $meter->start ? $meter->start->format('YmdHi') : '';
        $endDate    = $meter->end ? $meter->end->format('YmdHi') : '';
        $exportDate = now()->format('YmdHis');
        $filename = "{$exportDate}_{$title}_{$name}_{$startDate}-{$endDate}.xlsx";
        return Excel::download(new ExportReport($meter, $data, "export.report.instantaneous"), $filename);
    }
}
