@extends('layouts.admin')

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
                            <h4 class="card-title">Request Lists</h4>
                            <a class="btn btn-sm btn-info" href="{{ route('admin.request.export.as.excel') }}">Excel</a>
                            <a class="btn btn-sm btn-info" href="{{ route('admin.request.export.as.csv') }}">CSV</a>
                        </div>
                        <div class="text-right">
                            <div class="ml-auto">
                                <a href="{{ route('admin.request.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Create</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="vehicleTable" class="table table-bordered table-striped">
                        <thead>
                            <th>No</th>
                            <th>Vehicle</th>
                            <th>Driver Name</th>
                            <th>Validator Name</th>
                            <th>Approve To Borrow</th>
                            <th>Approve To Use</th>
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
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>      
    <script>
        $(document).ready(function () {
            $('#vehicleTable').DataTable({
                processing: true,
                serverSide: false,
                ajax: "{{ route('api.admin.request') }}",
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
                                return data;
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
                                return data;
                            }
                        }
                    }
                ]
            });
        });
    </script>
    
@endpush