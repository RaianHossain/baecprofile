@php
    $title = 'Institutes';
    $breadcrumb = [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Institutes'] // No URL = active
    ];
@endphp

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

    /* Drawer aligns content to right */
    .modal.drawer.right-align {
        flex-direction: row-reverse;
    }

    /* Default hidden state: off the right edge, transparent */
    .modal.drawer.right-align .modal-dialog {
        margin: 0;
        display: flex;
        flex: auto;
        opacity: 0;
        transform: translateX(100%); /* Fully off the screen to the right */
        transition: transform 0.4s ease, opacity 0.4s ease;
    }

    /* When modal is shown: slide into place from right */
    .modal.drawer.right-align.show .modal-dialog {
        transform: translateX(0); /* Slide into view */
        opacity: 1;
    }

    /* Modal content styling */
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

    /* datatable design */
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


@extends('layouts.backend')
@section('content')
    <div class="content">
        <div class="d-flex justify-content-end mb-2">
            <button type="button" class="btn btn-primary" id="openInstituteModal">
                Create New
            </button>
        </div>
        <!-- Basic datatable -->
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
                <table id="institutes-table" class="table datatable-basic">
                    <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Institute Short</th>
                            <th>Institute Long</th>
                            <th>Institute Place</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
            
            
            
        </div>
        <!-- /basic datatable -->
    </div>

    <!-- Modal -->
    <div class="modal fade drawer right-align" id="instituteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="instituteModalLabel">Right Align Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="instituteForm">
                    <input type="hidden" id="instituteId">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Short Name</label>
                        <div class="col-lg-9">
                            <input type="text" id="InstShort" class="form-control" placeholder="e.g. AECC">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Long Name</label>
                        <div class="col-lg-9">
                            <input type="text" id="InstLong" class="form-control" placeholder="e.g. Atomic Energy Centre">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Place</label>
                        <div class="col-lg-9">
                            <input type="text" id="InstPlace" class="form-control" placeholder="e.g. Dhaka">
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

        {{-- <script src="{{ asset('assets/backend/global_assets/js/demo_pages/datatables_basic.js') }}"></script> --}}
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
                if ($.fn.DataTable.isDataTable('#institutes-table')) {
                    $('#institutes-table').DataTable().destroy();
                }
        
                table = $('#institutes-table').DataTable({
                    ajax: {
                        url: "{{ url('api/institutes') }}",
                        dataSrc: ''
                    },
                    columns: [
                        {
                            data: null,
                            render: function (data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        { data: 'InstShort' },
                        { data: 'InstLong' },
                        { data: 'InstPlace' },
                        {
                            data: null,
                            className: 'text-center',
                            render: function (data, type, row) {
                                return `
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item edit-btn" data-id="${row.InstShort}"><i class="icon-pencil7"></i> Edit</a>
                                                <a href="#" class="dropdown-item delete-btn" data-id="${row.InstShort}"><i class="icon-trash"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            }
                        }
                    ]
                });
            }
        
            $(document).ready(function () {
                initializeDataTable();
        
                // Reload table
                $(document).on('click', '[data-action="reload"]', function () {
                    table.ajax.reload();
                });
        
                // Open modal to create
                $('#openInstituteModal').on('click', function () {
                    $('#instituteModalLabel').text('Create Institute');
                    $('#instituteForm')[0].reset();
                    $('#instituteId').val('');
                    $('#InstShort').prop('readonly', false); // allow editing for create
                    $('#instituteModal').modal('show');
                });
        
                // Save (Create or Update)
                $('#instituteForm').on('submit', function (e) {
                    e.preventDefault();
        
                    let id = $('#instituteId').val();
                    let url = id ? `{{ url('api/institutes') }}/${id}` : `{{ url('api/institutes') }}`;
                    let formData = {
                        InstShort: $('#InstShort').val(),
                        InstLong: $('#InstLong').val(),
                        InstPlace: $('#InstPlace').val()
                    };
        
                    if (id) {
                        formData._method = 'PUT'; // Laravel will detect this and treat it as a PUT
                    }
        
                    $.ajax({
                        url: url,
                        method: 'POST', // Always POST, even for PUT via method spoofing
                        data: formData,
                        success: function () {
                            $('#instituteModal').modal('hide');
                            table.ajax.reload();
                            alert(id ? 'Institute updated successfully!' : 'Institute created successfully!');
                        },
                        error: function (xhr) {
                            alert('Error: ' + (xhr.responseJSON?.message ?? 'Something went wrong.'));
                        }
                    });
                });
        
                // Edit button click
                $(document).on('click', '.edit-btn', function () {
                    let id = $(this).data('id');
                    $.get(`{{ url('api/institutes') }}/${id}`, function (data) {
                        $('#instituteModalLabel').text('Edit Institute');
                        $('#instituteId').val(data.InstShort); // hidden field for internal use
                        $('#InstShort').val(data.InstShort).prop('readonly', true); // prevent changing primary key
                        $('#InstLong').val(data.InstLong);
                        $('#InstPlace').val(data.InstPlace);
                        $('#instituteModal').modal('show');
                    });
                });
        
                // Delete button click
                $(document).on('click', '.delete-btn', function () {
                    if (!confirm('Are you sure you want to delete this institute?')) return;
        
                    let id = $(this).data('id');
                    $.ajax({
                        url: `{{ url('api/institutes') }}/${id}`,
                        method: 'DELETE',
                        success: function () {
                            table.ajax.reload();
                            alert('Institute deleted successfully!');
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