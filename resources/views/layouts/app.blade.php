<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="ENStudio Responsive Admin Dashboard based on Bootstrap 5">
    <meta name="author" content="ENStudio">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="enstudio, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>{{ !isset($title) ? config('app.name') : $title .' : : '. config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ url('public/assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{ url('public/assets/css/jquery.tagsinput.min.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.min.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ url('public/assets/images/favicon.png') }}" />

    <style>
        .swal2-popup {
            font-size: .875rem !important;
        }

        label.error{
            color: red;
        }
        input.error, textarea.error, select.error{
            border: 1px solid red;
        }
        #liftingCopyIcon{
            display: none;
            cursor: pointer;
        }
        .liftingCard:hover #liftingCopyIcon{
            display: block;
        }
        /*input.valid, textarea.valid{*/
        /*    border: 1px solid limegreen;*/
        /*}*/
    </style>
</head>
<body>
<div class="main-wrapper">

    <!-- partial:_sidebar -->
    @include('layouts.partials.sidebar')

    <div class="page-wrapper">

        <!-- partial:_navbar -->
        @include('layouts.partials.navbar')

        <!-- partial:_content -->
        <div class="page-content">

            <!-- Sessions notifications -->
            @switch(session())
                @case('success')
                    <p>{{ session()->get('success') }}</p>
                @break

                @case('warning')
                    <p>{{ session()->get('warning') }}</p>
                @break

                @case('danger')
                    <p>{{ session()->get('danger') }}</p>
                @break

                @case('info')
                    <p>{{ session()->get('info') }}</p>
                @break

                @default

            @endswitch

            {{ $slot }}
        </div>

        <!-- partial:_footer -->
        @include('layouts.partials.footer')

    </div>
</div>

<!-- core:js -->
<script src="{{ url('public/assets/vendors/core/core.js') }}"></script>
<!-- endinject -->

<!-- inject:js -->
<script src="{{ url('public/assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ url('public/assets/js/template.js') }}"></script>
<!-- endinject -->

<!-- datatable:js -->
<script src="{{ url('public/assets/js/dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<!-- enddatatable -->

<!-- flatpickr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
<!-- endflatpickr -->

<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- endselect2 -->

<!-- jQuery Tags Input Plugin -->
<script src="{{ url('public/assets/js/jquery.tagsinput.min.js') }}"></script>
<!-- End jQuery Tags Input Plugin -->

<!-- jquery.validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
<!-- endjquery.validate -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom js for this page -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function (){
        // Select 2
        $(document).on("select2:open", () => {
            document.querySelector(".select2-container--open .select2-search__field").focus()
        })

        $('.select-2').select2();
        $('#tags').tagsInput({
            // 'width': '100%',
            'height': '100%',
            'interactive': true,
            'defaultText': 'Add More',
            'removeWithBackspace': true,
            'minChars': 0,
            'maxChars': 200,
            'placeholderColor': '#666666'
        });

        // Date Pickr
        $(".flatpickr").flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });

        // DataTable
        $('table').removeClass('dataTable');
    });
</script>

@stack('scripts')

@include('sweetalert::alert')
<!-- End custom js for this page -->
</body>
</html>
