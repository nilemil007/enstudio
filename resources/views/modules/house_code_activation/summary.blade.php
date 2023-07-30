<x-app-layout>

    <!-- Title -->
    <x-slot:title>HCA Summary</x-slot:title>

    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title mb-0">Select Date Range</h4>
        </div>
        <div class="card-body">
            <form class="mb-3">
                <div class="row">
                    <div class="col-md-5">
                        <div class="input-group">
                            <input name="start_date" id="start_date" value="{{ request()->get('start_date') }}" type="text" class="flatpickr form-control" placeholder="Start Date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                <i data-feather="calendar"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input name="end_date" id="end_date" value="{{ request()->get('end_date') }}" type="text" class="flatpickr form-control" placeholder="End Date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                <i data-feather="calendar"></i>
                            </span>
                        </div>
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(!empty($hca))
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">House Code Activation Summary</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3 text-center">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>DD House</th>
                            <th>Name</th>
                            <th>Retailer Code</th>
                            <th>Activation</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($hca as $result)
                        <tr>
                            <td>{{ $result->dd_house }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    @push('scripts')
        <script>
            // new DataTable('#hcaTbl');

            // $(document).ready(function(){
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //
            //     // Single delete
            //     $(document).on('click','#deleteHca',function(e){
            //         e.preventDefault();
            //
            //         Swal.fire({
            //             title: 'Are you sure?',
            //             text: "Delete This Record?",
            //             icon: 'warning',
            //             showCancelButton: true,
            //             confirmButtonText: 'Yes, delete it!'
            //         }).then((result) => {
            //             if (result.isConfirmed) {
            //                 $.ajax({
            //                     url: $(this).attr('href'),
            //                     type: 'DELETE',
            //                     success: function (response){
            //                         Swal.fire(
            //                             'Deleted!',
            //                             response.success,
            //                             'success',
            //                         ).then((result) => {
            //                             location.reload();
            //                         });
            //                     },
            //                 });
            //             }
            //         });
            //     });
            //
            //     // Delete all
            //     $(document).on('click','#deleteAllHca',function(e){
            //         e.preventDefault();
            //
            //         Swal.fire({
            //             title: 'Are you sure?',
            //             text: "Delete All Record?",
            //             icon: 'warning',
            //             showCancelButton: true,
            //             confirmButtonText: 'Yes, delete it !'
            //         }).then((result) => {
            //             if (result.isConfirmed) {
            //                 $.ajax({
            //                     url: $(this).attr('href'),
            //                     type: 'POST',
            //                     success: function (response){
            //                         Swal.fire(
            //                             'Deleted!',
            //                             response.success,
            //                             'success',
            //                         ).then((result) => {
            //                             location.reload();
            //                         });
            //                     },
            //                 });
            //             }
            //         });
            //     });
            // });
        </script>
    @endpush
</x-app-layout>
