<x-app-layout>

    <!-- Title -->
    <x-slot:title>Trash CM</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <h4 class="card-title mb-0">Trash CM</h4>
                    <a href="{{ route('cm.permanently.delete.all') }}" id="permanentlyDeleteAllCm" class="text-secondary" style="font-weight: bold;">
                        <span style="margin: 0px 10px 0px 10px">|</span> Empty Trash Now ({{ $trashed->count() }})
                    </a>
                </div>
                <span>
                    <a href="{{ route('cm.index') }}" class="btn btn-sm btn-primary">ALL CM</a>
                </span>
            </div>
            <div class="table-responsive">
                <table id="cmTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3 text-center">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>dd house</th>
                            <th>cm name</th>
                            <th>pool number</th>
                            <th>joining date</th>
                            <th>documents</th>
                            <th>status</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $trashed as $sl => $cm )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $cm->ddHouse->code }}</td>
                            <td>{{ $cm->name }}</td>
                            <td>{{ $cm->pool_number }}</td>
                            <td>{{ empty($cm->joining_date) ? null : $cm->joining_date->toFormattedDateString() }}</td>
                            <td>
                                @if($cm->documents)
                                    <span style="font-weight: bold" class="text-success">Submitted</span>
                                @else
                                    <span style="font-weight: bold" class="text-danger">Not Submitted</span>
                                @endif
                            </td>
                            <td>
                                @switch( $cm->status )
                                    @case(1)
                                    <p style="font-weight: bold" class="text-success">Active</p>
                                    @break

                                    @case(0)
                                    <p style="font-weight: bold" class="text-danger">Inactive</p>
                                    @break
                                @endswitch
                            </td>
                            <td>
                                <!-- Restore -->
                                <a href="{{ route('cm.restore', $cm->id) }}" class="btn btn-sm btn-primary">Restore</a>

                                <!-- Permanently Delete -->
                                <a href="{{ route('cm.permanently.delete', $cm->id) }}" id="permanentlyDeleteCm" class="btn btn-sm btn-danger">Delete Permanently</a>
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
            new DataTable('#cmTbl');

            $(document).ready(function(){

                // Permanently delete
                $(document).on('click','#permanentlyDeleteCm',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete This CM Permanently?",
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

                // Permanently Delete All
                $(document).on('click','#permanentlyDeleteAllCm',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Permanently Delete All CM?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it !'
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
