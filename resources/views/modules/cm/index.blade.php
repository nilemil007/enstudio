<x-app-layout>

    <!-- Title -->
    <x-slot:title>All CM</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <h4 class="card-title mb-0">all cm ({{ $cms->count() }})</h4>
                    @if(count($trashed) > 0)
                       <a href="{{ route('cm.trash') }}" class="text-danger" style="font-weight: bold;"><span style="margin: 0px 10px 0px 10px">|</span> Trash ({{ $trashed->count() }})</a>
                    @endif
                </div>
                <span>
                    <a href="{{ route('cm.create') }}" class="btn btn-sm btn-primary">Add New</a>
                </span>
            </div>
            <div class="table-responsive">
                <table id="cmTbl" class="table table-sm table-bordered table-hover table-vcenter text-nowrap mt-3 mb-3 text-center">
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
                    @foreach( $cms as $sl => $cm )
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
                                <!-- Edit -->
                                <a href="{{ route('cm.edit', $cm->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Move to trash -->
                                <a href="{{ route('cm.destroy', $cm->id) }}" id="deleteCm" class="btn btn-sm btn-danger">Delete</a>
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
            new DataTable('#cmTbl');

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
                                success: (response) => {
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
