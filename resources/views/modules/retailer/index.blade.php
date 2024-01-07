<x-app-layout>

    <!-- Title -->
    <x-slot:title>All Retailer</x-slot:title>

    @if(session()->has('success'))
        <p class="alert alert-success">{{ session()->get('success') }}</p>
    @endif

    <div class="card">
        <div class="card-header row">
            <div class="col-md-6">
                <h4 class="card-title">All Retailer</h4>
            </div>
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input name="search" type="search" class="form-control" value="{{ request()->get('search') }}" placeholder="Find something...">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                        <a href="{{ route('retailer.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">

            <span class="d-flex align-items-center justify-content-end">
                    @if( auth()->user()->role == 'superadmin' || auth()->user()->role == 'zm' )
                    <a href="{{ route('retailer.export') }}" class="btn btn-sm btn-success">Export</a>
                    <a href="{{ route('retailer.create') }}" class="btn btn-sm btn-primary" style="margin-left: 5px">Add New</a>
                @endif
                @if( auth()->user()->role == 'superadmin' )
                    @if(count($retailers) > 1)
                        <a id="deleteAllRetailer" href="{{ route('retailer.delete.all') }}" class="btn btn-sm btn-danger" style="margin-left: 5px">Delete All</a>
                    @endif
                @endif
            </span>

            <div class="table-responsive">
                <table id="retailerTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3 text-center">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
{{--                        <th>Image</th>--}}
                        <th>DD House</th>
                        <th>Code</th>
                        <th>Itop Number</th>
                        <th>Name</th>
                        <th>Thana</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse( $retailers as $sl => $retailer )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
{{--                            <td class="py-1">--}}
{{--                                @if(!empty($retailer->user->image))--}}
{{--                                    <img src="{{ asset($retailer->user->image) }}" alt="retailer image">--}}
{{--                                @endif--}}
{{--                            </td>--}}
                            <td class="d-flex align-items-center">
                                {{ $retailer->ddHouse->code }}
                                &nbsp;
                                @if($retailer->hca)
                                    <span class="badge bg-info"><strong>{{ \Illuminate\Support\Str::upper($retailer->hca) }}</strong></span>
                                @endif
                            </td>
                            <td>{{ $retailer->code }}</td>
                            <td>{{ $retailer->itop_number }}</td>
                            <td>{{ $retailer->name }}</td>
                            <td>{{ $retailer->thana }}</td>
                            <td class="text-start">
                                {{ \Illuminate\Support\Str::words( $retailer->address, 3 ) }}
                            </td>
                            <td>
                                @switch( $retailer->status )
                                    @case(1)
                                        <p class="text-success" style="font-weight: bold">Active</p>
                                        @break

                                    @case(0)
                                        <p class="text-danger" style="font-weight: bold">Inactive</p>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('retailer.edit', $retailer->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                @if( auth()->user()->role == 'superadmin' )
                                <!-- Delete -->
                                <a href="{{ route('retailer.destroy', $retailer->id) }}" id="deleteRetailer" class="btn btn-sm btn-danger">Delete</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="9">No retailer found.</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $retailers->links('pagination::bootstrap-5') }}
        </div>
    </div>

    @push('scripts')
        <script>
            // new DataTable('#retailerTbl');

            $(document).ready(function(){
                // Single delete
                $(document).on('click','#deleteRetailer',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete This Retailer?",
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

                // Delete all
                $(document).on('click','#deleteAllRetailer',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete All Retailer?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it !'
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
