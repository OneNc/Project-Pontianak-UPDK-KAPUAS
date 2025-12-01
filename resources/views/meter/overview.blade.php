<x-layouts.app>
    <x-slot:title>
        Overview Meter
    </x-slot>
    <x-slot:vendorStyle>
        @vite(['resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
    </x-slot>
    <x-slot:vendorScript>
        @vite(['resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
    </x-slot>
    <x-slot:pageStyle>
        <style>
            .chip-R {
                background: #dc3545;
                color: #fff;
                border-radius: .5rem;
                padding: .15rem .5rem;
                font-size: .75rem
            }

            .chip-S {
                background: #fd7e14;
                color: #fff;
                border-radius: .5rem;
                padding: .15rem .5rem;
                font-size: .75rem
            }

            .chip-T {
                background: #212529;
                color: #fff;
                border-radius: .5rem;
                padding: .15rem .5rem;
                font-size: .75rem
            }

            .kpi-label {
                color: #6c757d;
                font-size: .9rem;
            }

            .kpi-value {
                font-weight: 600;
            }

            .phasor-box {
                background: #ffffff;
                border: 1px solid #004883;
                border-radius: .75rem;
                height: 150px;
            }

            .table> :not(caption)>*>* {
                vertical-align: middle;
            }
        </style>
    </x-slot>
    <x-slot:pageScript>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const baseStr = '{{ optional($meter->latestInstant?->created_at)->toIso8601String() }}';
                let baseline = isNaN(new Date(baseStr)) ? new Date(0) : new Date(baseStr);

                $('#btnRead').on('click', function() {
                    const $btn = $(this).prop('disabled', true);
                    Swal.fire({
                        title: 'Membaca meter...',
                        text: 'Mohon tunggu, mengambil data terbaru.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => Swal.showLoading()
                    });
                    $.ajax({
                            url: `{{ route('meter.overview.read') }}`,
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: {
                                meter_id: {{ $meter->id }}
                            }
                        })
                        .done(function(response) {
                            if (response.message === 'success') {
                                Swal.close();
                                $('#btnRead').prop('disabled', false);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data diperbarui',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.close();
                                $btn.prop('disabled', false);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal memulai pembacaan',
                                    text: response.message || 'Periksa koneksi atau coba lagi.'
                                });
                            }

                        })
                        .fail(function(xhr) {
                            Swal.close();
                            $btn.prop('disabled', false);
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal memulai pembacaan',
                                text: xhr.responseJSON?.message || 'Periksa koneksi atau coba lagi.'
                            });
                        });
                });
                const canvas = document.getElementById('phasorCanvas');
                let ctx = canvas.getContext('2d');

                function resizeCanvas() {
                    // Set canvas size to match its displayed size
                    canvas.width = canvas.offsetWidth;
                    canvas.height = canvas.offsetHeight;
                }

                const phasorData = {
                    Vr: {
                        mag: 120,
                        ang: {{ $meter->latestInstant->phasor_vr ?? 0 }}
                    },
                    Vs: {
                        mag: 120,
                        ang: {{ $meter->latestInstant->phasor_vs ?? 240 }}
                    },
                    Vt: {
                        mag: 120,
                        ang: {{ $meter->latestInstant->phasor_vt ?? 120 }}
                    },
                    Ir: {
                        mag: 70,
                        ang: 0 + {{ $meter->latestInstant->phasor_ir ?? 0 }}
                    },
                    Is: {
                        mag: 70,
                        ang: 240 + {{ $meter->latestInstant->phasor_is ?? 0 }}
                    },
                    It: {
                        mag: 70,
                        ang: 120 + {{ $meter->latestInstant->phasor_it ?? 0 }}
                    }
                };

                function drawSinglePhasor(magnitude, angleDeg, color, label, centerX, centerY) {
                    const angleRad = angleDeg * Math.PI / 180;
                    const x = centerX + magnitude * Math.cos(angleRad);
                    const y = centerY - magnitude * Math.sin(angleRad);

                    ctx.strokeStyle = color;
                    ctx.lineWidth = 2;
                    ctx.beginPath();
                    ctx.moveTo(centerX, centerY);
                    ctx.lineTo(x, y);
                    ctx.stroke();

                    // const arrowLength = 12;
                    // const arrowAngle = Math.PI / 8;
                    // const dx = x - centerX;
                    // const dy = y - centerY;
                    // const angle = Math.atan2(dy, dx);
                    // for (let sign of [1, -1]) {
                    //     ctx.beginPath();
                    //     ctx.moveTo(x, y);
                    //     ctx.lineTo(
                    //         x - arrowLength * Math.cos(angle - sign * arrowAngle),
                    //         y - arrowLength * Math.sin(angle - sign * arrowAngle)
                    //     );
                    //     ctx.stroke();
                    // }

                    // ctx.fillStyle = color;
                    // ctx.font = "14px Arial";
                    // ctx.fillText(label, x + 5, y - 5);
                }

                function drawPhasor() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    const centerX = canvas.width / 2;
                    const centerY = canvas.height / 2;
                    const scale = Math.min(canvas.width, canvas.height) / 2.5 / 100;

                    ctx.strokeStyle = "#ccc";
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    ctx.moveTo(centerX, 0);
                    ctx.lineTo(centerX, canvas.height);
                    ctx.moveTo(0, centerY);
                    ctx.lineTo(canvas.width, centerY);
                    ctx.stroke();

                    drawSinglePhasor(phasorData.Vr.mag * scale, phasorData.Vr.ang, "#FF4136", "Vr", centerX, centerY);
                    drawSinglePhasor(phasorData.Vs.mag * scale, phasorData.Vs.ang, "#ffdc68", "Vs", centerX, centerY);
                    drawSinglePhasor(phasorData.Vt.mag * scale, phasorData.Vt.ang, "#000000", "Vt", centerX, centerY);
                    drawSinglePhasor(phasorData.Ir.mag * scale, phasorData.Ir.ang, "#FF4136", "Ir", centerX, centerY);
                    drawSinglePhasor(phasorData.Is.mag * scale, phasorData.Is.ang, "#ffdc68", "Is", centerX, centerY);
                    drawSinglePhasor(phasorData.It.mag * scale, phasorData.It.ang, "#000000", "It", centerX, centerY);
                }

                function redraw() {
                    resizeCanvas();
                    ctx = canvas.getContext('2d');
                    drawPhasor();
                }

                window.addEventListener('resize', redraw);
                // Initial draw
                redraw();
            });
        </script>
    </x-slot>
    <div class="row g-3">
        <aside class="col-12 col-lg-3">
            <div class="sticky-top" style="top: 1rem;">
                <button class="btn btn-info w-100 mb-3" id="btnRead">
                    <span class="icon-base ri ri-play-large-fill me-1"></span> Read
                </button>
                <div class="card overflow-hidden mb-3">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th colspan="2">Meter Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-muted py-1">Name</td>
                                    <td class="text-end fw-semibold py-1">{{ $meter->name }} </td>
                                </tr>
                                <tr>
                                    <td class="text-muted py-1">Brand</td>
                                    <td class="text-end fw-semibold py-1">{{ $meter->brand }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted py-1">Meter Type</td>
                                    <td class="text-end fw-semibold py-1">{{ $meter->type }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted py-1">Group</td>
                                    <td class="text-end fw-semibold py-1">{{ $meter->group->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted py-1">VT / CT</td>
                                    <td class="text-end fw-semibold py-1">{{ $meter->ratio_vt }} / {{ $meter->ratio_ct }}</td>
                                </tr>

                                <tr>
                                    <td class="text-muted py-1">V & I Nominal</td>
                                    <td class="text-end fw-semibold py-1">{{ $meter->nominal_v }} / {{ $meter->nominal_i }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted py-1">Class</td>
                                    <td class="text-end fw-semibold py-1">{{ $meter->classes }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted py-1">Serial Number</td>
                                    <td class="text-end fw-semibold py-1">{{ $meter->serial_number }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted py-1">Ip Address</td>
                                    <td class="text-end fw-semibold py-1">{{ $meter->ip_address }}:{{ $meter->port }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted py-1">Last Data</td>
                                    <td class="text-end fw-semibold py-1" id="infoLastData">{{ $meter->latestInstant->created_at ?? 'Belum ada data' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </aside>
        <main class="col-12 col-lg-9">
            <div class="row g-3">
                <div class="col-12 col-lg-8">
                    <div class="card overflow-hidden h-100">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-start bg-white">PHASA</th>
                                        <th class="text-center bg-danger text-white">R</th>
                                        <th class="text-center bg-warning text-white">S</th>
                                        <th class="text-center bg-dark text-white">T</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-start">Voltage</td>
                                        <td id="voltage_r">{{ $meter->latestInstant->voltage_r ?? 0 }} V</td>
                                        <td id="voltage_s">{{ $meter->latestInstant->voltage_s ?? 0 }} V</td>
                                        <td id="voltage_t">{{ $meter->latestInstant->voltage_t ?? 0 }} V</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Current</td>
                                        <td id="current_r">{{ $meter->latestInstant->current_r ?? 0 }} A</td>
                                        <td id="current_s">{{ $meter->latestInstant->current_s ?? 0 }} A</td>
                                        <td id="current_t">{{ $meter->latestInstant->current_t ?? 0 }} A</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card overflow-hidden h-100">
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th colspan="2">Kualitas Daya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-muted">Cosphi</th>
                                        <td class="text-end fw-semibold" id="cosphi">{{ $meter->latestInstant->cosphi ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Frequency</th>
                                        <td class="text-end fw-semibold" id="frequency">{{ $meter->latestInstant->frequency ?? '' }} Hz</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Battery</th>
                                        <td class="text-end fw-semibold" id="battery">{{ $meter->latestInstant->battery ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="card overflow-hidden h-100">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Energy</th>
                                        <th>Rate 1</th>
                                        <th>Rate 2</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Kwh Export</td>
                                        <td id="export_energy_rate1">
                                            {{ number_format(($meter->latestInstant->export_energy_rate1 ?? 0) / 1000, 3, '.', '') }} Kwh
                                        </td>
                                        <td id="export_energy_rate2">
                                            {{ number_format(($meter->latestInstant->export_energy_rate2 ?? 0) / 1000, 3, '.', '') }} Kwh
                                        </td>

                                        <td class="fw-semibold" id="export_energy_total">{{ number_format(($meter->latestInstant->export_energy_total ?? 0) / 1000, 3, '.', '') }} Kwh</td>
                                    </tr>
                                    <tr>
                                        <td>Kwh Import</td>
                                        <td id="import_energy_rate1">{{ number_format(($meter->latestInstant->import_energy_rate1 ?? 0) / 1000, 3, '.', '') }} Kwh</td>
                                        <td id="import_energy_rate2">{{ number_format(($meter->latestInstant->import_energy_rate2 ?? 0) / 1000, 3, '.', '') }} Kwh</td>
                                        <td class="fw-semibold" id="import_energy_total">{{ number_format(($meter->latestInstant->import_energy_total ?? 0) / 1000, 3, '.', '') }} Kwh</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Kvarh Export</tdc>
                                        <td class="fw-semibold" id="kvar_energy_export">{{ number_format(($meter->latestInstant->kvar_energy_export ?? 0) / 1000, 3, '.', '') }} Kvarh</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Kvarh Import</td>
                                        <td class="fw-semibold" id="kvar_energy_import">{{ number_format(($meter->latestInstant->kvar_energy_import ?? 0) / 1000, 3, '.', '') }} Kvarh</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card overflow-hidden h-100">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Diagram Phasor</th>
                                        <th class="text-end">
                                            <span class="chip-R">R</span>
                                            <span class="chip-S">S</span>
                                            <span class="chip-T">T</span>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <canvas id="phasorCanvas" class="phasor-box"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="card overflow-hidden h-100">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Power</th>
                                        {{-- <th>Export</th> --}}
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Active</td>
                                        {{-- <td id="power_active_export">{{ $meter->latestInstant->power_active_export ?? 0 }} kW</td> --}}
                                        <td class="fw-semibold" id="power_active_import">{{ number_format(($meter->latestInstant->power_active_import ?? 0) / 1000, 3, '.', '') }} KW</td>
                                    </tr>
                                    <tr>
                                        <td>Reactive</td>
                                        {{-- <td id="power_reactive_export">{{ $meter->latestInstant->power_reactive_export ?? 0 }} kVar</td> --}}
                                        <td class="fw-semibold" id="power_reactive_import">{{ number_format(($meter->latestInstant->power_reactive_import ?? 0) / 1000, 3, '.', '') }} KVar</td>
                                    </tr>
                                    <tr>
                                        <td>Apparent</td>
                                        {{-- <td id="power_apparent_export">{{ $meter->latestInstant->power_apparent_export ?? 0 }} kVA</td> --}}
                                        <td class="fw-semibold" id="power_apparent_import">{{ number_format(($meter->latestInstant->power_apparent_import ?? 0) / 1000, 3, '.', '') }} KVA</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card overflow-hidden h-100">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Angel</th>
                                        <th>V (V)</th>
                                        <th>I (A)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-medium">R</td>
                                        <td id="phasor_vr">{{ $meter->latestInstant->phasor_vr ?? 0 }}</td>
                                        <td id="phasor_ir">{{ $meter->latestInstant->phasor_ir ?? 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">S</td>
                                        <td id="phasor_vs">{{ $meter->latestInstant->phasor_vs ?? 0 }}</td>
                                        <td id="phasor_is">{{ $meter->latestInstant->phasor_is ?? 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">T</td>
                                        <td id="phasor_vt">{{ $meter->latestInstant->phasor_vt ?? 0 }}</td>
                                        <td id="phasor_it">{{ $meter->latestInstant->phasor_it ?? 0 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-layouts.app>
