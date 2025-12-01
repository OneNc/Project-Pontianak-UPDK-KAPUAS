<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Meter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\Process\Exception\ProcessFailedException;

class MeterController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        return view('meter.index', compact('groups'));
    }
    public function api(Request $request)
    {
        $groupId = $request->input('group_id');
        if (blank($groupId)) {
            return DataTables::of(collect())->make(true);
        }
        $query = Meter::query()
            ->where('id_group', $groupId);

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('d-m-Y H:i');
            })
            ->editColumn('status', function ($r) {
                if ($r->active == "yes") {
                    $label = $r->status ?: 'Unknown';
                    $cls   = match (strtolower($r->status)) {
                        'connect'  => 'bg-success',
                        'disconnect' => 'bg-danger',
                        'invalid' => 'bg-warning',
                        default => 'bg-label-dark'
                    };
                    return '<span class="badge ' . $cls . ' text-capitalize">' . e($label) . '</span>';
                } else {
                    return '<span class="badge bg-gray text-black">Deactive</span>';
                }
            })
            ->addColumn('action', function ($r) {
                $overviewUrl = route('meter.overview', $r->id);
                $attrs = [
                    'id'            => $r->id,
                    'id_group'      => $r->id_group,
                    'name'          => $r->name,
                    'brand'         => $r->brand,
                    'type'          => $r->type,
                    'capacity'      => $r->capacity,
                    'ratio_vt'      => $r->ratio_vt,
                    'ratio_ct'      => $r->ratio_ct,
                    'nominal_v'     => $r->nominal_v,
                    'nominal_i'     => $r->nominal_i,
                    'classes'       => $r->classes,
                    'serial_number' => $r->serial_number,
                    'ip_address'    => $r->ip_address,
                    'port'          => $r->port,
                    'active'        => $r->active,
                ];
                $dataAttr = collect($attrs)->map(fn($v, $k) => 'data-' . $k . '="' . e((string)($v ?? '')) . '"')->implode(' ');

                $html  = '<div class="text-nowrap">';

                // Edit
                $html .= '<button type="button" class="btn btn-warning btn-sm btn-edit me-1" ' . $dataAttr . ' aria-label="Edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">'
                    .  '<span class="icon-base ri ri-pencil-line icon-sm"></span>'
                    .  '</button>';
                if ($r->active == "yes") {
                    // Overview
                    $html .= '<a href="' . e($overviewUrl) . '" class="btn btn-info btn-sm me-1" aria-label="Overview">'
                        .  '<span class="icon-base ri ri-bar-chart-box-line icon-sm"></span>'
                        .  '</a>';
                }
                $html .= '</div>';

                return $html;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id'            => 'nullable|exists:meters,id',
            'id_group'      => 'required|exists:groups,id',
            'name'          => 'required|string|max:255',
            'brand'         => 'required|string|max:100',
            'type'          => 'required|string|max:100',
            'ratio_vt'      => 'required|string|max:20',
            'ratio_ct'      => 'required|string|max:20',
            'nominal_v'     => 'required|numeric',
            'nominal_i'     => 'required|string|max:20',
            'classes'         => 'required|string|max:20',
            'serial_number' => 'required|string|max:100',
            'ip_address'      => 'required|ip',
            'port'          => 'required|integer|min:1|max:65535',
        ]);
        $validated['status'] = "disconnect";
        $meter = Meter::updateOrCreate(
            ['id' => $validated['id'] ?? null],
            $validated
        );
        if ($meter->type == "MK6N" || $meter->type == "MK6E") {
            $exePath = config('services.teras_background.exe_path_edmicmd');
        } else {
            $exePath = config('services.teras_background.exe_path');
        }
        if (!$exePath || !file_exists($exePath)) {
            throw new \RuntimeException("Background executable tidak ditemukan/terkonfigurasi: {$exePath}");
        }

        $process = new Process([$exePath, 'sn', (string) $meter->id]);
        $process->setTimeout(60);
        $process->run();
        $rawOutput = trim($process->getOutput());
        $data = json_decode($rawOutput, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
            return response()->json([
                'succes'  => false,
                'message' => 'Output dari Background.exe tidak valid.'
            ], 500);
        }
        $success    = (bool)($data['succes'] ?? false);
        $statusCode = $success ? 200 : 500;

        if ($success) {
            $meter['status'] = "connect";
            $meter->update();
            return response()->json([
                'message' => $meter->wasRecentlyCreated ? 'created' : 'updated'
            ], $meter->wasRecentlyCreated ? 201 : 200);
        } else {
            $meter['status'] = "wrong";
            $meter->update();
            return response()->json([
                'message' => 'Serial number tidak cocok dengan perangkat atau koneksi bermasalah. ping terlebih dahulu',
                'errors'  => ['serial_number' => ['Pastikan serial number sama dengan perangkat']],
            ], 422);
        }
    }
    public function overview($number)
    {
        $meter = Meter::where('id', $number)->with(['group', 'latestInstant'])->first();
        return view('meter.overview', compact('meter'));
    }
    public function read(request $request)
    {
        $meterId = $request->input('meter_id');
        $meter = \App\Models\Meter::where("id", $meterId)->first();
        if ($meter->type == "MK6N" || $meter->type == "MK6E") {
            $exePath = config('services.teras_background.exe_path_edmicmd');
        } else {
            $exePath = config('services.teras_background.exe_path');
        }
        $args = [$exePath, 'read', (string)$meterId, (string)Auth::id()];
        $process = new Process($args);
        $process->run();
        $rawOutput = trim($process->getOutput());
        $data = json_decode($rawOutput, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
            return response()->json([
                'succes'  => false,
                'message' => 'Output dari Background.exe tidak valid.'
            ], 500);
        }
        $success    = (bool)($data['succes'] ?? false);
        $statusCode = $success ? 200 : 500;
        // Log::info("Read meter {$id} selesai", ['output' => $output]);
        return response()->json(['message' => $data['message']], $statusCode);
    }
}
