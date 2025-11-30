<?php

namespace App\Http\Controllers;

use App\Models\Meter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function api_chart(Request $request)
    {
        $connect     = Meter::where('status', 'connect')->count();
        $disconnect  = Meter::where('status', 'disconnect')->where('active', 'yes')->count();
        $invalid     = Meter::where('status', 'wrong')->count();
        $deactive    = Meter::where('active', 'no')->count();

        return response()->json([
            'connect'    => $connect,
            'disconnect' => $disconnect,
            'invalid'    => $invalid,
            'deactive'   => $deactive,
        ]);
    }
    public function api_meters(Request $request)
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
                        if ($status == "disconnect") {
                            return "<button class='btn-reconnect badge bg-success' data-id='{$meter->id}' data-name='{$meter->name}'><span class='icon-base ri ri-loop-right-line icon-22px text-white'></span></button>";
                        }
                        $badgeClass = match ($status) {
                            'connect' => 'success',
                            'disconnect' => 'danger',
                            'wrong' => 'warning',
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
    public function api_reconnect(Request $request)
    {
        $validated = $request->validate([
            'id'            => 'nullable|exists:meters,id'
        ]);
        $meter = Meter::find($validated['id']);
        $ping = $this->ping_ip($meter->ip_address, attempts: 1, timeout: 5, badPattern: $reason);
        if (!$ping) {
            return response()->json([
                'message' => "Proses ping gagal : " . $reason
            ], 500);
        }
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
        $stderr    = trim($process->getErrorOutput());
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
            return response()->json([
                'message' => 'Tidak dapat terkoneksi ke meter'
            ], 422);
        }
    }
    private function ping_ip(
        string $ip,
        int $attempts = 1,
        float $timeout = 5.0,
        ?string &$badPattern = null
    ): bool {
        $badPattern = null;

        if (! filter_var($ip, FILTER_VALIDATE_IP)) {
            $badPattern = 'IP tidak valid';

            Log::warning('Ping gagal: IP tidak valid', [
                'ip'         => $ip,
                'badPattern' => $badPattern,
            ]);

            return false;
        }

        $isWindows = str_starts_with(PHP_OS_FAMILY, 'Windows');
        $countFlag = $isWindows ? '-n' : '-c';

        $process = new Process([
            'ping',
            $countFlag,
            (string) $attempts,
            $ip,
        ]);

        $process->setTimeout($timeout);
        $process->run();

        $success     = $process->isSuccessful();
        $output      = $process->getOutput();
        $errorOutput = $process->getErrorOutput();
        $exitCode    = $process->getExitCode();

        // Pola pesan error yang dianggap gagal
        $badPatterns = [
            'TTL expired in transit',
            'Destination host unreachable',
            'Request timed out',
            'Destination net unreachable',
        ];

        foreach ($badPatterns as $pattern) {
            if (stripos($output, $pattern) !== false) {
                $success    = false;
                $badPattern = $pattern; // <- di sini kita “return” pattern-nya
                break;
            }
        }

        Log::info($success ? 'Ping berhasil' : 'Ping gagal', [
            'ip'         => $ip,
            'attempts'   => $attempts,
            'timeout'    => $timeout,
            'success'    => $success,
            'exit_code'  => $exitCode,
            'output'     => $output,
            'error'      => $errorOutput,
            'badPattern' => $badPattern,
        ]);

        return $success;
    }
}
