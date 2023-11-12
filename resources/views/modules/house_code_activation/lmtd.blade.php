<x-app-layout>

    <!-- Title -->
    <x-slot:title>HCA LMTD</x-slot:title>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5>Summary LMTD</h5>
            <div>
                <a href="{{ route('hca.lmtd') }}" class="btn btn-sm btn-warning {{ \Illuminate\Support\Facades\Route::is('hca.lmtd') ? 'd-none' : '' }}">LMTD</a>
                <a href="{{ route('hca.summary') }}" class="btn btn-sm btn-info">MTD</a>
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
                    @php $activations = \App\Models\Activation\HouseCodeActivation::getActivationByPreviousMonthPrice($price->price) @endphp
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
