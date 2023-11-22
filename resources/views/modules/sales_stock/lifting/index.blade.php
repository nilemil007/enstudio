<x-app-layout>

    <!-- Title -->
    <x-slot:title>Liftings</x-slot:title>

    <div x-data="liftingIndex" class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <h4 class="card-title mb-0">lifting(s)</h4>
                    {{-- @if(count($trashed) > 0)
                       <a href="{{ route('cm.trash') }}" class="text-danger" style="font-weight: bold;"><span style="margin: 0px 10px 0px 10px">|</span> Trash ({{ $trashed->count() }})</a>
                    @endif --}}
                </div>
                <span>
                    <a href="{{ route('lifting.create') }}" class="btn btn-sm btn-primary bg-gradient">Add New</a>
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-vcenter text-nowrap mt-3 mb-3 align-middle text-center">
                    <thead>
                        <tr>
                            <th>sl</th>
                            <th>dd house</th>
                            <th>products</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ( $liftings as $sl => $lifting )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $lifting->ddHouse->code }}</td>
                            <td>
                                <table class="table table-sm table-bordered table-vcenter text-nowrap mt-3 mb-3 align-middle">
                                    <thead>
                                        <tr>
                                            <th>sim</th>
                                            <th>scratch card</th>
                                            <th>device</th>
                                            <th>i'top-up</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td>
                                            <div>
                                                <p x-ref="mmstValue" class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Lifting Price: '. $lifting->mmst_lifting_price . ' Amount: ' . $lifting->mmst_amount . ' Remarks: ' . $lifting->mmst_remarks }}">
                                                    MMST: {{ $lifting->mmst }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Lifting Price: '. $lifting->mmsts_lifting_price . ' Amount: ' . $lifting->mmsts_amount . ' Remarks: ' . $lifting->mmsts_remarks }}">
                                                    MMSTS: {{ $lifting->mmsts }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Lifting Price: '. $lifting->sim_swap_lifting_price . ' Amount: ' . $lifting->sim_swap_amount . ' Remarks: ' . $lifting->sim_swap_remarks }}">
                                                    SIM SWAP: {{ $lifting->sim_swap }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Lifting Price: '. $lifting->sim_swap_ev_lifting_price . ' Amount: ' . $lifting->sim_swap_ev_amount . ' Remarks: ' . $lifting->sim_swap_ev_remarks }}">
                                                    SIM SWAP EV: {{ $lifting->sim_swap_ev }}
                                                </p>
                                            </div>
                                        </td>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        {{-- <tr>
                            <td>

                            </td>
                            <td>{{ $lifting->ddHouse->code }}</td>
                            <td>

                            </td>
                            <td>{{ $lifting->lifting_date->toFormattedDateString() }}</td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('lifting.edit', $lifting->id) }}" class="btn btn-sm btn-primary bg-gradient">Edit</a>

                                <!-- Move to trash -->
                                <a href="{{ route('lifting.destroy', $lifting->id) }}" id="deleteLifting" class="btn btn-sm btn-danger  bg-gradient">Delete</a>
                            </td>
                        </tr> --}}
                        @empty
                        <tr class="text-center">
                            <td colspan="3">No data found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-white">
            {{ $liftings->links('pagination::bootstrap-5') }}
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('liftingIndex', () => ({
                    init(){
                        console.log(this.$refs.mmstValue)
                    }
                }));
            });

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
                                beforeSend: () => {
                                    $('#loading').show();
                                },
                                complete: () => {
                                    $('#loading').hide();
                                },
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
