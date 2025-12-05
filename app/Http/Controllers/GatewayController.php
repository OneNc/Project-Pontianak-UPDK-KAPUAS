<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Meter;
use App\Models\Gateway;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class GatewayController extends Controller
{
    public function index()
    {
        $gateways = Gateway::get();
        $meters = Meter::with('group')
            ->orderBy('name')
            ->get()
            ->groupBy(fn($m) => $m->group->name ?? 'Tanpa Group');
        return view("gateway.index", compact('gateways', 'meters'));
    }
    public function store(Request $request)
    {
        $gatewayId = $request->input('id');
        $validated = $request->validate([
            'id'                => ['nullable', 'exists:gateways,id'],
            'meter_id'          => ['required', 'exists:meters,id'],
            'listening_port'    => ['required', 'integer', Rule::unique('gateways', 'listening_port')->ignore($gatewayId),],
            'heartbeat'         => ['nullable', 'string', Rule::unique('gateways', 'heartbeat')->ignore($gatewayId),],
            'enabled'           => ['required', Rule::in(['yes', 'no'])],
            'mode'              => ['required', Rule::in(['intranet', 'internet'])],
        ]);
        $data = $validated;
        unset($data['id']);
        Gateway::updateOrCreate(
            ['id' => $gatewayId],
            $data
        );
        return redirect()->route('gateway')
            ->with('success', 'Gateway saved successfully.');
    }
    public function api(Request $request)
    {
        $query = Gateway::query();
        // ->editcolumn('status', function ($meter) {
        //             if ($meter->active == "yes") {
        //                 $status = $meter->status;
        //                 if ($status == "disconnect") {
        //                     return "<button class='btn-reconnect badge bg-success' data-id='{$meter->id}' data-name='{$meter->name}'><span class='icon-base ri ri-loop-right-line icon-22px text-white'></span></button>";
        //                 }
        //                 $badgeClass = match ($status) {
        //                     'connect' => 'success',
        //                     'disconnect' => 'danger',
        //                     'wrong' => 'warning',
        //                     default => 'secondary',
        //                 };
        //                 return "<span class='badge bg-{$badgeClass} text-capitalize'>{$status}</span>";
        //             } else if ($meter->active == "no") {
        //                 return "<span class='badge bg-gray text-black text-capitalize'>Deactive</span>";
        //             }
        //         })
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('created_at', function ($meter) {
                return Carbon::parse($meter->created_at)->format('d-m-Y H:i:s');
            })
            ->editColumn('last_connected_at', function ($meter) {
                if ($meter->last_connected_at != null) return Carbon::parse($meter->last_connected_at)->format('d-m-Y H:i:s');
                return "";
            })
            ->editColumn('last_dial_at', function ($meter) {

                if ($meter->last_dial_at != null) return Carbon::parse($meter->last_dial_at)->format('d-m-Y H:i:s');
                return "";
            })
            ->editColumn('name', function ($meter) {
                return $meter->meter->name;
            })
            ->editcolumn('status', function ($meter) {
                $status = $meter->status;
                $badgeClass = match ($status) {
                    'connect' => 'success',
                    'disconnect' => 'danger',
                    default => 'secondary',
                };
                return "<span class='badge bg-{$badgeClass} text-capitalize'>{$status}</span>";
            })
            ->editcolumn('mode', function ($gate) {
                $mode = $gate->mode;
                $badgeClass = match ($mode) {
                    'intranet' => 'success',
                    'internet' => 'info',
                    default => 'secondary',
                };
                return "<span class='badge bg-{$badgeClass} text-capitalize'>{$mode}</span>";
            })
            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn btn-sm btn-warning btn-edit" 
                    data-id="' . $row->id . '" 
                    data-meter-id="' . $row->meter_id . '" 
                    data-listening-port="' . $row->listening_port . '"
                    data-heartbeat="' . $row->heartbeat . '"
                    data-enabled="' . $row->enabled . '"
                    data-mode="' . $row->mode . '">
                    Edit
                </button>';
            })
            ->rawColumns(['status', 'mode', 'action'])
            ->make(true);
    }
}
