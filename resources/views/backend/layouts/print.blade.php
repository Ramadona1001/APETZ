<!doctype html>
<html lang="en">

@include('backend.components.head')

<body class="bg-white" onload="printPromot()">
    <div class="nk-block">
        @yield('content')
    </div>
</body>

@include('backend.components.scripts')
<script>
function printPromot() {
    window.print();
}
</script>
</html>
