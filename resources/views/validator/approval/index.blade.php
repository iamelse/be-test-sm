@extends('layouts.validator')

@push('head-link')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('head-script')
    
@endpush

@section('main-content')

    <!-- Page Heading -->
    <!--<h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>-->

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <section class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="text-left">
                            <h4 class="card-title">Approval Lists</h4>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="approvalTable" class="table table-bordered table-striped">
                        <thead>
                            <th>No</th>
                            <th>Vehicle</th>
                            <th>Driver Name</th>
                            <th>Validator Name</th>
                            <th>Approve To Borrow</th>
                            <th>Approve To Use</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <!-- DataTable will populate the body dynamically -->
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
@endsection

@push('foot-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>      
    <script>
        $(document).ready(function () {
            $('#approvalTable').DataTable({
                processing: true,
                serverSide: false,
                ajax: "{{ route('api.validator.approval') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { 
                        data: function(row) {
                            return row.vehicle.brand + ' ' + row.vehicle.model;
                        },
                        name: 'vehicle_brand_model'
                    },
                    { 
                        data: function(row) {
                            return row.driver.name + ' ' + row.driver.last_name;
                        },
                        name: 'driver_full_name'
                    },
                    { 
                        data: function(row) {
                            return row.validator.name + ' ' + row.validator.last_name;
                        },
                        name: 'validator_full_name'
                    },
                    {
                        data: 'valid_to_borrow_at',
                        name: 'valid_to_borrow_at',
                        render: function(data, type, row) {
                            if (data === null) {
                                return '<span class="badge badge-warning">Waiting Approval</span>';
                            } else {
                                var formattedDate = moment(data).format('YYYY-MM-DD HH:mm');
                                return `<span class="badge badge-success">Approved ${formattedDate}</span>`;
                            }
                        }
                    },
                    {
                        data: 'valid_to_use_at',
                        name: 'valid_to_use_at',
                        render: function(data, type, row) {
                            if (data === null) {
                                return '<span class="badge badge-warning">Waiting Approval</span>';
                            } else {
                                var formattedDate = moment(data).format('YYYY-MM-DD HH:mm');
                                return `<span class="badge badge-success">Approved ${formattedDate}</span>`;
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return `
                                <a href="{{ route('validator.approval.show', '') }}/${row.id}" class="btn btn-primary btn-sm">Detail</a>
                            `;
                        }
                    }
                ]
            });
        });
    </script>
@endpush