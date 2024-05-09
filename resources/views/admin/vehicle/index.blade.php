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
                            <h4 class="card-title">Vehicle Lists</h4>
                        </div>
                        <div class="text-right">
                            <div class="ml-auto">
                                <a href="{{ route('admin.vehicle.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Create</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="vehicleTable" class="table table-bordered table-striped">
                        <thead>
                            <th>No</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Color</th>
                            <th>Aksi</th>
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

    <!-- Modal -->
    <div class="modal fade" id="deleteVehicleModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah kamu yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak Jadi</button>
                    <form id="deleteVehicleForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('foot-script')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>      
    <script>
        $(document).ready(function () {
            $('#vehicleTable').DataTable({
                processing: true,
                serverSide: false,
                ajax: "{{ route('api.admin.vehicle') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'brand', name: 'brand' },
                    { data: 'model', name: 'model' },
                    { data: 'year', name: 'year' },
                    { data: 'color', name: 'color' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return `
                                <a href="{{ route('admin.vehicle.edit', '') }}/${row.id}" class="btn btn-primary btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteVehicleModal" data-id="${row.id}">Delete</button>
                            `;
                        }
                    }
                ]
            });
    
            $('#deleteVehicleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var vehicleId = button.data('id');
                var form = $('#deleteVehicleForm');
                var action = "{{ route('admin.vehicle.destroy', ':id') }}".replace(':id', vehicleId);
                form.attr('action', action);
            });
        });
    </script>
    
@endpush