@extends('layouts.validator')

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
                            <h4 class="card-title">Edit Request</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('validator.approval.update', $request->id) }}" method="POST">
                        @csrf
                        @method('PUT')
    
                        <div class="form-group">
                            <label for="model">Vehicle:</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" placeholder="Enter Model" value="{{ $request->vehicle->brand . ' - ' . $request->vehicle->model }}" readonly>
                            @error('model')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="model">Driver:</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" placeholder="Enter Model" value="{{ $request->driver->name . ' ' . $request->driver->last_name }}" readonly>
                            @error('model')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="model">Validator:</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" placeholder="Enter Model" value="{{ $request->validator->name . ' ' . $request->validator->last_name }}" readonly>
                            @error('model')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @if ($request->valid_to_borrow_at == NULL)
                        <div class="form-group">
                            <label for="valid_to_borrow">Approve to Borrow:</label>
                            <select id="valid_to_borrow" class="form-control @error('valid_to_borrow') is-invalid @enderror" name="valid_to_borrow" {{ $request->valid_to_borrow_at ? 'disabled' : '' }}>
                                <option value="1" {{ $request->valid_to_borrow_at ? 'selected' : '' }}>{{ $request->valid_to_borrow_at !== null ? "Approved at " . \Carbon\Carbon::parse($request->valid_to_borrow_at)->format('Y-m-d H:i') : 'Yes' }}</option>
                                <option value="0" {{ !$request->valid_to_borrow_at ? 'selected' : '' }}>No</option>
                            </select>
                            @error('valid_to_borrow')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @else
                        <div class="form-group">
                            <label for="valid_to_borrow">Approve to Borrow:</label>
                            <input type="text" class="form-control @error('valid_to_borrow') is-invalid @enderror" name="valid_to_borrow" placeholder="Enter Model" value="{{ "Approved at " . \Carbon\Carbon::parse($request->valid_to_borrow_at)->format('Y-m-d H:i') }}" readonly>
                            @error('valid_to_borrow')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @endif
                        
                        @if ($request->valid_to_use_at == NULL)
                        <div class="form-group">
                            <label for="valid_to_use">Approve to Use:</label>
                            <select id="valid_to_use" class="form-control @error('valid_to_use') is-invalid @enderror" name="valid_to_use" {{ $request->valid_to_use_at ? 'disabled' : '' }}>
                                <option value="1" {{ $request->valid_to_use_at ? 'selected' : '' }}>{{ $request->valid_to_use_at !== null ? "Approved at " . \Carbon\Carbon::parse($request->valid_to_use_at)->format('Y-m-d H:i') : 'Yes' }}</option>
                                <option value="0" {{ !$request->valid_to_use_at ? 'selected' : '' }}>No</option>
                            </select>
                            @error('valid_to_use')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @else
                        <div class="form-group">
                            <label for="valid_to_use">Approve to Use:</label>
                            <input type="text" class="form-control @error('valid_to_use') is-invalid @enderror" name="valid_to_use" placeholder="Enter Model" value="{{ "Approved at " . \Carbon\Carbon::parse($request->valid_to_use_at)->format('Y-m-d H:i') }}" readonly>
                            @error('valid_to_use')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @endif
    
                        @if (is_null($request->valid_to_use_at) || is_null($request->valid_to_borrow_at))
                            <button type="submit" class="btn btn-primary">Save</button>
                        @else

                        @endif
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