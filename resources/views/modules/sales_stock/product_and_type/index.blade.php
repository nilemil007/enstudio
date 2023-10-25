<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create Product And Type</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Product And Type</h4>
                <span>
                    <a href="{{ route('productType.create') }}" class="btn btn-sm btn-primary">Add New</a>
{{--                    @if(count($productTypes) > 1)--}}
{{--                        <a id="deleteAllSupervisor" href="{{ route('supervisor.delete.all') }}" class="btn btn-sm btn-danger">Delete all</a>--}}
{{--                    @endif--}}
                </span>
            </div>
            <div class="table-responsive">
                <table id="productTypeTbl" class="table table-sm table-bordered table-hover table-vcenter text-nowrap mt-3 mb-3 text-center">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>product type</th>
                            <th>product</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $productTypes as $sl => $data )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
{{--                            <td>{{ $cm->ddHouse->code }}</td>--}}
{{--                            <td>{{ $cm->name }}</td>--}}
{{--                            <td>{{ $cm->pool_number }}</td>--}}
{{--                            <td>--}}
{{--                                <!-- Edit -->--}}
{{--                                <a href="{{ route('productType.edit', $cm->id) }}" class="btn btn-sm btn-primary">Edit</a>--}}

{{--                                <!-- Move to trash -->--}}
{{--                                <a href="{{ route('productType.destroy', $cm->id) }}" id="deleteProductType" class="btn btn-sm btn-danger">Delete</a>--}}
{{--                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            new DataTable('#productTypeTbl');

            $(document).ready(function(){

                // Single delete
                $(document).on('click','#deleteProductType',function(e){
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
