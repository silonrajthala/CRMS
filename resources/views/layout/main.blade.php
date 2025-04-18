<!DOCTYPE html>
<html lang="en">
 <head>
   @include('layout.partials.head')
 </head>
 <body>
@if(Auth::guard('admin')->check())
@include('layout.partials.header')
@endif
@yield('content')
@if(Auth::guard('admin')->check())
@include('layout.partials.footer')
@endif
@include('layout.partials.footer-scripts')
 </body>
</html>