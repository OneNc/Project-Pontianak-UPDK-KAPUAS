<?php

namespace App\Http\Controllers\report;

use App\Models\Meter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function api_meter(Request $request)
    {
        $groupId = $request->input('group_id');
        if (blank($groupId)) {
            return DataTables::of(collect())->make(true);
        }
        $query = Meter::query()->select(["id", "name"])->where('id_group', $groupId);
        return DataTables::of($query)
            ->addColumn('action', function ($r) {
                $html = '<button type="button" class="btn btn-sm btn-icon bg-label-secondary btn-select-meter" data-id="' . $r->id . '">
                                <i class="icon-base ri ri-arrow-right-s-line icon-20px scaleX-n1-rtl"></i>
                              </button>';
                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
