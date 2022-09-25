<!doctype html>
<html lang="en">

@include('backend.components.head')

<body class="nk-body dark-mode npc-general has-sidebar" theme="dark" style="overflow-x: hidden;">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                @include('backend.components.menu')
            </div>
            <div class="nk-wrap ">
                @include('backend.components.topnav')

                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">@yield('title')</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>
                                                    {{ transWord('Welcome') }}
                                                    {{ transWord('To') }}
                                                    {{ main_settings()['title'] }}
                                                    {{ transWord('Dashboard') }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    @yield('dashboardbtn')
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="nk-block">
                                    <div class="row g-gs">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @include('backend.components.footer')
            </div>
        </div>
    </div>
    @include('backend.components.scripts')
</body>
</html>
