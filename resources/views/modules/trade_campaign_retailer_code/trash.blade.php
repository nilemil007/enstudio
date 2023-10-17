<x-app-layout>

    <!-- Title -->
    <x-slot:title>Trash TCRC</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title mb-0">Trash TCRC</h4>
                <span>
                    <a href="{{ route('tcrc.index') }}" class="btn btn-sm btn-primary">All TCRC</a>
                    @if($trashed->count() > 1)
                        <a href="{{ route('tcrc.permanently.delete') }}" class="btn btn-sm btn-danger">Delete All Permanently</a>
                    @endif
                </span>
            </div>
            <div class="table-responsive">
                <table id="tcrcTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-center text-nowrap mt-3 mb-3">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>DD Code</th>
                        <th>Retailer Code</th>
                        <th>Flag</th>
                        <th>Remarks</th>
                        <th>Created At</th>
                        <th>Deleted At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $trashed as $sl => $tc )
                        <tr>
                            <td>{{ ++$sl }}</td>
                            <td>
                                {{ App\Models\DdHouse::firstWhere('id', App\Models\Retailer::firstWhere('code', $tc->retailer_code)->dd_house_id)->code }}
                            </td>
                            <td>
                                {{ $tc->retailer_code }}
                            </td>
                            <td>{{ Str::upper($tc->flag) }}</td>
                            <td>{{ $tc->remarks }}</td>
                            <td>
                                {{ $tc->created_at->diffForHumans() }}
                                <div class="text-muted">{{ $tc->created_at->toDayDateTimeString() }}</div>
                            </td>
                            <td>
                                {{ !empty($tc->deleted_at) ? $tc->deleted_at->diffForHumans() : null }}
                                <div class="text-muted">{{ !empty($tc->deleted_at) ? $tc->deleted_at->toDayDateTimeString() : null }}</div>
                            </td>
                            <td>
                                <!-- Restore -->
                                <a href="{{ route('tcrc.restore', $tc->id) }}" class="btn btn-sm btn-primary">Restore</a>

                                <!-- Permanently Delete -->
                                <a href="{{ route('tcrc.permanently.delete', $tc->id) }}" id="permanentlyDeleteTcrc" class="btn btn-sm btn-danger">Delete Permanently</a>

                                {{-- <form style="margin-left: 5px;" action="{{ route('tcrc.permanently.delete', $tc->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Are you sure you want to delete this record?');" type="submit" class="btn btn-sm btn-danger">Delete Permanently</button>
                                </form> --}}
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
        new DataTable('#tcrcTbl');

        $(document).ready(function(){

            // Permanently delete
            $(document).on('click','#permanentlyDeleteTcrc',function(e){
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Record Permanently?",
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
