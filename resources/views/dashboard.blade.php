<x-layouts.app>
    <x-slot:title>
        DASHBOARD
    </x-slot>

    <x-slot:vendorStyle>
        @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/apex-charts/apex-charts.scss'])
    </x-slot>
    <x-slot:vendorScript>
        @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/apex-charts/apexcharts.js'])
    </x-slot>

    {{-- <x-slot:pageStyle>
        @vite(['resources/assets/vendor/scss/pages/cards-statistics.scss'])
    </x-slot> --}}

    <x-slot:pageScript>
        @vite(['resources/assets/js/datatable-defaults.js'])
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var meterStatusChartOptions = {
                    series: [{{ $meters['connect'] }}, {{ $meters['disconnect'] }}, {{ $meters['invalid'] }}],
                    chart: {
                        width: 380,
                        type: 'pie',
                    },
                    labels: ['Connected', 'Disconnected', "Invalid"],
                    colors: ['#68ff63ff', '#FF6384', '#FFCE56'],
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

                var meterStatusChart = new ApexCharts(document.querySelector("#meterStatusChart"), meterStatusChartOptions);
                meterStatusChart.render();
                var dtMeterStatus = $('#dtMeterStatus').DataTable({
                    scrollY: 220,
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    lengthChange: false,
                    ajax: {
                        url: '{{ route('api.dashboard.meters.status') }}',
                        data: function(d) {
                            d.status = 'connect';
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
