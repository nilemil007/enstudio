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
                <div class="d-flex align-items-center">
                    <h4 class="card-title mb-0">Trade Campaign Retailer Code(s)</h4>
                    @if(count($trashed) > 0)
                        <a href="{{ route('tcrc.trash') }}" class="text-danger" style="font-weight:bold;margin-left: 5px;">Trash ({{ $trashed->count() }})</a>
                    @endif
                </div>
                <span>
                    <a href="{{ route('tcrc.create') }}" class="btn btn-sm btn-primary">Add New</a>
                </span>
            </div>
            <div class="table-responsive">
                <table id="tcrcTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-center text-nowrap mt-3 mb-3">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>DD Code</th>
                        <th>Retailer Code</th>
                        <th>Name</th>
                        <th>Flag</th>
                        <th>Remarks</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $tcrc as $sl => $tc )
                        <tr>
                            <td>{{ ++$sl }}</td>
                            <td>{{ App\Models\DdHouse::firstWhere('id', App\Models\Retailer::firstWhere('code', $tc->retailer_code)->dd_house_id)->code }}</td>
                            <td>{{ $tc->retailer_code }}</td>
                            <td>{{ $tc->user->name }}</td>
                            <td>{{ Str::upper($tc->flag) }}</td>
                            <td>{{ $tc->remarks }}</td>
                            <td>
                                {{ $tc->created_at->diffForHumans() }}
                                <div class="text-muted">{{ $tc->created_at->toDayDateTimeString() }}</div>
                            </td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('tcrc.edit', $tc->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Move to trash -->
                                <a href="{{ route('tcrc.destroy', $tc->id) }}" id="deleteTcrc" class="btn btn-sm btn-danger">Delete</a>
                                {{-- <form style="margin-left: 5px;" action="{{ route('tcrc.destroy', $tc->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Are you sure you want to delete this user?');" type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form> --}}
                            </td>

                            {{-- <td>
                                <!-- Edit -->
                                <a href="{{ route('tcrc.edit', $tc->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Delete -->
                                <a href="{{ route('tcrc.destroy', $tc->id) }}" id="deleteTcrc" class="btn btn-sm btn-danger">Delete</a>
                            </td> --}}
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
            });
        </script>
    @endpush

</x-app-layout>
