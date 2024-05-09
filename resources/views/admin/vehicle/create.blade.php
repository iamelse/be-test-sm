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
                            <h4 class="card-title">New Vehicle</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.vehicle.store') }}" method="POST">
                        @csrf
    
                        <div class="form-group">
                            <label for="brand">Brand:</label>
                            <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand" name="brand" placeholder="Enter Brand" value="{{ old('brand') }}">
                            @error('brand')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="model">Model:</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" placeholder="Enter Model" value="{{ old('model') }}">
                            @error('model')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="year">Year:</label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" placeholder="Enter Year" value="{{ old('year') }}">
                            @error('year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="color">Color:</label>
                            <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" placeholder="Enter Color" value="{{ old('color') }}">
                            @error('color')
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
    
@endpush