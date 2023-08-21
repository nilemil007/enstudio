<x-app-layout>

    <!-- Title -->
    <x-slot:title>Activation</x-slot:title>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Activation Import</h4>
            <span>
                <div class="input-group">
                    <form class="import-core-activation" action="{{ route('core.activation.import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input name="core_activation_import" type="file" class="form-control form-control-sm" id="coreActivationImport" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        <button class="btn btn-sm btn-primary" type="submit" id="coreActivationImport">Import</button>
                    </form>
                </div>
                {{-- @if(count($rsos) > 1)
                    <a id="deleteAllRso" href="{{ route('rso.delete.all') }}" class="btn btn-sm btn-danger">Delete All</a>
                @endif --}}
            </span>
        </div>
        <div class="card-body">
            <div class=" mb-3">
            </div>
            <div class="table-responsive">
                <table id="coreActivationTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3 text-center">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>activaton date</th>
                        <th>distributor code</th>
                        <th>distributor name</th>
                        <th>retailer code</th>
                        <th>retailer name</th>
                        <th>bts code</th>
                        <th>thana</th>
                        <th>promotion</th>
                        <th>product code</th>
                        <th>product name</th>
                        <th>sim no</th>
                        <th>msisdn</th>
                        <th>selling price</th>
                        <th>bio date</th>
                        <th>bp flag</th>
                        <th>bp number</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- @foreach( $rsos as $sl => $rso )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $rso->dd_house }}</td>
                            <td>{{ $rso->supervisor }}</td>
                            <td>{{ $rso->rso_code }}</td>
                            <td>{{ $rso->itop_number }}</td>
                            <td>{{ optional($rso->user)->name }}</td>
                            <td>{{ $rso->pool_number }}</td>
                            <td>{{ $rso->joining_date->toFormattedDateString() }}</td>
                            <td>
                                @switch( $rso->status )
                                    @case(1)
                                        <p class="text-success">Active</p>
                                    @break

                                    @case(0)
                                        <p class="text-danger">Inactive</p>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('rso.edit', $rso->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Delete -->
                                <a href="{{ route('rso.destroy', $rso->id) }}" id="deleteRso" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            new DataTable('#coreActivationTbl');

            $(document).ready(function(){
                // Import Activation
                $(document).on('submit','.import-core-activation',function (e){
                    e.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function (){
                            $('.btn-import-rso').prop('disabled', true).text('Importing...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');
                        },
                        success: function (response){
                            $('.btn-import-rso').prop('disabled', false).text('Import Rso');
                            Swal.fire(
                                'Success!',
                                response.success,
                                'success',
                            ).then((result) => {
                                window.location.href = "{{ route('rso.index') }}";
                            });
                        },
                        error: function (e){
                            const err = JSON.parse(e.responseText);

                            $.each(err.errors,function (key,value){
                                $('.err-msg').removeClass('d-none').append('<li>' + value + '</li>');
                            });

                            $('.btn-import-rso').prop('disabled', false).text('Import Rso');
                        },
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
