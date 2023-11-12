<x-app-layout>

    <!-- Title -->
    <x-slot:title>Itop Replace</x-slot:title>

    @if(auth()->user()->role == 'superadmin')
    <form class="mb-3 d-flex justify-content-center">
        <div class="row">
            <div class="col-md-5">
                <div class="input-group">
                    <input name="start_date" id="start_date" value="{{ request()->get('start_date') }}" type="text" class="flatpickr form-control" placeholder="Select date">
                    <span class="input-group-text input-group-addon" data-toggle>
                        <i data-feather="calendar"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <input name="end_date" id="end_date" value="{{ request()->get('end_date') }}" type="text" class="flatpickr form-control" placeholder="Select date">
                    <span class="input-group-text input-group-addon" data-toggle>
                        <i data-feather="calendar"></i>
                    </span>
                </div>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Itop Replacement List</h4>
                <span>
                    <a href="{{ route('itop-replace.create') }}" class="btn btn-sm btn-primary">Add new</a>

                    @if(auth()->user()->role == 'superadmin')
                        @if(count($replaces) > 1)
                            <a id="deleteAllReplace" href="{{ route('itop-replace.delete.all') }}" class="btn btn-sm btn-danger">Delete all</a>
                        @endif
                    @endif
                </span>
            </div>
            <div class="table-responsive">
                <table id="itopReplaceTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>Name</th>
                        <th>Itop Number</th>
                        <th>Serial Number</th>
                        <th>Remarks</th>
                        <th>Requested</th>
                        <th>Payment Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $replaces as $sl => $replace )
                        <tr class="{{ $replace->remarks ? 'alert alert-danger' : ($replace->status == 'paid' ? 'alert alert-success' : '') }}">
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $replace->user->name }}</td>
                            <td>{{ $replace->itop_number }}</td>
                            <td>{{ $replace->serial_number }}</td>
                            <td>
                                @if( $replace->remarks )
                                    <button
                                        class="btn btn-sm btn-pill {{ auth()->user()->role != 'superadmin' ? 'disabled' : '' }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="@if(auth()->user()->role == 'superadmin') #approve-reject-{{ $replace->id }} @endif">
                                        <span class="badge bg-danger me-1"></span> {{ $replace->remarks }}
                                    </button>
                                @endif
                            </td>
                            <td>
                                {{ $replace->created_at->diffForHumans() }}
                                <div class="text-muted">{{ $replace->created_at->toDayDateTimeString() }}</div>
                            </td>
                            <td>
                                <div>{{ isset($replace->payment_at)?$replace->payment_at->diffForHumans():'' }}</div>
                                <div
                                    class="text-muted">{{ isset($replace->payment_at)?$replace->payment_at->toDayDateTimeString():'' }}</div>
                            </td>
                            <td>
                                @switch( $replace->status )
                                    @case( 'pending' )
                                        <span class="badge bg-secondary me-1">Pending</span>
                                        @break

                                    @case( 'processing' )
                                        <span class="badge bg-warning me-1">Processing</span>
                                        @break

                                    @case( 'complete' )
                                        <span class="badge bg-info me-1">Complete</span>
                                        @break

                                    @case( 'due' )
                                        <span class="badge bg-danger me-1">Due</span>
                                        @break

                                    @case( 'paid' )
                                        <span class="badge bg-success me-1">Paid</span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('itop-replace.edit', $replace->id) }}" class="btn btn-sm btn-primary {{ $replace->status != 'pending' && auth()->user()->role != 'superadmin' ? 'd-none' : '' }}">Edit</a>

                                @if(auth()->user()->role == 'superadmin')
                                <!-- Delete -->
                                <a href="{{ route('itop-replace.destroy', $replace->id) }}" id="deleteReplace" class="btn btn-sm btn-danger">Delete</a>
                                @endif
                            </td>
                            {{--                            @include('itop-replace.modals.approve')--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            new DataTable('#itopReplaceTbl');

            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Single delete
                $(document).on('click','#deleteReplace',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete This Entry?",
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

                // Delete all
                $(document).on('click','#deleteAllReplace',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete All Entry?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: $(this).attr('href'),
                                type: 'POST',
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
