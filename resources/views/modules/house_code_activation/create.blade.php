<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Record</x-slot:title>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <li class="alert alert-danger">{{ $error }}</li>
        @endforeach
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create new Record</h6>
                    <form id="supervisorForm" action="{{ route('hca.store') }}" method="POST">
                        @csrf

                        <!-- User Name -->
                        <div class="row mb-3">
                            <label for="user_id" class="col-sm-3 col-form-label">User Name</label>
                            <div class="col-sm-9">
                                <select name="user_id" class="form-select" id="user_id">
                                    <option value="">-- Select User --</option>
                                    @if(count($users) > 0)
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->phone .' - '. \Illuminate\Support\Str::upper($user->role) .' - '. $user->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <!-- Retailer Code -->
                        <div class="row mb-3">
                            <label for="retailer_code" class="col-sm-3 col-form-label">Retailer Code</label>
                            <div class="col-sm-9">
                                <select name="retailer_code" class="select-2 form-select" id="retailer_code">
                                    <option value="">-- Select Retailer Code --</option>
                                    @if(count($retailers) > 0)
                                        @foreach($retailers as $retailer)
                                            <option value="{{ $retailer->code }}">{{ $retailer->dd_house .' - '. $retailer->code . ' - ' . $retailer->itop_number }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <!-- Activation -->
                        <div class="row mb-3">
                            <label for="activation" class="col-sm-3 col-form-label">Activation</label>
                            <div class="col-sm-9">
                                <input name="activation" id="activation" type="number"
                                       class="form-control" value="{{ old('activation') }}"
                                       placeholder="Enter Activation">
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="row mb-3">
                            <label for="price" class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input name="price" id="price" type="number"
                                       class="form-control" value="{{ old('price') }}"
                                       placeholder="Enter Price">
                            </div>
                        </div>

                        <!-- Activation Date -->
                        <div class="row mb-3">
                            <label for="activation_date" class="col-sm-3 col-form-label">Activation Date</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input name="activation_date" id="activation_date" value="{{ now() }}" type="text" class="flatpickr form-control" placeholder="Select date">
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2">Create</button>
                        <a href="{{ route('hca.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
