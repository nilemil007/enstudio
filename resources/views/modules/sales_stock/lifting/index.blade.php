<x-app-layout>

    <!-- Title -->
    <x-slot:title>Liftings</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <h4 class="card-title mb-0">lifting(s)</h4>
                    {{-- @if(count($trashed) > 0)
                       <a href="{{ route('cm.trash') }}" class="text-danger" style="font-weight: bold;"><span style="margin: 0px 10px 0px 10px">|</span> Trash ({{ $trashed->count() }})</a>
                    @endif --}}
                </div>
                <span>
                    <a href="{{ route('cm.create') }}" class="btn btn-sm btn-primary">Add New</a>
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover table-vcenter text-nowrap mt-3 mb-3 text-center align-middle">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>dd house</th>
                            <th>products</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $liftings as $sl => $lifting )
                        <tr>
                            <td>{{ ++$sl }}</td>
                            <td>{{ $lifting->ddHouse->code }}</td>
                            <td>
                                <table class="table table-sm table-bordered table-hover table-vcenter text-nowrap text-center align-middle">
                                    <thead>
                                        <tr>
                                            <th>Sim</th>
                                            <th>Scratch Card</th>
                                            <th>Device</th>
                                            <th>I'top-up</th>
                                            <th>Bank Deposit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p>MMST: 1500</p>
                                                <p>SIM SWAP: 500</p>
                                            </td>
                                            <td>
                                                <p>SCD 29: 5000</p>
                                                <p>SCV 19: 50000</p>
                                            </td>
                                            <td>Router: 1</td>
                                            <td>1038961</td>
                                            <td>1000000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">No data found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>

            $(document).ready(function(){

                // Single delete
                $(document).on('click','#deleteCm',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete This CM?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: $(this).attr('href'),
                                type: 'DELETE',
                                success: function (response){
                                    Swal.fire(
                                        'Deleted!',
                                        response.success,
                                        'success',
                                    ).then((result) => {
                                        location.reload();
                                    });
                                },
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
