<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Route</x-slot:title>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create New Route</h6>
                    <form id="routeForm" action="{{ route('route.store') }}" method="POST">
                        @csrf

                        <!-- Distribution House -->
                        <div class="row mb-3">
                            <label for="dd_house_id" class="col-sm-3 col-form-label">Distribution House</label>
                            <div class="col-sm-9">
                                <select name="dd_house_id" class="form-select @error('dd_house_id') is-invalid @enderror" id="dd_house_id">
                                    <option value="">-- Select Distribution House --</option>
                                    @if(count($houses) > 0)
                                        @foreach($houses as $house)
                                            <option value="{{ $house->code }}">{{ $house->code .' - '. $house->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('dd_house_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Route Code -->
                        <div class="row mb-3">
                            <label for="code" class="col-sm-3 col-form-label">Route Code</label>
                            <div class="col-sm-9">
                                <input name="code" id="code" type="text" class="form-control @error('code') is-invalid @enderror"
                                       value="{{ old('code') }}"
                                       placeholder="Enter Route Code">
                                @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Route Name -->
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Route Name</label>
                            <div class="col-sm-9">
                                <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" placeholder="Enter Route Name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="row mb-3">
                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <input name="description" id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                       value="{{ old('description') }}" placeholder="Enter Description">
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Weekdays -->
                        <div class="row mb-3">
                            <label for="weekdays" class="col-sm-3 col-form-label">Weekdays</label>
                            <div class="col-sm-9">
                                <input name="weekdays" id="weekdays" type="text" class="form-control @error('weekdays') is-invalid @enderror"
                                       value="{{ old('weekdays') }}" placeholder="Enter Weekdays">
                                @error('weekdays') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Market Length -->
                        <div class="row mb-3">
                            <label for="length" class="col-sm-3 col-form-label">Market Length</label>
                            <div class="col-sm-9">
                                <input name="length" id="length" type="number"
                                       class="form-control @error('length') is-invalid @enderror" value="{{ old('length') }}"
                                       placeholder="Enter Market Length">
                                @error('length') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create New Route</button>
                        <a href="{{ route('route.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3">
                @if(session()->has('import_errors'))
                    @foreach(session()->get('import_errors') as $failure)
                        <div class="card-header">
                            <div class="alert alert-danger">
                                <p>Route name: <strong>{{ $failure->values()['route_name'] .'-'. $failure->values()['route_code'] }}</strong></p>
                                <p>Error type: <strong>{{ \Illuminate\Support\Str::title($failure->attribute()) }}</strong></p>
                                <p>Error msg: {{ $failure->errors()[0] }} </p>
                                <p>Row number : {{ $failure->row() }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="card-body">
                    <h6 class="card-title">Import route</h6>
                    <form class="row gy-2 gx-3 align-items-center import-route" action="{{ route('route.import') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <label class="visually-hidden" for="autoSizingInput">Name</label>
                            <input name="import_route" type="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary w-100 mt-2 btn-import-route">Import Route</button>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ route('route.sample.file.download') }}" class="nav-link text-muted">Download sample file.</a>
        </div>
    </div>

</x-app-layout>
