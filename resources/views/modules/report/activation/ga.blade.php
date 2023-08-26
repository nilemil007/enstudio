<x-app-layout>

    <!-- Title -->
    <x-slot:title>GA Target vs Achievement</x-slot:title>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Gross Add [GA]</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered text-center">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>dd code</th>
                        <th>rso number</th>
                        <th>ga target</th>
                        <th>ach</th>
                        <th>ach %</th>
                        <th>remain</th>
                        <th>daily req</th>
                        <th>ga target [30%]</th>
                        <th>ach</th>
                        <th>ach %</th>
                        <th>remain</th>
                        <th>daily req</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($rsos as $sl => $rso)
                        <tr>
                            <td>{{ ++$sl }}</td>
                            <td>{{ $rso->ddHouse->code }}</td>
                            <td>{{ $rso->itop_number }}</td>
                            <td>{{ round($rso->kpiTarget->ga) }}</td>
                            <td>{{ $rso->coreActivation->count() }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @empty
                        <tr>
                            <td>No data found.</td>
                        </tr>
                        @endforelse
                        <tr style="font-weight: bold">
                            <td colspan="3">Grand Total</td>
                            <td>{{ round($sumOfTotalTarget) }}</td>
                            <td>{{ $sumOfTotalActivation }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
