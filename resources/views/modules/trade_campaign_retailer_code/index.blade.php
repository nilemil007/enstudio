<x-app-layout>

    <!-- Title -->
    <x-slot:title>Trade Campaign Retailer Code</x-slot:title>

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
                <h4 class="card-title">Trade Campaign Retailer Code(s)</h4>
                <span>
                    <a href="{{ route('tcrc.create') }}" class="btn btn-sm btn-primary">Add new</a>
                    @if(count($tcrc) > 1)
                        <a id="deleteAllTcrc" href="{{ route('tcrc.delete.all') }}" class="btn btn-sm btn-danger">Delete all</a>
                    @endif
                </span>
            </div>
            <div class="table-responsive">
                <table id="tcrcTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>DD Code</th>
                        <th>Retailer Code</th>
                        <th>Flag</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $tcrc as $sl => $tc )
                        <tr>
                            <td>{{ ++$sl }}</td>
                            <td>{{ $tc->retailer->dd_house }}</td>
                            <td>
                                {{ $tc->retailer->code }}
                                <div class="text-muted">{{ $tc->retailer->itop_number }}</div>
                            </td>
                            <td>{{ $tc->flag }}</td>
                            <td>{{ $tc->status }}</td>
                            <td>
                                {{ $tc->created_at->diffForHumans() }}
                                <div class="text-muted">{{ $tc->created_at->toDayDateTimeString() }}</div>
                            </td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('tcrc.edit', $tc->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Delete -->
                                <a href="{{ route('tcrc.destroy', $tc->id) }}" id="deleteTcrc" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            new DataTable('#tcrcTbl');

            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Single delete
                $(document).on('click','#deleteTcrc',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete This TCRC?",
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
                $(document).on('click','#deleteAllTcrc',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete All TCRC?",
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
