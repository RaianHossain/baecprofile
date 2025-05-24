@php
    $title = 'Employees';
    $breadcrumb = [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Employees'] // No URL = active
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
            <button type="button" class="btn btn-primary" id="openEmployeeModal">
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
                <table id="employees-table" class="table datatable-basic">
                    <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Title</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Short Degree</th>
                            <th>Rank</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Special Assignment</th>
                            <th>Joining Data</th>
                            <th>Batch Merit</th>
                            <th>Designation</th>
                            <th>Institute</th>
                            <th>Division</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
            
            
            
        </div>
        <!-- /basic datatable -->
    </div>

    <!-- Modal -->
    <div class="modal fade drawer right-align" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="instituteModalLabel">Right Align Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="employeeForm">
                    <input type="hidden" id="employeeId">

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Employee ID</label>
                        <div class="col-lg-9">
                            <input type="text" id="EmpID" class="form-control" placeholder="e.g. E001">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Title</label>
                        <div class="col-lg-9">
                            <input type="text" id="EmpTitle" class="form-control" placeholder="e.g. Dr.">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">First Name</label>
                        <div class="col-lg-9">
                            <input type="text" id="EmpFname" class="form-control" placeholder="e.g. John">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Last Name</label>
                        <div class="col-lg-9">
                            <input type="text" id="EmpLname" class="form-control" placeholder="e.g. Doe">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Short Degree</label>
                        <div class="col-lg-9">
                            <input type="text" id="EmpShortDegree" class="form-control" placeholder="e.g. BSc">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Rank</label>
                        <div class="col-lg-9">
                            <input type="number" step="0.001" id="EmpRank" class="form-control" placeholder="e.g. 4.567">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Phone</label>
                        <div class="col-lg-9">
                            <input type="text" id="EmpPhone" class="form-control" placeholder="e.g. 017xxxxxxxx">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Email</label>
                        <div class="col-lg-9">
                            <input type="email" id="EmpEmail" class="form-control" placeholder="e.g. example@email.com">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Status</label>
                        <div class="col-lg-9">
                            <input type="text" id="EmpStatus" class="form-control" placeholder="e.g. Active">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Special Assignment</label>
                        <div class="col-lg-9">
                            <input type="text" id="EmpSpecialAssignment" class="form-control" placeholder="e.g. Coordinator">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Joining Date</label>
                        <div class="col-lg-9">
                            <input type="date" id="JoiningDate" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Batch Merit</label>
                        <div class="col-lg-9">
                            <input type="text" id="BatchMerit" class="form-control" placeholder="e.g. Top 10%">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Division</label>
                        <div class="col-lg-9">
                            <input type="text" id="DivShort" class="form-control" placeholder="e.g. DAE">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Institute</label>
                        <div class="col-lg-9">
                            <input type="text" id="InstShort" class="form-control" placeholder="e.g. AECC">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Designation</label>
                        <div class="col-lg-9">
                            <input type="text" id="DesigShort" class="form-control" placeholder="e.g. SO">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">User ID</label>
                        <div class="col-lg-9">
                            <input type="number" id="user_id" class="form-control" placeholder="e.g. 1">
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
            let empTable;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function initializeEmpTable() {
                if ($.fn.DataTable.isDataTable('#employees-table')) {
                    $('#employees-table').DataTable().destroy();
                }

                empTable = $('#employees-table').DataTable({
                    ajax: {
                        url: "{{ url('api/employees') }}",
                        dataSrc: ''
                    },
                    columns: [
                        {
                            data: null,
                            render: (data, type, row, meta) => meta.row + 1
                        },
                        { data: 'EmpTitle' },
                        { data: 'EmpFname' },
                        { data: 'EmpLname' },
                        { data: 'EmpShortDegree' },
                        { data: 'EmpRank' },
                        { data: 'EmpPhone' },
                        { data: 'EmpEmail' },
                        { data: 'EmpStatus' },
                        { data: 'EmpSpecialAssignment' },
                        { data: 'JoiningDate' },
                        { data: 'BatchMerit' },
                        { data: 'DesigShort' },
                        { data: 'InstShort' },
                        { data: 'DivShort' },
                        {
                            data: null,
                            className: 'text-center',
                            render: function (data, type, row) {
                                return `
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item edit-employee" data-id="${row.id}"><i class="icon-pencil7"></i> Edit</a>
                                                <a href="#" class="dropdown-item delete-employee" data-id="${row.id}"><i class="icon-trash"></i> Delete</a>
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
                initializeEmpTable();

                $(document).on('click', '[data-action="reload"]', function () {
                    empTable.ajax.reload();
                });

                $('#openEmployeeModal').on('click', function () {
                    $('#employeeModalLabel').text('Create Employee');
                    $('#employeeForm')[0].reset();
                    $('#employeeId').val('');
                    $('#EmpID').prop('readonly', false);
                    $('#employeeModal').modal('show');
                });

                $('#employeeForm').on('submit', function (e) {
                    e.preventDefault();

                    let id = $('#employeeId').val();
                    let url = id ? `{{ url('api/employees') }}/${id}` : `{{ url('api/employees') }}`;
                    let formData = {
                        EmpID: $('#EmpID').val(),
                        EmpTitle: $('#EmpTitle').val(),
                        EmpFname: $('#EmpFname').val(),
                        EmpLname: $('#EmpLname').val(),
                        EmpShortDegree: $('#EmpShortDegree').val(),
                        EmpRank: $('#EmpRank').val(),
                        EmpPhone: $('#EmpPhone').val(),
                        EmpEmail: $('#EmpEmail').val(),
                        EmpStatus: $('#EmpStatus').val(),
                        EmpSpecialAssignment: $('#EmpSpecialAssignment').val(),
                        JoiningDate: $('#JoiningDate').val(),
                        BatchMerit: $('#BatchMerit').val(),
                        DivShort: $('#DivShort').val(),
                        InstShort: $('#InstShort').val(),
                        DesigShort: $('#DesigShort').val(),
                        user_id: $('#user_id').val()
                    };

                    if (id) {
                        formData._method = 'PUT';
                    }

                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: formData,
                        success: function () {
                            $('#employeeModal').modal('hide');
                            empTable.ajax.reload();
                            alert(id ? 'Employee updated successfully!' : 'Employee created successfully!');
                        },
                        error: function (xhr) {
                            alert('Error: ' + (xhr.responseJSON?.message ?? 'Something went wrong.'));
                        }
                    });
                });

                $(document).on('click', '.edit-employee', function () {
                    let id = $(this).data('id');
                    $.get(`{{ url('api/employees') }}/${id}`, function (data) {
                        $('#employeeModalLabel').text('Edit Employee');
                        $('#employeeId').val(data.id);
                        $('#EmpID').val(data.EmpID).prop('readonly', true);
                        $('#EmpTitle').val(data.EmpTitle);
                        $('#EmpFname').val(data.EmpFname);
                        $('#EmpLname').val(data.EmpLname);
                        $('#EmpShortDegree').val(data.EmpShortDegree);
                        $('#EmpRank').val(data.EmpRank);
                        $('#EmpPhone').val(data.EmpPhone);
                        $('#EmpEmail').val(data.EmpEmail);
                        $('#EmpStatus').val(data.EmpStatus);
                        $('#EmpSpecialAssignment').val(data.EmpSpecialAssignment);
                        $('#JoiningDate').val(data.JoiningDate);
                        $('#BatchMerit').val(data.BatchMerit);
                        $('#DivShort').val(data.DivShort);
                        $('#InstShort').val(data.InstShort);
                        $('#DesigShort').val(data.DesigShort);
                        $('#user_id').val(data.user_id);

                        $('#employeeModal').modal('show');

                    });
                });

                $(document).on('click', '.delete-employee', function (e) {
                    e.preventDefault();
                    let id = $(this).data('id');
                    if (confirm('Are you sure you want to delete this employee?')) {
                        $.ajax({
                            url: `{{ url('api/employees') }}/${id}`,
                            type: 'DELETE',
                            success: function () {
                                empTable.ajax.reload();
                                alert('Employee deleted successfully!');
                            },
                            error: function (xhr) {
                                alert('Error: ' + (xhr.responseJSON?.message ?? 'Could not delete employee.'));
                            }
                        });
                    }
                });


            });
        </script>

        
        
    @endpush
@endsection