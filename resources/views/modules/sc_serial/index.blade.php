<x-app-layout>

    <!-- Title -->
    <x-slot:title>SC Serial</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">SC Serial</h4>
                <span>
                    <a href="{{ route('sc-serial.create') }}" class="btn btn-sm btn-primary">Add New</a>
                    @if(count($scSerials) > 1)
                        <a id="deleteAllScSerial" href="{{ route('sc-serial.delete.all') }}" class="btn btn-sm btn-danger">Delete All</a>
                    @endif
                </span>
            </div>
            <div class="table-responsive">
                <table id="scSerialTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3 text-center">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>DD House</th>
                            <th>Product Name</th>
                            <th>Serial</th>
                            <th>Group</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $scSerials as $sl => $serial )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $serial->ddHouse->code }}</td>
                            <td>{{ $serial->product_name }}</td>
                            <td>{{ $serial->serial }}</td>
                            <td>{{ $serial->group }}</td>
                            <td>
                                @switch( $serial->status )
                                    @case(1)
                                    <p class="text-success">Active</p>
                                    @break

                                    @case(0)
                                    <p class="text-danger">Expired</p>
                                    @break
                                @endswitch
                            </td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('sc-serial.edit', $serial->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Delete -->
                                <a href="{{ route('sc-serial.destroy', $serial->id) }}" id="deleteScSerial" class="btn btn-sm btn-danger">Delete</a>
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
            new DataTable('#scSerialTbl');

            $(document).ready(function(){
                // Single delete
                $(document).on('click','#deleteScSerial',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete This Serial?",
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
                $(document).on('click','#deleteAllScSerial',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete All Serial?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!'
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
