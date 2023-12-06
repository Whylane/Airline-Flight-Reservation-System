<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   @include('layouts.inc.head')
</head>

<body>

    <div class="container-fluid position-relative d-flex p-0">
        @include('layouts.inc.sidebar')
         <!-- Content Start -->
        <div class="content">
            @include('layouts.inc.navbar')
            @section('content')
            @show
            @include('layouts.inc.adminfooter')
        </div>
        <!-- Content End -->
    </div>  
    @include('layouts.inc.adminscript')
    @stack('custom-scripts')
</body>
</html>