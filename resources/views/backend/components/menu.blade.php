<div class="nk-sidebar-element nk-sidebar-head">
    <div class="nk-menu-trigger">
        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
    </div>
    <div class="nk-sidebar-brand">
        <a href="{{ route('home') }}" class="logo-link nk-sidebar-logo">
            <img class="logo-light logo-img" src="{{URL::asset('/')}}{{setPublic()}}uploads/backend/settings/{{ main_settings()['logo'] }}" srcset="{{URL::asset('/')}}{{setPublic()}}uploads/backend/settings/{{ main_settings()['logo'] }} 2x" alt="logo">
            <img class="logo-dark logo-img" src="{{URL::asset('/')}}{{setPublic()}}uploads/backend/settings/{{ main_settings()['logo'] }}" srcset="{{URL::asset('/')}}{{setPublic()}}uploads/backend/settings/{{ main_settings()['logo'] }} 2x" alt="logo-dark">
        </a>
        <span class="menu-logo-text">
            {{ main_settings()['title'] }}
        </span>
    </div>
</div>

<div class="nk-sidebar-element nk-sidebar-body">
    <div class="nk-sidebar-content">
        <div class="nk-sidebar-menu" data-simplebar>
            <ul class="nk-menu">
                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">{{ transWord('Home') }}</h6>
                </li>
                <!-- .nk-menu-item -->
                <li class="nk-menu-item">
                    <a href="{{ route('home') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-home"></em></span>
                        <span class="nk-menu-text">{{ transWord('Home') }}</span>
                    </a>
                </li>

                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">{{ transWord('Authentication') }}</h6>
                </li>
                <!-- .nk-menu-heading -->
                @can('show_roles')
                <li class="nk-menu-item">
                    <a href="{{ route('roles') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-lock-alt-fill"></em></span>
                        <span class="nk-menu-text">{{ transWord('Roles & Permissions') }}</span>
                    </a>
                </li>
                @endcan

                <!-- .nk-menu-item -->
                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                        <span class="nk-menu-text">{{ transWord('Accounts') }}</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @can('create_users')
                        <li class="nk-menu-item">
                            <a href="{{ route('create_users') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('New Account') }}</span></a>
                        </li>
                        @endcan

                        @can('show_users')
                        <li class="nk-menu-item">
                            <a href="{{ route('users') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('All Accounts') }}</span></a>
                        </li>
                        @endcan
                    </ul>

                </li>

                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-user-add"></em></span>
                        <span class="nk-menu-text">{{ transWord('User Follow') }}</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @can('show_user_follows')
                        <li class="nk-menu-item">
                            <a href="{{ route('user_follows') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('Follow & Following') }}</span></a>
                        </li>
                        @endcan
                    </ul>
                </li>

                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-note-add-fill"></em></span>
                        <span class="nk-menu-text">{{ transWord('User Stories') }}</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @can('create_user_stories')
                        <li class="nk-menu-item">
                            <a href="{{ route('create_stories') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('New Story') }}</span></a>
                        </li>
                        @endcan
                        @can('show_user_stories')
                        <li class="nk-menu-item">
                            <a href="{{ route('user_stories') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('User Stories') }}</span></a>
                        </li>
                        @endcan
                    </ul>
                </li>

                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-file-text"></em></span>
                        <span class="nk-menu-text">{{ transWord('Posts') }}</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @can('create_blogs')
                        <li class="nk-menu-item">
                            <a href="{{ route('create_blogs') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('New Post') }}</span></a>
                        </li>
                        @endcan
                        @can('show_blogs')
                        <li class="nk-menu-item">
                            <a href="{{ route('blogs') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('All Posts') }}</span></a>
                        </li>
                        @endcan
                    </ul>

                </li>

                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-chat-circle-fill"></em></span>
                        <span class="nk-menu-text">{{ transWord('Chat') }}</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @can('my_chats')
                        <li class="nk-menu-item">
                            <a href="{{ route('my_chats') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('My Chats') }}</span></a>
                        </li>
                        @endcan
                        @can('show_chats')
                        <li class="nk-menu-item">
                            <a href="{{ route('chats') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('All Chats') }}</span></a>
                        </li>
                        @endcan
                    </ul>

                </li>

                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-b-uc"></em></span>
                        <span class="nk-menu-text">{{ transWord('Pets') }}</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @can('create_pets')
                        <li class="nk-menu-item">
                            <a href="{{ route('create_pets') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('New Pet') }}</span></a>
                        </li>
                        @endcan

                        @can('show_pets')
                        <li class="nk-menu-item">
                            <a href="{{ route('pets') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('All Pets') }}</span></a>
                        </li>
                        @endcan
                    </ul>

                </li>

                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                        <span class="nk-menu-text">{{ transWord('Products') }}</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @can('create_products')
                        <li class="nk-menu-item">
                            <a href="{{ route('create_products') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('New Product') }}</span></a>
                        </li>
                        @endcan

                        @can('show_products')
                        <li class="nk-menu-item">
                            <a href="{{ route('products') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('All Products') }}</span></a>
                        </li>
                        @endcan
                    </ul>

                </li>

                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-file-docs"></em></span>
                        <span class="nk-menu-text">{{ transWord('Orders') }}</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @can('create_orders')
                        <li class="nk-menu-item">
                            <a href="{{ route('create_orders') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('New Order') }}</span></a>
                        </li>
                        @endcan

                        @can('show_orders')
                        <li class="nk-menu-item">
                            <a href="{{ route('orders') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('All Orders') }}</span></a>
                        </li>
                        @endcan
                    </ul>

                </li>

                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-file-plus"></em></span>
                        <span class="nk-menu-text">{{ transWord('Pages') }}</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @can('create_pages')
                        <li class="nk-menu-item">
                            <a href="{{ route('create_pages') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('New Page') }}</span></a>
                        </li>
                        @endcan
                        @can('show_pages')
                        <li class="nk-menu-item">
                            <a href="{{ route('pages') }}" class="nk-menu-link"><span class="nk-menu-text">{{ transWord('All Pages') }}</span></a>
                        </li>
                        @endcan
                    </ul>

                </li>


                <li class="nk-menu-item">
                    @can('show_settings')
                    <a href="{{ route('mainsettings') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-setting-alt"></em></span>
                        <span class="nk-menu-text">{{ transWord('Main Settings') }}</span>
                    </a>
                    @endcan
                </li>

            </ul>
            <!-- .nk-menu -->
        </div>
        <!-- .nk-sidebar-menu -->
    </div>
    <!-- .nk-sidebar-content -->
</div>
