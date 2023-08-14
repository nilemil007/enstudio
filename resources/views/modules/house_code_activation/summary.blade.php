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

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5>Summary</h5>
            <div>
                <a href="{{ route('hca.lmtd') }}" class="btn btn-sm btn-warning">LMTD</a>
                <a href="{{ route('hca.summary') }}" class="btn btn-sm btn-info {{ \Illuminate\Support\Facades\Route::is('hca.summary') ? 'd-none' : '' }}">MTD</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
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
                        <td>{{ $sum . ' ' . 'Pis' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
