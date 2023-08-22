@php
    $date = \Carbon\Carbon::now()->startOfMonth()->toDateString();//start date
    $end_date = \Carbon\Carbon::now()->endOfMonth()->toDateString();//end date
@endphp

<x-app-layout>

    <!-- Title -->
    <x-slot:title>Summary</x-slot:title>

{{--    <div id="coreActivationErrMsg" class="alert alert-danger err-msg d-none"></div>--}}

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Activation Summary</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>retailer code</th>
                        @for($i = $date; $i <= $end_date; $i++)
                            <th>{{ date('d M', strtotime($i)) }}</th>
                        @endfor
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $retailerCode as $sl => $retailer )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $retailer->code }}</td>
                            @for ($a = $date; $a <= $end_date; $a++)
                            @php $activationCount = \App\Models\Activation\CoreActivation::getActivation($retailer->id, $a) @endphp
                            <td>{{ $activationCount }}</td>
                            @endfor
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
{{--            <div class="table-responsive">--}}
{{--                <table id="coreActivationTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3 text-center">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th class="w-1">No.</th>--}}
{{--                        <th>activation date</th>--}}
{{--                        <th>distributor code</th>--}}
{{--                        <th>distributor name</th>--}}
{{--                        <th>retailer code</th>--}}
{{--                        <th>retailer name</th>--}}
{{--                        <th>product code</th>--}}
{{--                        <th>product name</th>--}}
{{--                        <th>sim no</th>--}}
{{--                        <th>msisdn</th>--}}
{{--                        <th>selling price</th>--}}
{{--                        <th>bp flag</th>--}}
{{--                        <th>bp number</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach( $activations as $sl => $activation )--}}
{{--                        <tr>--}}
{{--                            <td><span class="text-muted">{{ ++$sl }}</span></td>--}}
{{--                            <td>{{ $activation->activation_date->toFormattedDateString() }}</td>--}}
{{--                            <td>{{ $activation->ddHouse->code }}</td>--}}
{{--                            <td>{{ $activation->ddHouse->name }}</td>--}}
{{--                            <td>{{ $activation->retailer->code }}</td>--}}
{{--                            <td>{{ $activation->retailer->name }}</td>--}}
{{--                            <td>{{ $activation->product_code }}</td>--}}
{{--                            <td>{{ $activation->product_name }}</td>--}}
{{--                            <td>{{ $activation->sim_serial }}</td>--}}
{{--                            <td>{{ $activation->msisdn }}</td>--}}
{{--                            <td>{{ $activation->selling_price }}</td>--}}
{{--                            <td>{{ $activation->bp_flag }}</td>--}}
{{--                            <td>{{ $activation->bp_number }}</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
        </div>
    </div>

    @push('scripts')
        <script>
            new DataTable('#coreActivationTbl');
        </script>
    @endpush
</x-app-layout>
