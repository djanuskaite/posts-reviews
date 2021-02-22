<!DOCTYPE html>
<html lang="en">

@include('_partials/head')

<body>

<!-- Navigation -->
@include('_partials/nav')


<!-- Main Content -->
<div class="container">
    @yield('content')
</div>

<hr>

<!-- Footer -->
@include('_partials/footer')

<!-- Bootstrap core JavaScript -->
<script src="{{ URL::asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Custom scripts for this template -->
<script src="{{ URL::asset('js/app.js')}}"></script>

</body>

</html>
