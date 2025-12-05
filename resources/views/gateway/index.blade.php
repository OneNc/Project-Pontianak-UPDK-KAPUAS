<x-layouts.app>
    <x-slot:title>
        Gateways
    </x-slot>

    <x-slot:vendorStyle>
        @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss'])
    </x-slot>
    <x-slot:vendorScript>
        @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js'])
    </x-slot>
    <x-slot:pageScript>
        @vite(['resources/assets/js/datatable-defaults.js'])
        @vite(['resources/assets/js/forms-selects.js'])
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let dtGateways;
                dtGateways = $('#dtGateways').DataTable({
                    processing: true,
                    serverSide: true,
                    search: false,
                    lengthChange: false,
                    ordering: false,
                    ajax: '{{ route('gateway.api') }}',
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'DT_RowIndex'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'mode'
                        },
                        {
                            data: 'status'
                        },
                        {
                            data: 'listening_port'
                        },
                        {
                            data: 'last_error'
                        },
                        {
                            data: 'last_connected_at'
                        },
                        {
                            data: 'last_dial_at'
                        },
                        {
                            data: 'action'
                        }
                    ],
                    columnDefs: [{
                            className: 'control',
                            orderable: false,
                            searchable: false,
                            responsivePriority: 2,
                            targets: 0,
                            render: function(data, type, full, meta) {
                                return '';
                            }
                        },
                        {
                            targets: 3,
                            className: 'text-capitalize'
                        }
                    ],
                    responsive: {
                        details: {
                            display: DataTable.Responsive.display.modal({
                                header: function(row) {
                                    const data = row.data();
                                    return 'Details of ' + data['name'];
                                }
                            }),
                            type: 'column',
                            renderer: function(api, rowIdx, columns) {
                                const data = columns
                                    .map(function(col) {
                                        return col.title !== '' // Do not show row in modal popup if title is blank (for check box)
                                            ?
                                            `<tr data-dt-row="${col.rowIndex}" data-dt-column="${col.columnIndex}">
                                            <td>${col.title}:</td>
                                            <td>${col.data}</td>
                                            </tr>` :
                                            '';
                                    })
                                    .join('');

                                if (data) {
                                    const div = document.createElement('div');
                                    div.classList.add('table-responsive');
                                    const table = document.createElement('table');
                                    div.appendChild(table);
                                    table.classList.add('table');
                                    table.classList.add('datatables-basic');
                                    const tbody = document.createElement('tbody');
                                    tbody.innerHTML = data;
                                    table.appendChild(tbody);
                                    return div;
                                }
                                return false;
                            }
                        }
                    },
                });

                function clearForm() {
                    var $form = $('#formGateways');
                    $form[0].reset();
                    $form.find('input[name="id"]').val('');
                    $('#mode').val('intranet');
                    $('#enabled').val('no');
                    const $meterSelect = $form.find('[name="meter_id"]');
                    if ($.fn.selectpicker) {
                        $meterSelect.selectpicker('val', '');
                    }
                    $form.find('.is-invalid').removeClass('is-invalid');
                }

                $('#btnAdd').on('click', function() {
                    clearForm();
                    $('#modalForm .modal-title').text('Tambah Gateways');
                    $('#modalForm').modal('show');
                });
                $(document).on('click', '.btn-edit', function() {
                    const $btn = $(this);
                    const $form = $('#formGateways');
                    const id = $btn.data('id');
                    const meterId = String($btn.data('meter-id'));
                    const heartbeat = $btn.data('heartbeat') || '';
                    const listeningPort = $btn.data('listening-port') || '';
                    const mode = $btn.data('mode') || 'intranet';
                    const enabled = $btn.data('enabled') || 'no';
                    $form[0].reset();
                    $form.find('[name="id"]').val(id);
                    $form.find('[name="heartbeat"]').val(heartbeat);
                    $form.find('[name="listening_port"]').val(listeningPort);
                    $form.find('[name="mode"]').val(mode);
                    $form.find('[name="enabled"]').val(enabled);
                    const $meterSelect = $form.find('[name="meter_id"]');
                    if ($.fn.selectpicker) {
                        $meterSelect.selectpicker('val', meterId);
                    } else {
                        $meterSelect.val(meterId);
                    }
                    $('#modalForm .modal-title').text('Edit Gateway');
                    $('#modalForm').modal('show');
                });
                $('#modalForm').on('hidden.bs.modal', function() {
                    clearForm();
                });
                $('#formGateways').on('submit', function(e) {
                    e.preventDefault();
                    const $form = $(this);
                    let data = $form.serialize();
                    Swal.fire({
                        title: 'Menyimpan...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });

                    $.ajax({
                        url: "{{ route('gateway.store') }}",
                        type: 'POST',
                        data: data,
                        success: function() {
                            Swal.close();
                            $('#modalForm').modal('hide');
                            if (dtGateways) dtGateways.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil disimpan.'
                            });
                        },
                        error: function(xhr) {
                            Swal.close();
                            if (xhr.status === 422 && xhr.responseJSON?.errors) {
                                applyFieldErrors(xhr.responseJSON.errors, "#formGateways");
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validasi gagal',
                                    text: xhr.responseJSON.message || 'Periksa form Anda.'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal menyimpan',
                                    text: xhr.responseJSON?.message || 'Terjadi kesalahan pada server.'
                                });
                            }
                        }
                    });
                });
            });
        </script>
    </x-slot>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-6">
            <div class="card-header header-elements">
                <h5 class="mb-0 me-2">Gateway Status</h5>
                <div class="card-header-elements ms-auto">
                    <button type="button" class="btn btn-xs btn-success" id="btnAdd">
                        <span class="icon-base ri ri-add-fill icon-sm me-1"></span>Add Gateway
                    </button>
                </div>

            </div>
            <div class="card-datatable text-nowrap">
                <table class="datatables-ajax table table-bordered table-responsive" id="dtGateways">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Name</th>
                            <th>Mode</th>
                            <th>Status</th>
                            <th>Port</th>
                            <th>Last Error</th>
                            <th>Last Connect</th>
                            <th>Last Dial</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalForm" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="formGateways">
                    <div class="modal-header">
                        <h5 class="modal-title">Form Gateway</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        {{-- Meter --}}
                        <div class="mb-3">
                            <div class="form-floating form-floating-outline">
                                <select id="meter_id"
                                    name="meter_id"
                                    class="selectpicker w-100 @error('meter_id') is-invalid @enderror"
                                    data-style="btn-default"
                                    data-live-search="true">
                                    <option value="">Select Meter</option>
                                    @foreach ($meters as $groupName => $groupMeters)
                                        <optgroup label="{{ $groupName }}">
                                            @foreach ($groupMeters as $meter)
                                                <option value="{{ $meter->id }}">{{ $meter->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <label for="meter_id">Meter</label>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        {{-- Heartbeat --}}
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="heartbeat" name="heartbeat"
                                placeholder="Mis: GW-001-ABC">
                            <div class="invalid-feedback"></div>
                            <label for="heartbeat">Heartbeat</label>
                        </div>

                        {{-- Listening Port --}}
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="number" class="form-control" id="listening_port" name="listening_port"
                                placeholder="Contoh: 5000">
                            <div class="invalid-feedback"></div>
                            <label for="listening_port">Listening Port</label>
                        </div>

                        {{-- Mode --}}
                        <div class="form-floating form-floating-outline mb-3">
                            <select class="form-select" id="mode" name="mode">
                                <option value="intranet">Intranet</option>
                                <option value="internet">Internet</option>
                            </select>
                            <div class="invalid-feedback"></div>
                            <label for="mode">Mode</label>
                        </div>

                        {{-- Enabled --}}
                        <div class="form-floating form-floating-outline mb-3">
                            <select class="form-select" id="enabled" name="enabled">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                            <div class="invalid-feedback"></div>
                            <label for="enabled">Enabled</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
