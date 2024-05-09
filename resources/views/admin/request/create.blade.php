@extends('layouts.admin')

@push('head-link')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/selectize-bootstrap4-theme@2.0.2/dist/css/selectize.bootstrap4.min.css">
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
                            <h4 class="card-title">New Request</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.request.store') }}" method="POST">
                        @csrf
    
                        <div class="form-group">
                            <label for="vehicle_id">Vehicle:</label>
                            <select id="select-vehicle" class="form-control @error('vehicle_id') is-invalid @enderror" id="vehicle_id" name="vehicle_id">
                                <option value="">Select Vehicle</option>
                                @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->brand }} - {{ $vehicle->model }}</option>
                                @endforeach
                            </select>
                            @error('vehicle_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="driver_id">Driver:</label>
                            <select id="select-driver" class="form-control @error('driver_id') is-invalid @enderror" id="driver_id" name="driver_id">
                                <option value="">Select Driver</option>
                                @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                            @error('driver_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="validator_id">Validator:</label>
                            <select id="select-validator" class="form-control @error('validator_id') is-invalid @enderror" id="validator_id" name="validator_id">
                                <option value="">Select Validator</option>
                                @foreach ($validators as $validator)
                                <option value="{{ $validator->id }}">{{ $validator->name }}</option>
                                @endforeach
                            </select>
                            @error('validator_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
    
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
        
@endsection

@push('foot-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
    integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer">
</script>
<script>
    $(document).ready(function() {
        $('#select-vehicle').selectize();
        $('#select-driver').selectize();
        $('#select-validator').selectize();
    });
</script>
@endpush