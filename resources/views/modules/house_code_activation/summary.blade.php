@php $sumOfActivation = true; @endphp

<x-app-layout>

    <!-- Title -->
    <x-slot:title>HCA Summary</x-slot:title>

{{--    <div class="card mb-5">--}}
{{--        <div class="card-header">--}}
{{--            <h4 class="card-title mb-0">Select Date Range</h4>--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}
{{--            <form id="hcaSummaryForm" class="mb-3">--}}
{{--                <div class="row">--}}
{{--                    <div class="col">--}}
{{--                        <select class="form-select" name="search">--}}
{{--                            <option value="">Select DD House</option>--}}
{{--                            @foreach($ddHouse as $house)--}}
{{--                                <option @selected(request()->get('dd_house') == $house->code) value="{{ $house->code }}">{{ $house->code.' - '.$house->name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col">--}}
{{--                        <div class="input-group">--}}
{{--                            <input name="start_date" id="start_date" value="{{ request()->get('start_date') }}" type="text" class="flatpickr form-control" placeholder="Start Date">--}}
{{--                            <span class="input-group-text input-group-addon" data-toggle>--}}
{{--                                <i data-feather="calendar"></i>--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                        @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror--}}
{{--                    </div>--}}
{{--                    <div class="col">--}}
{{--                        <div class="input-group">--}}
{{--                            <input name="end_date" id="end_date" value="{{ request()->get('end_date') }}" type="text" class="flatpickr form-control" placeholder="End Date">--}}
{{--                            <span class="input-group-text input-group-addon" data-toggle>--}}
{{--                                <i data-feather="calendar"></i>--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                        @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror--}}
{{--                    </div>--}}

{{--                    <div class="col">--}}
{{--                        <button type="submit" class="btn btn-primary w-100">Search</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}

    <table class="table-bordered mb-5 text-center">
        <thead>
            <tr>
                <th class="p-2">No.</th>
                <th class="p-2">Price</th>
                <th class="p-2">Activation</th>
            </tr>
        </thead>
        <tbody>
        @forelse($prices as $sl => $price)
            @php $activations = \App\Models\Activation\HouseCodeActivation::getActivationByPrice($price->price) @endphp
            <tr>
                <td>{{ ++$sl }}</td>
                <td class="p-2">{{ $price->price . ' ' . 'Tk' }}</td>
                <td  class="p-2">{{ $activations . ' ' . 'Pis' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No data found.</td>
            </tr>
        @endforelse
            <tr style="font-weight: bold;">
                <td colspan="2">Total</td>
                <td>{{ $results->sum('activation') . ' ' . 'Pis' }}</td>
            </tr>

        </tbody>
    </table>


{{--    <div class="table-responsive mt-5">--}}
{{--        <table class="table-bordered">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th class="w-1">No.</th>--}}
{{--                <th>DD House</th>--}}
{{--                <th>Name</th>--}}
{{--                <th>Retailer Code</th>--}}
{{--                <th>Activation</th>--}}
{{--                <th>Price</th>--}}
{{--                <th>Date</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($results as $sl => $result)--}}
{{--                <tr>--}}
{{--                    <td>{{ ++$sl }}</td>--}}
{{--                    <td>{{ $result->dd_house }}</td>--}}
{{--                    <td>{{ $result->user->name }}</td>--}}
{{--                    <td>{{ $result->retailer_code }}</td>--}}
{{--                    <td>{{ $result->activation }}</td>--}}
{{--                    <td>{{ $result->price }}</td>--}}
{{--                    <td>{{ $result->activation_date->toFormattedDateString() }}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            <tr style="font-weight: bold">--}}
{{--                <td colspan="4">Grand Total</td>--}}
{{--                <td>{{ $results->sum('activation') }}</td>--}}
{{--                <td colspan="2"></td>--}}
{{--            </tr>--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}

</x-app-layout>
