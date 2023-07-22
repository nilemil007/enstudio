<x-app-layout>

    <!-- Title -->
    <x-slot:title>Itop Replace</x-slot:title>

    <form class="mb-3 d-flex justify-content-center">
        <div class="row">
            <div class="col-md-5">
                <div class="input-group flatpickr me-2 mb-2 mb-md-0" id="dashboardDate">
                    <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-calendar text-primary"><rect x="3" y="4" width="18" height="18"
                                                                                 rx="2" ry="2"></rect><line x1="16"
                                                                                                            y1="2"
                                                                                                            x2="16"
                                                                                                            y2="6"></line><line
                                x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21"
                                                                         y2="10"></line></svg></span>
                    <input name="start_date" value="{{ request()->get('start_date') }}" type="text"
                           class="form-control bg-transparent border-primary flatpickr-input" placeholder="Select date">
                </div>
            </div>
            <div class="col-md-5">
                <div class="input-group flatpickr me-2 mb-2 mb-md-0" id="dashboardDate">
                    <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-calendar text-primary"><rect x="3" y="4" width="18" height="18"
                                                                                 rx="2" ry="2"></rect><line x1="16"
                                                                                                            y1="2"
                                                                                                            x2="16"
                                                                                                            y2="6"></line><line
                                x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21"
                                                                         y2="10"></line></svg></span>
                    <input name="end_date" value="{{ request()->get('end_date') }}" type="text"
                           class="form-control bg-transparent border-primary flatpickr-input" placeholder="Select date"
                           data-input="" readonly="readonly">
                </div>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Itop Replacement List</h4>
                <span>
                    <a href="{{ route('itop-replace.create') }}" class="btn btn-sm btn-primary">Add new</a>
                    @if(count($replaces) > 1)
                        <a id="deleteAllReplace" href="{{ route('itop-replace.delete.all') }}" class="btn btn-sm btn-danger">Delete all</a>
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
{{--                        <th>Payment Date</th>--}}
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $replaces as $sl => $replace )
                        <tr {{ $replace->remarks ? 'class=bg-danger-lt' : '' }}>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $replace->user->name }}</td>
                            <td>{{ $replace->itop_number }}</td>
                            <td>{{ $replace->serial_number }}</td>
                            <td>
                                @if( $replace->remarks )
                                    <button
                                        class="btn btn-sm btn-pill {{ auth()->user()->role != 'super-admin' ? 'disabled' : '' }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="@if(auth()->user()->role == 'super-admin') #approve-reject-{{ $replace->id }} @endif">
                                        <span class="badge bg-danger me-1"></span> {{ $replace->remarks }}
                                    </button>
                                @endif
                            </td>
                            <td>
                                {{ $replace->created_at->diffForHumans() }}
                                <div class="text-muted">{{ $replace->created_at->toDayDateTimeString() }}</div>
                            </td>
{{--                            <td>--}}
{{--                                <div>{{ isset($replace->payment_at)?$replace->payment_at->diffForHumans():'' }}</div>--}}
{{--                                <div--}}
{{--                                    class="text-muted">{{ isset($replace->payment_at)?$replace->payment_at->toDayDateTimeString():'' }}</div>--}}
{{--                            </td>--}}
                            <td>
                                @switch( $replace->status )
                                    @case( 'pending' )
                                        <span class="badge bg-warning-lt me-1"></span> Pending
                                        @break

                                    @case( 'processing' )
                                        <span class="badge bg-warning me-1"></span> Processing
                                        @break

                                    @case( 'complete' )
                                        <span class="badge bg-blue me-1"></span> Complete
                                        @break

                                    @case( 'due' )
                                        <span class="badge bg-danger me-1"></span> Due
                                        @break

                                    @case( 'paid' )
                                        <span class="badge bg-success me-1"></span> Paid
                                        @break
                                @endswitch
                            </td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('itop-replace.edit', $replace->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Delete -->
                                <a href="{{ route('itop-replace.destroy', $replace->id) }}" id="deleteReplace" class="btn btn-sm btn-danger">Delete</a>
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
