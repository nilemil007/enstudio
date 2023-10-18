<x-app-layout>

    <!-- Title -->
    <x-slot:title>All Bp</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <h4 class="card-title mb-0">all bp ({{ $bps->count() }})</h4>
                    @if(count($trashed) > 0)
                       <span style="margin: 0px 10px 0px 10px">|</span> <a href="{{ route('bp.trash') }}" class="text-danger" style="font-weight: bold;">Trash ({{ $trashed->count() }})</a>
                    @endif
                </div>
                <span>
                    <a href="{{ route('bp.create') }}" class="btn btn-sm btn-primary">Add New</a>
                </span>
            </div>
            <div class="table-responsive">
                <table id="bpTbl" class="table table-sm table-bordered table-hover table-vcenter text-nowrap mt-3 mb-3 text-center">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>DD House</th>
                        <th>BP Name</th>
                        <th>Pool Number</th>
                        <th>Joining Date</th>
                        <th>Documents</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $bps as $sl => $bp )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $bp->ddHouse->code }}</td>
                            <td>{{ empty($bp->user->name) ? null : $bp->user->name }}</td>
                            <td>{{ $bp->pool_number }}</td>
                            <td>{{ empty($bp->joining_date) ? null : $bp->joining_date->toFormattedDateString() }}</td>
                            <td>
                                @if($bp->documents)
                                    <span style="font-weight: bold" class="text-success">Submitted</span>
                                @else
                                    <span style="font-weight: bold" class="text-danger">Not Submitted</span>
                                @endif
                            </td>
                            <td>
                                @switch( $bp->status )
                                    @case(1)
                                        <p style="font-weight: bold" class="text-success">Active</p>
                                    @break

                                    @case(0)
                                        <p style="font-weight: bold" class="text-danger">Inactive</p>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('bp.edit', $bp->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Move to trash -->
                                <a href="{{ route('bp.destroy', $bp->id) }}" id="deleteBp" class="btn btn-sm btn-danger">Delete</a>
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
            new DataTable('#bpTbl');

            $(document).ready(function(){

                // Single delete
                $(document).on('click','#deleteBp',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete This Bp?",
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
                $(document).on('click','#deleteAllBp',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete All Bp?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it !'
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
