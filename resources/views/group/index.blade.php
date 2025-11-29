<x-layouts.app>
    <x-slot:title>
        Management Group
    </x-slot>

    <x-slot:vendorStyle>
        @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
    </x-slot>
    <x-slot:vendorScript>
        @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
    </x-slot>
    <x-slot:pageScript>
        @vite(['resources/assets/js/datatable-defaults.js'])
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let dtGroups;
                dtGroups = $('#dtGroups').DataTable({
                    processing: true,
                    serverSide: true,
                    search: false,
                    lengthChange: false,
                    ordering: false,
                    ajax: '{{ route('group.api') }}',
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

                $(document).on('click', '.btn-edit', function() {
                    let id = $(this).data('id');
                    let name = $(this).data('name');
                    let latitude = $(this).data('latitude');
                    let longitude = $(this).data('longitude');
                    $('#modalForm .modal-title').text('Edit Group');
                    $('#formGroup input[name="id"]').val(id);
                    $('#formGroup input[name="name"]').val(name);
                    $('#formGroup input[name="latitude"]').val(latitude);
                    $('#formGroup input[name="longitude"]').val(longitude);
                    $('.dtr-bs-modal').remove();
                    $('.modal-backdrop').remove();
                    $('#modalForm').modal('show');
                });

                function clearForm() {
                    $('#formGroup')[0].reset();
                    $('#formGroup input[name="id"]').val('');
                    $('#formGroup input[name="name"]').val('');
                    $('#formGroup input[name="latitude"]').val('');
                    $('#formGroup input[name="longitude"]').val('');

                }
                $('#btnAdd').on('click', function() {
                    clearForm();
                    $('#modalForm .modal-title').text('Tambah Group');
                    $('#modalForm').modal('show');
                });
                $('#formGroup').on('submit', function(e) {
                    e.preventDefault();
                    const $form = $(this);
                    let data = $form.serialize();
                    Swal.fire({
                        title: 'Menyimpan...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });

                    $.ajax({
                        url: "{{ route('group.store') }}",
                        type: 'POST',
                        data: data,
                        success: function() {
                            Swal.close();
                            $('#modalForm').modal('hide');
                            if (dtGroups) dtGroups.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil disimpan.'
                            });
                        },
                        error: function(xhr) {
                            Swal.close();
                            if (xhr.status === 422 && xhr.responseJSON?.errors) {
                                const msg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validasi gagal',
                                    html: msg
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal menyimpan',
                                    text: xhr.responseJSON?.message || 'Terjadi kesalahan.'
                                });
                            }
                        }
                    });
                });
                $('#modalForm').on('hidden.bs.modal', function() {
                    clearForm();
                });
            });
        </script>
    </x-slot>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-6">
            <div class="card-header header-elements">
                <h5 class="mb-0 me-2">Management Group</h5>

                <div class="card-header-elements ms-auto">
                    <button type="button" class="btn btn-xs btn-success" id="btnAdd">
                        <span class="icon-base ri ri-add-fill icon-sm me-1"></span>Add Group
                    </button>
                </div>
            </div>
            <div class="card-datatable text-nowrap">
                <table class="datatables-ajax table table-bordered table-responsive" id="dtGroups">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Name Group</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formGroup">
                    @csrf
                    <input type="hidden" name="id">
                    <input type="hidden" name="type_group" value="meter">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label form-label-sm">Name</label>
                            <input type="text" name="name" class="form-control form-control-sm">
                        </div>

                        <div class="mb-3">
                            <label class="form-label form-label-sm">Latitude</label>
                            <input type="text" name="latitude" class="form-control form-control-sm">
                        </div>
                        <div class="mb-3">
                            <label class="form-label form-label-sm">Longitude</label>
                            <input type="text" name="longitude" class="form-control form-control-sm">
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
