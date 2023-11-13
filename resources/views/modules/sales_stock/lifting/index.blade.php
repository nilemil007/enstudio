<x-app-layout>

    <!-- Title -->
    <x-slot:title>Liftings</x-slot:title>

    <div class="card bg-secondary bg-gradient text-white">
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
                <table class="table table-sm table-bordered table-vcenter text-nowrap mt-3 mb-3 align-middle">
                    <thead class="text-center">
                        <tr>
                            <th class="text-white">dd house</th>
                            <th class="text-white">products</th>
                            <th class="text-white">lifting date</th>
                            {{--

                            <th class="text-dark">action</th> --}}
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ( $liftings as $sl => $lifting )
                            @foreach (\App\Models\Lifting::getDdHouse($lifting->lifting_date) as $house)
                                <tr>
                                    <td class="text-center">{{ $house->ddHouse->code }}</td>
                                    <td>
                                        <table class="table table-sm table-bordered table-hover table-vcenter text-nowrap align-middle">
                                            <thead class="text-center">
                                                <tr>
                                                    <th class="text-light">Sim</th>
                                                    <th class="text-light">Scratch Card</th>
                                                    <th class="text-light">Device</th>
                                                    <th class="text-light">I'top-up</th>
                                                    <th class="text-light">Bank Deposit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        @foreach (\App\Models\Lifting::getLiftingData($house->dd_house_id, $lifting->lifting_date, 'sim') as $data)
                                                            <p>{{ Str::upper(implode(' ', explode('_', $data->product))) . ': ' . $data->qty }}</p>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach (\App\Models\Lifting::getLiftingData($house->dd_house_id, $lifting->lifting_date, 'scratch_card') as $data)
                                                            <p>{{ Str::upper(implode(' ', explode('_', $data->product))) . ': ' . $data->qty }}</p>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach (\App\Models\Lifting::getLiftingData($house->dd_house_id, $lifting->lifting_date, 'device') as $data)
                                                            <p>{{ Str::upper(implode(' ', explode('_', $data->product))) . ': ' . $data->qty }}</p>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-center liftingItem position-relative">
                                                        @foreach (\App\Models\Lifting::getLiftingData($house->dd_house_id, $lifting->lifting_date, 'itopup') as $data)
                                                            <p>
                                                                {{ $data->itopup }}
                                                                <span class="position-absolute liftingEditIcon" style="right: 0; top: 0;">
                                                                    <a href="{{ route('lifting.edit', $data->id) }}" class="nav-link">
                                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                                    </a>
                                                                </span>
                                                            </p>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-center">
                                                        @foreach (\App\Models\Lifting::getLiftingData($house->dd_house_id, $lifting->lifting_date, 'itopup') as $data)
                                                            <p>{{ $data->bank_deposit }}</p>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="text-center">{{ $lifting->lifting_date->toFormattedDateString() }}</td>
                                </tr>
                            @endforeach
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
