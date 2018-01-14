<!DOCTYPE html>
<html>
@include('admin.partials.head')
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        @include('admin.partials.header')

        @include('admin.partials.sidebar')

        <div class="content-wrapper">

            @yield('content')

        </div>
        @include('admin.partials.footer')
    </div>

    @include('admin.partials.scripts')
</body>
</html>
