@php
    $title = 'Divisions';
    $breadcrumb = [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Divisions']
    ];
@endphp

@extends('layouts.backend')

@section('content')
<style>
    .modal.drawer {
        display: flex !important;
        pointer-events: none;
    }

    .modal.drawer * {
        pointer-events: none;
    }

    .modal.drawer.show {
        pointer-events: auto;
    }

    .modal.drawer.show * {
        pointer-events: auto;
    }

    .modal.drawer.right-align {
        flex-direction: row-reverse;
    }

    .modal.drawer.right-align .modal-dialog {
        margin: 0;
        display: flex;
        flex: auto;
        opacity: 0;
        transform: translateX(100%);
        transition: transform 0.4s ease, opacity 0.4s ease;
    }

    .modal.drawer.right-align.show .modal-dialog {
        transform: translateX(0);
        opacity: 1;
    }

    .modal.drawer .modal-dialog .modal-content {
        border: none;
        border-radius: 0;
    }

    .modal.drawer .modal-dialog .modal-content .modal-body {
        overflow: auto;
    }

    .btn-primary {
        background-color: #0058A9 !important;
        border-color: #0058A9 !important;
    }

    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 1rem;
        text-align: right;
    }

    .dataTables_wrapper .dataTables_filter label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .dataTables_wrapper .dataTables_length {
        margin-bottom: 1rem;
    }

    .dataTables_wrapper .dataTables_paginate {
        margin-top: 1rem;
    }

    table.dataTable {
        border-collapse: collapse !important;
    }

    .table th, .table td {
        vertical-align: middle;
    }
</style>

<div class="content">
    <div class="d-flex justify-content-end mb-2">
        <button type="button" class="btn btn-primary" id="openDivisionModal">Create New</button>
    </div>

    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title"></h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="reload"></a>
                </div>
            </div>
        </div>

        <div class="p-3">
            <table id="divisions-table" class="table datatable-basic">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Division Short</th>
                        <th>Division Long</th>
                        <th>Institute</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade drawer right-align" id="divisionModal" tabindex="-1" role="dialog" aria-labelledby="divisionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="divisionModalLabel">Create Division</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="divisionForm">
                    <input type="hidden" id="divisionId">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Short Name</label>
                        <div class="col-lg-9">
                            <input type="text" id="DivShort" class="form-control" placeholder="e.g. PHYSICS">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Long Name</label>
                        <div class="col-lg-9">
                            <input type="text" id="DivLong" class="form-control" placeholder="e.g. Division of Physics">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Institute</label>
                        <div class="col-lg-9">
                            <select id="InstShort" class="form-control">
                                <!-- Options will be loaded via JavaScript -->
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
        <!-- Theme JS files -->
        <script src="{{ asset('assets/backend/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/backend/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

        <!-- Responsive extension -->
        <script src="{{ asset('assets/backend/global_assets/js/plugins/tables/datatables/extensions/responsive.min.js') }}"></script>

        <script src="{{ asset('assets/backend/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
        <script src="{{ asset('assets/backend/global_assets/js/demo_pages/form_inputs.js') }}"></script>
        
        <script>
            let table;
        
            // Setup CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            function initializeDataTable() {
                if ($.fn.DataTable.isDataTable('#divisions-table')) {
                    $('#divisions-table').DataTable().destroy();
                }
        
                table = $('#divisions-table').DataTable({
                    ajax: {
                        url: "{{ url('api/divisions') }}",
                        dataSrc: ''
                    },
                    columns: [
                        {
                            data: null,
                            render: function (data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        { data: 'DivShort' },
                        { data: 'DivLong' },
                        {
                            data: 'institute',
                            render: function (data) {
                                return data ? data.InstLong : '-';
                            }
                        },
                        {
                            data: null,
                            className: 'text-center',
                            render: function (data, type, row) {
                                return `
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item edit-btn" data-id="${row.DivShort}"><i class="icon-pencil7"></i> Edit</a>
                                                <a href="#" class="dropdown-item delete-btn" data-id="${row.DivShort}"><i class="icon-trash"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            }
                        }
                    ]
                });
            }
        
            function loadInstituteOptions() {
                $.get("{{ url('api/institutes') }}", function (data) {
                    let options = `<option value="">-- Select Institute --</option>`;
                    data.forEach(inst => {
                        options += `<option value="${inst.InstShort}">${inst.InstLong}</option>`;
                    });
                    $('#InstShort').html(options);
                });
            }
        
            $(document).ready(function () {
                initializeDataTable();
                loadInstituteOptions();
        
                // Reload table
                $(document).on('click', '[data-action="reload"]', function () {
                    table.ajax.reload();
                });
        
                // Open modal to create
                $('#openDivisionModal').on('click', function () {
                    $('#divisionModalLabel').text('Create Division');
                    $('#divisionForm')[0].reset();
                    $('#divisionId').val('');
                    $('#DivShort').prop('readonly', false);
                    $('#divisionModal').modal('show');
                });
        
                // Save (Create or Update)
                $('#divisionForm').on('submit', function (e) {
                    e.preventDefault();
        
                    let id = $('#divisionId').val();
                    let url = id ? `{{ url('api/divisions') }}/${id}` : `{{ url('api/divisions') }}`;
                    let formData = {
                        DivShort: $('#DivShort').val(),
                        DivLong: $('#DivLong').val(),
                        InstShort: $('#InstShort').val()
                    };
        
                    if (id) {
                        formData._method = 'PUT';
                    }
        
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: formData,
                        success: function () {
                            $('#divisionModal').modal('hide');
                            table.ajax.reload();
                            alert(id ? 'Division updated successfully!' : 'Division created successfully!');
                        },
                        error: function (xhr) {
                            alert('Error: ' + (xhr.responseJSON?.message ?? 'Something went wrong.'));
                        }
                    });
                });
        
                // Edit button click
                $(document).on('click', '.edit-btn', function () {
                    let id = $(this).data('id');
                    $.get(`{{ url('api/divisions') }}/${id}`, function (data) {
                        $('#divisionModalLabel').text('Edit Division');
                        $('#divisionId').val(data.DivShort);
                        $('#DivShort').val(data.DivShort).prop('readonly', true);
                        $('#DivLong').val(data.DivLong);
                        $('#InstShort').val(data.InstShort ?? '');
                        $('#divisionModal').modal('show');
                    });
                });
        
                // Delete button click
                $(document).on('click', '.delete-btn', function () {
                    if (!confirm('Are you sure you want to delete this division?')) return;
        
                    let id = $(this).data('id');
                    $.ajax({
                        url: `{{ url('api/divisions') }}/${id}`,
                        method: 'DELETE',
                        success: function () {
                            table.ajax.reload();
                            alert('Division deleted successfully!');
                        },
                        error: function (xhr) {
                            alert('Error: ' + (xhr.responseJSON?.message ?? 'Something went wrong.'));
                        }
                    });
                });
            });
        </script>
        
        
        
    @endpush
@endsection
