<x-app-layout>

    <!-- Title -->
    <x-slot:title>HCA Summary</x-slot:title>

    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title mb-0">Select Date Range</h4>
        </div>
        <div class="card-body">
            <form id="hcaSummaryForm" class="mb-3">
                <div class="row">
                    <div class="col">
                        <select class="form-select" name="search">
                            <option value="">Select DD House</option>
                            @foreach($ddHouse as $house)
                                <option @selected(request()->get('dd_house') == $house->code) value="{{ $house->code }}">{{ $house->code.' - '.$house->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input name="start_date" id="start_date" value="{{ request()->get('start_date') }}" type="text" class="flatpickr form-control" placeholder="Start Date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                <i data-feather="calendar"></i>
                            </span>
                        </div>
                        @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input name="end_date" id="end_date" value="{{ request()->get('end_date') }}" type="text" class="flatpickr form-control" placeholder="End Date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                <i data-feather="calendar"></i>
                            </span>
                        </div>
                        @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(!empty($results))
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered card-table table-vcenter text-nowrap mt-3 mb-3 text-center">
                        <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>DD House</th>
                            <th>Name</th>
                            <th>Retailer Code</th>
                            <th>Activation</th>
                            <th>Price</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $sl => $result)
                            <tr>
                                <td>{{ ++$sl }}</td>
                                <td>{{ $result->dd_house }}</td>
                                <td>{{ $result->user->name }}</td>
                                <td>{{ $result->retailer_code }}</td>
                                <td>{{ $result->activation }}</td>
                                <td>{{ $result->price }}</td>
                                <td>{{ $result->activation_date->toFormattedDateString() }}</td>
                            </tr>
                        @endforeach
                        <tr style="font-weight: bold">
                            <td colspan="4">Grand Total</td>
                            <td>{{ $results->sum('activation') }}</td>
                            <td colspan="2"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#hcaSummaryForm').validate({
                    rules: {
                        start_date: {
                            required: true,
                        },
                        end_date: {
                            required: true,
                        },
                    },
                    messages: {
                        start_date: {
                            required: 'Please select a start date.',
                        },
                        end_date: {
                            required: 'Please select a end date.',
                        }
                    },
                    errorPlacement: function(error, element){
                        error.addClass('invalid-feedback');

                        if (element.parent('.input-group').length) {
                            error.insertAfter(element.parent());
                        }
                        else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                            error.insertAfter(element.parent().parent());
                        }
                        else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                            error.appendTo(element.parent().parent());
                        }
                        else {
                            error.insertAfter(element);
                        }
                    },
                    highlight: function(element, errorClass){
                        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
                            $( element ).addClass( "is-invalid" );
                        }
                    },
                    unhighlight: function(element, errorClass){
                        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
                            $( element ).removeClass( "is-invalid" );
                        }
                    },
                });
            });
        </script>
    @endpush
</x-app-layout>
