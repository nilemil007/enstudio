<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Target</x-slot:title>

    <div class="row">
        <div class="col-md-8">

            <div id="userErrMsg" class="alert alert-danger err-msg d-none"></div>

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create new target</h6>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3">
                @if(session()->has('import_errors'))
                    @foreach(session()->get('import_errors') as $failure)
                        <div class="card-header">
                            <div class="alert alert-danger">
                                <p>Column name: <strong>{{ $failure->values()['dd_code'] .'-'. $failure->values()['rso_number'] }}</strong></p>
                                <p>Error type: <strong>{{ \Illuminate\Support\Str::title($failure->attribute()) }}</strong></p>
                                <p>Error msg: {{ $failure->errors()[0] }} </p>
                                <p>Row number : {{ $failure->row() }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="card-body">
                    <h6 class="card-title">Import KPI Target</h6>
                    <form class="row gy-2 gx-3 align-items-center kpi-target-import" action="{{ route('kpi-target.import') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <label class="visually-hidden" for="autoSizingInput">Name</label>
                            <input name="import_kpi_target" type="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary w-100 mt-2 btn-import">Import KPI Target</button>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ route('kpi-target.sample.file.download') }}" class="nav-link text-muted">Download sample file.</a>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {

                // Import Target
                $(document).on('submit','.kpi-target-import',function (e){
                    e.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function (){
                            $('.btn-import').prop('disabled', true).text('Importing...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');
                        },
                        success: function (response){
                            $('.btn-import').prop('disabled', false).text('Import KPI Target');
                            Swal.fire(
                                'Success!',
                                response.success,
                                'success',
                            ).then((result) => {
                                window.location.href = "{{ route('kpi-target.index') }}";
                            });
                        },
                        error: function (e){
                            console.log(e.responseText);
                            $('.btn-import').prop('disabled', false).text('Import KPI Target');
                        },
                    });
                });
            });
        </script>
    @endpush

</x-app-layout>
