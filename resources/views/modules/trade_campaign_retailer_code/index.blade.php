<x-app-layout>

    <!-- Title -->
    <x-slot:title>Trade Campaign Retailer Code</x-slot:title>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h4 class="card-title mb-0">Trade Campaign Retailer Code(s)</h4>
                @if(count($trashed) > 0)
                    <a href="{{ route('tcrc.trash') }}" class="text-danger" style="font-weight:bold;margin-left: 5px;">Trash ({{ $trashed->count() }})</a>
                @endif
            </div>

            <form>
                <div class="input-group">
                    <input name="search" type="search" class="form-control" value="{{ request()->get('search') }}" placeholder="Find something...">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                    <a href="{{ route('tcrc.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-end">
                <a href="{{ route('tcrc.create') }}" class="btn btn-sm btn-primary">Add New</a>
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
                        <th>Last Update</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $tcrc as $sl => $tc )
                        <tr>
                            <td>{{ ++$sl }}</td>
                            <td>{{ App\Models\DdHouse::firstWhere('id', App\Models\Retailer::firstWhere('code', $tc->retailer_code)->dd_house_id)->code }}</td>
                            <td>{{ $tc->retailer_code }}</td>
                            <td>
                                {{ $tc->user->name }}
                                <div class="text-muted">
                                    {{ optional(\App\Models\Rso::firstWhere('user_id', $tc->user->id))->itop_number }}
                                    {{ optional(\App\Models\Bp::firstWhere('user_id', $tc->user->id))->pool_number }}
                                    {{ optional(\App\Models\Cm::firstWhere('user_id', $tc->user->id))->pool_number }}
                                </div>
                            </td>
                            <td>{{ Str::upper($tc->flag) }}</td>
                            <td>{{ $tc->remarks }}</td>
                            <td>
                                {{ $tc->created_at->diffForHumans() }}
                                <div class="text-muted">{{ $tc->created_at->toDayDateTimeString() }}</div>
                            </td>
                            <td>
                                {{ $tc->updated_at->diffForHumans() }}
                                <div class="text-muted">{{ $tc->updated_at->toDayDateTimeString() }}</div>
                            </td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('tcrc.edit', $tc->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Move to trash -->
                                <a href="{{ route('tcrc.destroy', $tc->id) }}" id="deleteTcrc" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $tcrc->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <a href="{{ route('tcrc.valid.in.current.month') }}" id="validInCurrentMonth" class="nav-link mt-2 text-success" style="font-weight: bold">Valid this month as well.</a>

    @push('scripts')
        <script>

            $(document).ready(function(){

                // Valid In Current Month
                $(document).on('click','#validInCurrentMonth',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "All codes will be valid this month as well?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, do it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: $(this).attr('href'),
                                type: 'GET',
                                beforeSend: () => {
                                    $('#loading').show();
                                },
                                complete: () => {
                                    $('#loading').hide();
                                },
                                success: function (response){
                                    Swal.fire(
                                        'Validated!',
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
