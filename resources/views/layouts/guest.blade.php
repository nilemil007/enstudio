<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="ENStudio Responsive Admin Dashboard based on Bootstrap 5">
    <meta name="author" content="ENStudio">
    <meta name="keywords" content="enstudio, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>{{ !isset($title) ? config('app.name') : $title .' : : '. config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ url('public/assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.min.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ url('public/assets/images/favicon.png') }}" />

{{--    <style>--}}
{{--        .error{--}}
{{--            color: red;--}}
{{--        }--}}
{{--    </style>--}}
</head>
<body>
<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">
            {{ $slot }}
        </div>
    </div>
</div>

<!-- core:js -->
<script src="{{ url('public/assets/vendors/core/core.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{ url('public/assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ url('public/assets/js/template.js') }}"></script>
<!-- endinject -->

<!-- jquery.validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- endjquery.validate -->

<!-- Custom js for this page -->
@stack('scripts')
<!-- End custom js for this page -->

</body>
</html>
