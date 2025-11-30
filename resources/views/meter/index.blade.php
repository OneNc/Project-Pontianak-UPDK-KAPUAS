<x-layouts.app>
    <x-slot:title>
        Management Meter
    </x-slot>

    <x-slot:vendorStyle>
        @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
    </x-slot>
    <x-slot:vendorScript>
        @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
    </x-slot>
    <x-slot:pageScript>
        @vite(['resources/assets/js/datatable-defaults.js', 'resources/assets/js/ui-popover.js'])
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let dtMeters;
                window.attachInvalidReset("#formMeter");
                $(document).on('shown.bs.modal', '.dtr-bs-modal', function() {
                    $(this).find('.modal-dialog').addClass('modal-dialog-centered');
                });
                dtMeters = $('#dtMeters').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    lengthChange: false,
                    deferLoading: 0,
                    ajax: {
                        url: '{{ route('api.meter') }}',
                        type: 'GET',
                        data: function(d) {
                            d.group_id = $('#fieldGroupId').val() || '';
                        }
                    },
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'serial_number'
                        },
                        {
                            data: 'status'
                        },
                        {
                            data: 'action'
                        }
                    ],
                    columnDefs: [{
                        // For Responsive
                        className: 'control',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 2,
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return '';
                        }
                    }],
                    layout: {
                        topStart: {
                            rowClass: 'row mx-2 justify-content-between',
                            features: [{
                                search: {
                                    placeholder: 'Search...'
                                }
                            }]
                        },
                        topEnd: {
                            features: [{
                                buttons: [{
                                    name: 'add-meter',
                                    text: '<span class="icon-base ri ri-add-fill icon-sm me-1"></span>Add New Meter',
                                    className: 'btn btn-success btn-sm',
                                    action: function() {
                                        clearForm();
                                        $('input[name="id_group"]').val($('#fieldGroupId').val() || '');
                                        $('input[name="active"][value="yes"]').prop('checked', true);
                                        $('#modalForm .modal-title').text('Tambah Meter');
                                        $('#modalForm').modal('show');
                                    }
                                }]
                            }]
                        }
                    },
                    language: {
                        emptyTable: 'Pilih group terlebih dahulu',
                        zeroRecords: 'Pilih group terlebih dahulu'
                    },
                    responsive: {
                        details: {
                            display: DataTable.Responsive.display.modal({
                                modalClass: 'modal modal-dialog-centered',
                                header: function(row) {
                                    const data = row.data();
                                    return 'Details of ' + data['name'];
                                }
                            }),
                            type: 'column',
                            renderer: function(api, rowIdx, columns) {
                                const data = columns
                                    .map(function(col) {
                                        return col.title !== '' ?
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

                function setEmptyMessage(msg) {
                    const st = dtMeters.settings()[0];
                    st.oLanguage.sEmptyTable = msg;
                    st.oLanguage.sZeroRecords = msg;
                }
                $('#fieldGroupId').on('change', function() {
                    toggleAddButton();
                    const val = $(this).val();
                    const text = $('#fieldGroupId option:selected').text();
                    if (!val) {
                        setEmptyMessage('Pilih group terlebih dahulu');
                        dtMeters.clear().draw();
                        return;
                    }
                    setEmptyMessage(`Tidak ada data untuk grup "${text}"`);
                    dtMeters.ajax.reload();
                });

                function toggleAddButton() {
                    const hasGroup = !!($('#fieldGroupId').val());
                    const btn = dtMeters.button('add-meter:name'); // ambil button by name
                    const $node = $(btn.node());
                    if (hasGroup) {
                        $node.removeClass('d-none');
                        btn.enable(true);
                    } else {
                        btn.enable(false);
                        $node.addClass('d-none'); // sembunyikan dari tampilan
                    }
                }
                toggleAddButton();
                const $form = $('#formMeter');
                const $brand = $('#fieldBrand');
                const $type = $('#fieldType');
                if (!$type.data('allOptions')) {
                    $type.data('allOptions', $type.find('option').clone());
                }

                function buildTypeForBrand(brand) {
                    const $all = $type.data('allOptions');
                    const $placeholder = $all.filter(function() {
                        return $(this).val() === '';
                    }).first();
                    const $filtered = brand ?
                        $all.filter(function() {
                            return $(this).data('brand') === brand;
                        }) :
                        $();

                    $type.empty().append($placeholder.clone());

                    if (brand) {
                        $type.append($filtered.clone());
                        $type.prop('disabled', $filtered.length === 0);
                        if ($filtered.length === 1) {
                            $type.val($filtered.first().val());
                        } else {
                            $type.val('');
                        }
                    } else {
                        $type.prop('disabled', true).val('');
                    }
                }
                $brand.on('change', function() {
                    const brand = $(this).val();
                    buildTypeForBrand(brand);
                });
                $(document).on('click', '.btn-edit', function() {
                    const d = $(this).data();
                    $('#modalForm .modal-title').text('Edit Meter');
                    $form.find('input[name="id"]').val(d.id || '');
                    $form.find('input[name="id_group"]').val(d.id_group || '');
                    $('#fieldName').val(d.name || '');
                    $('#fieldVt').val(d.ratio_vt || '1:1');
                    $('#fieldCt').val(d.ratio_ct || '1:1');
                    $('#fieldSerialNumber').val(d.serial_number || '');
                    $('#fieldIpAddress').val(d.ip_address || '');
                    $('#fieldPort').val(d.port || 0);
                    $brand.val(d.brand || '');
                    buildTypeForBrand(d.brand || '');
                    if (d.type) {
                        $type.val(d.type);
                    }
                    $('#fieldNominalV').val(d.nominal_v || '230');
                    $('#fieldNominalI').val(d.nominal_i || '5(10)');
                    $form.find('input[name="classes"]').prop('checked', false);
                    if (d.classes) {
                        $form.find('input[name="classes"][value="' + d.classes + '"]').prop('checked', true);
                    }
                    $form.find('input[name="active"]').prop('checked', false);
                    console.log(d.active);
                    if (d.active) {
                        $form.find('input[name="active"][value="' + d.active + '"]').prop('checked', true);
                    }
                    $('#modalForm').modal('show');
                });

                function clearForm() {
                    $form[0].reset();
                    $form.find('input[name="id"]').val('');
                    $form.find('input[name="id_group"]').val('');
                    $form.find('.is-invalid').removeClass('is-invalid');
                    $brand.val('');
                    buildTypeForBrand('');
                    $form.find('input[name="classes"]').prop('checked', false);
                    $form.find('input[name="active"]').prop('checked', false);
                    $('#fieldVt').val('1:1');
                    $('#fieldCt').val('1:1');
                    $('#fieldNominalV').val('230');
                    $('#fieldNominalI').val('5(10)');
                }

                $('#formMeter').on('submit', function(e) {
                    e.preventDefault();
                    const $form = $(this);
                    clearFieldErrors("#formMeter");
                    let data = $form.serialize();
                    Swal.fire({
                        title: 'Menyimpan...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                    const $btn = $form.find('button[type="submit"]');
                    $btn.prop('disabled', true);
                    $.ajax({
                        url: "{{ route('meter.store') }}",
                        type: 'POST',
                        data: data,
                        success: function() {
                            Swal.close();
                            $('#modalForm').modal('hide');
                            if (dtMeters) dtMeters.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil disimpan.'
                            });

                        },
                        error: function(xhr) {
                            Swal.close();
                            if (xhr.status === 422 && xhr.responseJSON?.errors) {
                                applyFieldErrors(xhr.responseJSON.errors, "#formMeter");
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
                        },
                        complete: function() {
                            $btn.prop('disabled', false);
                        }
                    });
                });
                $('#modalForm').on('hidden.bs.modal', function() {
                    clearForm();
                });

            });
        </script>
    </x-slot>
    <div class="card mb-6">
        <div class="card-header">
            <h5 class="mb-0 me-2">Management Meter</h5>
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
        <div class="card-datatable text-nowrap">
            <table class="datatables-ajax table table-bordered table-responsive" id="dtMeters">
                <thead class="table-dark">
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Name</th>
                        <th>Serial Number</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Meter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formMeter">
                    @csrf
                    <input type="hidden" name="id">
                    <input type="hidden" name="id_group">
                    <div class="modal-body">
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="fieldName" placeholder="" name="name">
                            <label for="fieldName">Name</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <select class="form-select" id="fieldBrand" name="brand">
                                <option value="">-- Select Brand --</option>
                                <option value="EDMI" @selected(old('brand') === 'EDMI')>EDMI</option>
                            </select>
                            <label for="fieldBrand">Brand</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <select class="form-select" id="fieldType" name="type" disabled>
                                <option value="">-- Select Type --</option>
                                <option value="MK6N" data-brand="EDMI">MK6N</option>
                                <option value="MK6E" data-brand="EDMI">MK6E</option>
                            </select>
                            <label for="fieldType">Type</label>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Ratio Transformers</div>
                            <div class="row g-6">
                                <div class="col-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="fieldVt" name="ratio_vt" value="1:1">
                                        <label for="fieldVt">Voltage (VT)</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="fieldCt" name="ratio_ct" value="1:1">
                                        <label for="fieldCt">Current (CT)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">V & I Nominal</div>
                            <div class="row g-6">
                                <div class="col-6">
                                    <div class="form-floating form-floating-outline">
                                        <select class="form-select" id="fieldNominalV" name="nominal_v">
                                            <option value="230" selected>230</option>
                                            <option value="57">57</option>
                                        </select>
                                        <label for="fieldNominalV">Voltage (V)</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating form-floating-outline">
                                        <select class="form-select" id="fieldNominalI" name="nominal_i">
                                            <option value="5(10)" selected>5(10)</option>
                                            <option value="5(80)">5(80)</option>
                                        </select>
                                        <label for="fieldNominalI">Current (I)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Class</div>
                            <div class="row g-3">
                                <div class="col-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="classes" id="class02" value="Class 0.2">
                                        <label class="form-check-label" for="class02">Class 0.2</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="classes" id="class05" value="Class 0.5">
                                        <label class="form-check-label" for="class05">Class 0.5</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="classes" id="class1" value="Class 1">
                                        <label class="form-check-label" for="class1">Class 1</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="classes" id="class2" value="Class 2">
                                        <label class="form-check-label" for="class2">Class 2</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="fieldSerialNumber" name="serial_number" placeholder="">
                            <label for="fieldSerialNumber">Serial Number</label>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="fieldIpAddress" name="ip_address" placeholder="">
                            <label for="fieldIpAddress">Meter IP</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="fieldPort" name="port" placeholder="">
                            <label for="fieldPort">Port</label>
                        </div>
                        <div class="mb-3">
                            <div class="row g-3">
                                <div class="col-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="active" id="active" value="yes">
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="active" id="deactive" value="no">
                                        <label class="form-check-label" for="deactive">Deactive</label>
                                    </div>
                                </div>
                            </div>
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
