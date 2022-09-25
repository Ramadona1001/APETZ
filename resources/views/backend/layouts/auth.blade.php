<!doctype html>
<html lang="en">

@include('backend.components.head')

<body class="nk-body dark-mode npc-general has-sidebar" theme="dark">
    <div class="nk-app-root">
        <div class="nk-main ">
            @yield('content')
        </div>
    </div>
    @include('backend.components.head')
</body>
</html>
