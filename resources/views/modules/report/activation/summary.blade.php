<x-app-layout>

    <!-- Title -->
    <x-slot:title>Activation Summary</x-slot:title>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Activation Summary</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered text-center">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>retailer code</th>
                        <th>total activation</th>
                        @for($i = $startDate; $i <= $endDate; $i++)
                            <th>{{ date('d M', strtotime($i)) }}</th>
                        @endfor
                    </tr>
                    </thead>
                    <tbody>
                    @forelse( $retailerCode as $sl => $retailer )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $retailer->code }}</td>
                            <td><strong>{{ \App\Models\Activation\CoreActivation::getRetailerTotalActivation($retailer->id) }}</strong></td>
                            @for ($a = $startDate; $a <= $endDate; $a++)
                            <td>{{ \App\Models\Activation\CoreActivation::getRetailerActivationByDate($retailer->id, $a) }}</td>
                            @endfor
                        </tr>
                    @empty
                        <tr>
                            <td>No data found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $retailerCode->links('pagination::bootstrap-5') }}
        </div>
    </div>

    @push('scripts')
        <script>
            new DataTable('#coreActivationTbl');
        </script>
    @endpush
</x-app-layout>
