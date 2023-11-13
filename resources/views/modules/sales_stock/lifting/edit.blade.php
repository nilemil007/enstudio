<x-app-layout>

    <!-- Title -->
    <x-slot:title>Lifting Update</x-slot:title>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Lifting Update</h6>
            <form id="cmUpdateForm" action="{{ route('lifting.update', 1) }}" method="POST">
                @csrf
                @method('PATCH')



                <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Save Changes</button>
                <a href="{{ route('lifting.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
            </form>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {
                // Dependent dropdown [DD House => supervisor, user]
                $(document).on('change','#dd_house_id',function (){
                    const houseId = $(this).val();

                    if (houseId === '')
                    {
                        $('#set_user').html('<option value="">-- Select User --</option>');
                    }

                    // Get supervisor and user by dd house
                    $.ajax({
                        url: "{{ route('lifting.get.users') }}/" + houseId,
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: function (){
                            $('#loading').show();
                            $('#set_user').find('option:not(:first)').remove();
                        },
                        complete: () => {
                            $('#loading').hide();
                        },
                        success: function (response){
                            $.each(response.users, function (key, value){
                                $('#set_user').append('<option value="'+ value.id +'">' + value.name + '</option>')
                            });
                        }
                    });
                });
            });
        </script>
    @endpush

</x-app-layout>
