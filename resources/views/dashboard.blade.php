<x-layouts.app>
    <x-slot:title>
        DASHBOARD
    </x-slot>

    <x-slot:vendorStyle>
        @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/apex-charts/apex-charts.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
    </x-slot>
    <x-slot:vendorScript>
        @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/apex-charts/apexcharts.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
    </x-slot>

    {{-- <x-slot:pageStyle>
        @vite(['resources/assets/vendor/scss/pages/cards-statistics.scss'])
    </x-slot> --}}

    <x-slot:pageScript>
        @vite(['resources/assets/js/datatable-defaults.js'])
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let currentStatusFilter = 'connect';
                const statusMap = {
                    'Connected': 'connect',
                    'Disconnected': 'disconnect',
                    'Invalid': 'wrong',
                    'Deactive': 'deactive'
                };
                var dtMeterStatus = $('#dtMeterStatus').DataTable({
                    scrollY: 220,
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    lengthChange: false,
                    ajax: {
                        url: '{{ route('dashboard.api.meters') }}',
                        data: function(d) {
                            d.status = currentStatusFilter;
                        }
                    },
                    columns: [{
                            data: 'name'
                        },
                        {
                            data: 'brand'
                        },
                        {
                            data: 'serial_number'
                        },
                        {
                            data: 'status'
                        },
                    ],
                });

                $('#dtMeterStatusSearch').on('keyup', function() {
                    dtMeterStatus.search(this.value).draw();
                });

                let meterStatusChart = null; // supaya bisa di-update nanti

                function loadMeterStatusChart() {
                    $.ajax({
                        url: '{{ route('dashboard.api.chart') }}',
                        method: 'GET',
                        dataType: 'json',
                        success: function(res) {
                            const series = [
                                res.connect || 0,
                                res.disconnect || 0,
                                res.invalid || 0,
                                res.deactive || 0,
                            ];

                            const options = {
                                series: series,
                                chart: {
                                    width: 380,
                                    type: 'pie',
                                    events: {
                                        dataPointSelection: function(event, chartContext, config) {
                                            const selectedLabel = config.w.globals.labels[config.dataPointIndex];
                                            const selectedStatus = statusMap[selectedLabel];
                                            if (selectedStatus) {
                                                currentStatusFilter = selectedStatus;
                                                dtMeterStatus.ajax.reload(null, false);
                                            }
                                        }
                                    }
                                },
                                labels: ['Connected', 'Disconnected', 'Invalid', 'Deactive'],
                                colors: ['#68ff63ff', '#FF6384', '#FFCE56', '#dddddd'],
                                responsive: [{
                                    breakpoint: 480,
                                    options: {
                                        chart: {
                                            width: 200
                                        },
                                        legend: {
                                            position: 'bottom'
                                        }
                                    }
                                }],
                                legend: {
                                    show: true,
                                    position: 'bottom',
                                }
                            };

                            if (meterStatusChart) {
                                meterStatusChart.updateSeries(series);
                            } else {
                                meterStatusChart = new ApexCharts(
                                    document.querySelector("#meterStatusChart"),
                                    options
                                );
                                meterStatusChart.render();
                            }
                        },
                        error: function(xhr) {
                            console.error('Gagal ambil data chart:', xhr.responseText);
                        }
                    });
                }
                loadMeterStatusChart();
                $(document).on('click', '.btn-reconnect', function() {
                    const $btn = $(this).prop('disabled', true);
                    const d = $(this).data();
                    Swal.fire({
                        title: '<span class="fs-4">Reconnect Meter</span>',
                        text: `Mencoba koneksi ke ${d.name}`,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => Swal.showLoading()
                    });
                    $.ajax({
                            url: `{{ route('dashboard.api.reconnect') }}`,
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: {
                                id: d.id
                            }
                        })
                        .done(function(response) {
                            loadMeterStatusChart();
                            dtMeterStatus.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Meter berhasil terkoneksi',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        })
                        .fail(function(xhr) {
                            Swal.close();
                            $btn.prop('disabled', false);
                            Swal.fire({
                                icon: 'error',
                                text: xhr.responseJSON?.message || 'Periksa koneksi atau coba lagi.'
                            });
                        });
                });
            });
        </script>

    </x-slot>
    <div class="row">
        <div class="col-md-4 mb-2 p-0 ps-2">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">Meter Status</h5>
                        <p class="text-body-secondary my-0">Status keseluruhan meter</p>
                    </div>
                </div>
                <div class="card-body">
                    <div id="meterStatusChart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-2">
            <div class="card">
                <div class="card-header header-elements pb-0">
                    <h5 class="mb-0 me-2">Meter Status List</h5>
                    <div class="card-header-elements ms-auto">
                        <input type="text" class="form-control form-control-sm" placeholder="Pencarian" id="dtMeterStatusSearch">
                    </div>
                </div>
                <div class="card-datatable">
                    <table class="table table-sm table-bordered table-responsive" id="dtMeterStatus">
                        <thead>
                            <tr class="primary">
                                <th>Meter Name</th>
                                <th>Brand</th>
                                <th>Serial Number</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
