<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.inc.fronthead')
</head>
  <body>

    @include('layouts.inc.frontnav')
        <div class="content">
            @yield('content')
        </div>

    @include('layouts.inc.frontscript')
    @stack('custom-scripts')

    @include('layouts.inc.footer')
    
        @yield('footer')

</body>
</html>