<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Postal Service</title>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('public/assets/dashboard/css/pages/login/classic/login-4.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('public/assets/dashboard/plugins/global/plugins.bundle.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/dashboard/plugins/custom/prismjs/prismjs.bundle.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/dashboard/css/style.bundle.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/css/custom-style.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset('public/assets/dashboard/css/themes/layout/header/base/light.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/dashboard/css/themes/layout/header/menu/light.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/dashboard/css/themes/layout/brand/dark.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/dashboard/css/themes/layout/aside/dark.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset('assets/dashboard/media/logos/favicon.ico') }}" />

</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
@yield('content')
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('public/assets/dashboard/plugins/global/plugins.bundle.js?v=7.2.3') }}"></script>
<script src="{{ asset('public/assets/dashboard/plugins/custom/prismjs/prismjs.bundle.js?v=7.2.3') }}"></script>
<script src="{{ asset('public/assets/dashboard/js/scripts.bundle.js?v=7.2.3') }}"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('public/assets/dashboard/js/pages/custom/login/login-general.js?v=7.2.3') }}"></script>
<!--end::Page Scripts-->
<script src="{{ asset('public/assets/js/vendors.js') }}" ></script>
<script src="{{ asset('public/assets/js/aiz-core.js') }}" ></script>
</body>
<!--end::Body-->
</html>
