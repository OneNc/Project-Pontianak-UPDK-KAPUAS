    <x-layouts.app>
        <x-slot:title>
            Report Instantaneous
        </x-slot>

        <x-slot:vendorStyle>
            @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss', 'resources/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.scss'])
        </x-slot>
        <x-slot:vendorScript>
            @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js', 'resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js'])
        </x-slot>
        <x-slot:pageScript>
            @vite(['resources/assets/js/datatable-defaults.js', 'resources/assets/js/ui-popover.js'])
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const $range = $('#fieldFilterRange');
                    let dtReport;
                    let dtMetersList;
                    const picker = $range.data('daterangepicker');
                    const $meterId = $('#fieldMeterId');

                    function setEmptyMessage(msg, datatable) {
                        const st = datatable.settings()[0];
                        st.oLanguage.sEmptyTable = msg;
                        st.oLanguage.sZeroRecords = msg;
                    }

                    $('#fieldGroupId').on('change', function() {
                        const val = $(this).val();
                        const text = $('#fieldGroupId option:selected').text();
                        $('#fieldMeterId').val(0);
                        if (!val) {
                            setEmptyMessage('Pilih group terlebih dahulu', dtMetersList);
                            dtMetersList.clear().draw();
                            return;
                        }
                        setEmptyMessage(`Tidak ada data untuk grup "${text}"`, dtMetersList);
                        dtMetersList.ajax.reload();
                        dtReport.clear().draw();
                    });
                    $('input[name="btnAscDesc"]').on('change', function() {
                        $('.label-asc-desc')
                            .removeClass('btn-primary')
                            .addClass('btn-outline-primary');
                        const $label = $('label[for="' + this.id + '"]');

                        $label
                            .removeClass('btn-outline-primary')
                            .addClass('btn-primary');
                        dtReport.ajax.reload();
                    });

                    $range.daterangepicker({
                        autoUpdateInput: true,
                        startDate: moment(),
                        endDate: moment(),
                        maxDate: moment().endOf('day'),
                        ranges: {
                            'Today': [
                                moment().startOf('day'),
                                moment().endOf('day')
                            ],
                            'Yesterday': [
                                moment().subtract(1, 'days').startOf('day'),
                                moment().subtract(1, 'days').endOf('day')
                            ],
                            'Today and Yesterday': [
                                moment().subtract(1, 'days').startOf('day'),
                                moment().endOf('day')
                            ],
                            'This Month': [
                                moment().startOf('month'),
                                moment().endOf('month')
                            ],
                            'Last Month': [
                                moment().subtract(1, 'month').startOf('month'),
                                moment().subtract(1, 'month').endOf('month')
                            ],
                            'This Month and Last Month': [
                                moment().subtract(1, 'month').startOf('month'),
                                moment().endOf('month')
                            ]
                        },
                        opens: (typeof isRtl !== 'undefined' && isRtl) ? 'left' : 'right'
                    });
                    $range.on('apply.daterangepicker', function(ev, picker) {
                        // Optional: kalau mau kontrol sendiri format isi input
                        $(this).val(
                            picker.startDate.format('YYYY-MM-DD') +
                            ' - ' +
                            picker.endDate.format('YYYY-MM-DD')
                        );

                        dtReport.ajax.reload(); // ⬅️ kirim request baru dengan range terbaru
                    });
                    dtMetersList = $("#dtMetersList").DataTable({
                        processing: true,
                        serverSide: true,
                        info: false,
                        lengthChange: false,
                        pageLength: 10,
                        deferRender: true,
                        deferLoading: 0,
                        ajax: {
                            url: '{{ route('report.meter.api') }}',
                            type: 'GET',
                            data: function(d) {
                                d.group_id = $('#fieldGroupId').val() || '';
                            }
                        },
                        columns: [{
                            data: 'name'
                        }, {
                            data: 'action'
                        }],
                        language: {
                            emptyTable: 'Pilih group terlebih dahulu.'
                        },
                        dom: "<'row'<'col-12 mt-3'tr>>" +
                            "<'row'<'col-12 d-flex justify-content-center'p>>",
                    });
                    $(document).on('click', '.btn-select-meter', function() {
                        const id = $(this).data('id');
                        $('#fieldMeterId').val(id).trigger('change');
                        $('.btn-select-meter').removeClass('bg-primary');
                        $(this).addClass('bg-primary');
                    });
                    $meterId.on('change', function() {
                        if (!this.value) {
                            setEmptyMessage('Pilih meter & rentang tanggal terlebih dahulu.', dtReport);
                            dtReport.clear().draw();
                            return;
                        }
                        setEmptyMessage(`Tidak ada data untuk meter ini pada rentang tanggal terpilih.`, dtReport);
                        dtReport.ajax.reload(null, true);
                    });
                    $('#cbSchedulerOnly').on("change", function() {
                        dtReport.ajax.reload(null, true);
                    })
                    dtReport = $('#dtReportData').DataTable({
                        processing: true,
                        serverSide: true,
                        ordering: false,
                        searching: false,
                        lengthChange: false,
                        pageLength: 24,
                        deferLoading: 0,
                        ajax: {
                            url: `{{ route('report.instantaneous.api') }}`, // <- sesuaikan route API-mu
                            type: 'GET',
                            data: function(d) {
                                d.meter_id = $meterId.val() || null;
                                d.range = $range.val();
                                d.sorter = $('input[name="btnAscDesc"]:checked').val() || 'asc';
                                d.scheduler_only = $('#cbSchedulerOnly').is(':checked') ? 1 : 0;
                            }
                        },
                        columns: [{
                                data: 'created_at',
                                name: 'created_at'
                            },
                            {
                                data: 'voltage_r',
                                name: 'voltage_r'
                            },
                            {
                                data: 'voltage_s',
                                name: 'voltage_s'
                            },
                            {
                                data: 'voltage_t',
                                name: 'voltage_t'
                            },
                            {
                                data: 'current_r',
                                name: 'current_r'
                            },
                            {
                                data: 'current_s',
                                name: 'current_s'
                            },
                            {
                                data: 'current_t',
                                name: 'current_t'
                            },
                            {
                                data: 'cosphi',
                                name: 'cosphi'
                            },
                            {
                                data: 'frequency',
                                name: 'frequency'
                            },
                            {
                                data: 'power_active_import',
                                name: 'power_active_import'
                            },
                            {
                                data: 'power_reactive_import',
                                name: 'power_reactive_import'
                            },
                            {
                                data: 'power_apparent_import',
                                name: 'power_apparent_import'
                            },
                            {
                                data: 'export_energy_rate1',
                                name: 'export_energy_rate1'
                            },
                            {
                                data: 'export_energy_rate2',
                                name: 'export_energy_rate2'
                            },
                            {
                                data: 'export_energy_total',
                                name: 'export_energy_total'
                            },
                            {
                                data: 'import_energy_rate1',
                                name: 'import_energy_rate1'
                            },
                            {
                                data: 'import_energy_rate2',
                                name: 'import_energy_rate2'
                            },
                            {
                                data: 'import_energy_total',
                                name: 'import_energy_total'
                            },
                            {
                                data: 'kvar_energy_export',
                                name: 'kvar_energy_export'
                            },
                            {
                                data: 'kvar_energy_import',
                                name: 'kvar_energy_import'
                            },
                            {
                                data: 'phasor_vr',
                                name: 'phasor_vr'
                            },
                            {
                                data: 'phasor_ir',
                                name: 'phasor_ir'
                            },
                            {
                                data: 'phasor_vs',
                                name: 'phasor_vs'
                            },
                            {
                                data: 'phasor_is',
                                name: 'phasor_is'
                            },
                            {
                                data: 'phasor_vt',
                                name: 'phasor_vt'
                            },
                            {
                                data: 'phasor_it',
                                name: 'phasor_it'
                            },
                        ],
                        language: {
                            emptyTable: 'Pilih meter & rentang tanggal terlebih dahulu.'
                        },
                        drawCallback: function() {
                            $('#dtReportData td.dataTables_empty, #dtReportData td.dt-empty').addClass('text-start');
                        }
                    });
                    $('#btnExport').on('click', function() {
                        const meterId = $('#fieldMeterId').val();
                        const range = $('#fieldFilterRange').val();
                        const search = $('#fieldSearch').val() || '';
                        const dataCount = dtReport.data().count();

                        if (dataCount === 0) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Tidak ada data',
                                text: 'Tidak ada data untuk diekspor pada filter yang dipilih.'
                            });
                            return;
                        }

                        if (!meterId || !range) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Lengkapi filter',
                                text: 'Pilih meter & rentang tanggal dulu.'
                            });
                            return;
                        }

                        $('#export_meter_id').val(meterId);
                        $('#export_range').val(range);
                        $('#export_sorter').val($('input[name="btnAscDesc"]:checked').val() || 'asc');
                        $('#export_scheduler_only').val($('#cbSchedulerOnly').is(':checked') ? 1 : 0);
                        Swal.fire({
                            title: 'Export XLSX',
                            text: 'File akan disiapkan berdasarkan filter yang dipilih.',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Export',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#exportForm')[0].submit();
                            }
                        });
                    });
                });
            </script>
        </x-slot>

        <div class="card mb-6">
            <div class="card-header">
                <h5 class="mb-0 me-2">Report Instantaneous</h5>
            </div>
            <div class="card-body">
                <form class="dt_adv_search" method="GET">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating form-floating-outline">
                                <select id="fieldGroupId" name="group_id" class="form-select" data-allow-clear="true">
                                    <option value="">-- Select Group --</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                                <label for="fieldGroupId">Select Group</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <form id="exportForm"
            action="{{ route('report.instantaneous.export') }}"
            method="POST"
            target="_blank">
            @csrf
            <input type="hidden" name="meter_id" id="export_meter_id">
            <input type="hidden" name="range" id="export_range">
            <input type="hidden" name="sorter" id="export_sorter">
            <input type="hidden" name="scheduler_only" id="export_scheduler_only">
        </form>

        <div class="row g-4">
            <aside class="col-12 col-lg-4">
                <div class="sticky-top" style="top: 1rem;">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="mb-0">Meter List</h5>
                        </div>
                        <div class="card-body pb-0">
                            <input type="text" id="fieldSearch" class="form-control form-control-sm w-100" placeholder="Search..." />
                        </div>
                        <div class="card-datatable text-nowrap">
                            <table class="datatables-ajax table table-sm table-bordered table-responsive" id="dtMetersList">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </aside>
            <main class="col-12 col-lg-8">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header header-elements">
                                <h5 class="mb-0 me-2">Data Report</h5>
                                <div class="card-header-elements ms-auto">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="fieldFilterRange" class="form-control form-control-sm" />
                                        <label for="fieldFilterRange">Filter</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <div class="row mb-3">
                                    <div class="col-md-6 text-md-start text-center">
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="btnAscDesc" id="btnAsc" value="asc" checked>
                                            <label class="btn btn-primary label-asc-desc" for="btnAsc">Oldest first</label>
                                            <input type="radio" class="btn-check" name="btnAscDesc" id="btnDesc" value="desc">
                                            <label class="btn btn-outline-primary label-asc-desc" for="btnDesc">Newest first</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="cbSchedulerOnly" name="cbSchedulerOnly">
                                            <label class="form-check-label" for="cbSchedulerOnly">Scheduler Only</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-md-end text-center">
                                        <button type="button" class="btn btn-sm btn-info" id="btnExport">
                                            <span class="icon-base ri ri-file-excel-2-line me-1"></span> Export XLSX
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-datatable table-responsive">
                                <input type="hidden" id="fieldMeterId" name="meter_id" value="" />
                                <table class="datatables-ajax table table-sm table-bordered table-responsive text-nowrap" id="dtReportData">
                                    <thead class="table-dark text-nowrap">
                                        <tr>
                                            <th>Datetime</th>
                                            <th>Voltage R</th>
                                            <th>Voltage S</th>
                                            <th>Voltage T</th>
                                            <th>Ampere R</th>
                                            <th>Ampere S</th>
                                            <th>Ampere T</th>
                                            <th>Cosphi</th>
                                            <th>Frequency</th>
                                            <th>Power Active</th>
                                            <th>Power Reactive</th>
                                            <th>Power Apparent</th>
                                            <th>Export Energy Rate1</th>
                                            <th>Export Energy Rate2</th>
                                            <th>Export Energy Total</th>
                                            <th>Import Energy Rate1</th>
                                            <th>Import Energy Rate2</th>
                                            <th>Import Energy Total</th>
                                            <th>Kvar Energy Export</th>
                                            <th>Kvar Energy Import</th>
                                            <th>Phasor Vr</th>
                                            <th>Phasor Ir</th>
                                            <th>Phasor Vs</th>
                                            <th>Phasor Is</th>
                                            <th>Phasor Vt</th>
                                            <th>Phasor It</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </x-layouts.app>
    +
