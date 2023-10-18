<x-app-layout>

    <!-- Title -->
    <x-slot:title>Trash BP</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title mb-0">Trash BP</h4>
                <span>
                    <a href="{{ route('bp.index') }}" class="btn btn-sm btn-primary">ALL BP</a>
                    @if($trashed->count() > 1)
                        <a href="{{ route('bp.delete.all') }}" class="btn btn-sm btn-danger">Delete All Permanently</a>
                    @endif
                </span>
            </div>
            <div class="table-responsive">
                <table id="bpTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3 text-center">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>DD House</th>
                        <th>BP Name</th>
                        <th>Pool Number</th>
                        <th>Joining Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $trashed as $sl => $bp )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $bp->ddHouse->code }}</td>
                            <td>{{ empty($bp->user->name) ? null : $bp->user->name }}</td>
                            <td>{{ $bp->pool_number }}</td>
                            <td>{{ empty($bp->joining_date) ? null : $bp->joining_date->toFormattedDateString() }}</td>
                            <td>
                                @switch( $bp->status )
                                    @case(1)
                                    <p class="text-success">Active</p>
                                    @break

                                    @case(0)
                                    <p class="text-danger">Inactive</p>
                                    @break
                                @endswitch
                            </td>
                            <td class="d-flex align-items-center">
                                <!-- Restore -->
                                <a href="{{ route('bp.restore', $bp->id) }}" class="btn btn-sm btn-primary">Restore</a>

                                <!-- Permanently Delete -->
{{--                                <form style="margin-left: 5px;" action="{{ route('bp.permanently.delete', $bp->id) }}" method="POST">--}}
{{--                                    @csrf @method('DELETE')--}}
{{--                                    <button onclick="return confirm('Are you sure you want to permanently delete this BP?');" type="submit" class="btn btn-sm btn-danger">Delete Permanently</button>--}}
{{--                                </form>--}}

                                <a href="{{ route('bp.permanently.delete', $bp->id) }}" id="permanentlyDeleteBp" class="btn btn-sm btn-danger">Delete Permanently</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $trashed->links('pagination::bootstrap-5') }}
        </div>
    </div>

    @push('scripts')
        <script>
            new DataTable('#bpTbl');

            $(document).ready(function(){

                // Permanently delete
                $(document).on('click','#permanentlyDeleteBp',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete This BP Permanently?",
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
                // $(document).on('click','#deleteAllBp',function(e){
                //     e.preventDefault();
                //
                //     Swal.fire({
                //         title: 'Are you sure?',
                //         text: "Delete All Bp?",
                //         icon: 'warning',
                //         showCancelButton: true,
                //         confirmButtonText: 'Yes, delete it !'
                //     }).then((result) => {
                //         if (result.isConfirmed) {
                //             $.ajax({
                //                 url: $(this).attr('href'),
                //                 type: 'POST',
                //                 success: function (response){
                //                     Swal.fire(
                //                         'Deleted!',
                //                         response.success,
                //                         'success',
                //                     ).then((result) => {
                //                         location.reload();
                //                     });
                //                 },
                //             });
                //         }
                //     });
                // });
            });
        </script>
    @endpush

</x-app-layout>
