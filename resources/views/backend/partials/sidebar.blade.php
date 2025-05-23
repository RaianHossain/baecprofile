@php
    $currentRoute = request()->route()->getName();
    $navItems = [
        'dashboard' => [
            'route' => 'admin.dashboard',
            'icon' => 'icon-home4',
            'title' => 'Dashboard'
        ],
        'institutes' => [
            'route' => 'admin.institutes',
            'icon' => 'icon-office',
            'title' => 'Institutes'
        ],
        'divisions' => [
            'route' => 'admin.divisions',
            'icon' => 'icon-menu',
            'title' => 'Divisions',
        ],
        'designations' => [
            'route' => 'admin.designations',
            'icon' => 'icon-tree5',
            'title' => 'Designations',
        ]
        // 'settings' => [
        //     'icon' => 'icon-cog',
        //     'title' => 'Settings',
        //     'children' => [
        //         [
        //             'route' => 'admin.settings.general',
        //             'title' => 'General Settings'
        //         ],
        //         [
        //             'route' => 'admin.settings.email',
        //             'title' => 'Email Settings'
        //         ]
        //     ]
        // ]
    ];
@endphp

<style>
    .menu-arrow {
        font-size: 12px;
        margin-left: auto;
        padding-left: 12px;
        color: rgba(0,0,0,0.5);
        transition: transform 0.2s ease;
    }

    .menu-arrow.rotate-180 {
        transform: rotate(180deg);
        color: inherit;
    }

    .nav-group-sub {
        overflow: hidden;
        transition: height 0.3s ease;
    }

    .icon-16px {
        font-size: 16px;
        width: 16px;
        height: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .nav-link.active .menu-arrow {
        color: inherit;
    }
</style>

<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">Navigation</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="sidebar-user-material-body">
                <div class="card-body text-center">
                    <a href="#">
                        <img src="{{ asset('assets/backend/global_assets/images/placeholders/placeholder.jpg') }}" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
                    </a>
                    <h6 class="mb-0 text-white text-shadow-dark">{{ auth()->user()->name }}</h6>
                    <span class="font-size-sm text-white text-shadow-dark">{{ auth()->user()->email }}</span>
                </div>
                                            
                <div class="sidebar-user-material-footer">
                    <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>My account</span></a>
                </div>
            </div>

            <div class="collapse" id="user-nav">
                <ul class="nav nav-sidebar">
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-user-plus"></i>
                            <span>My profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-coins"></i>
                            <span>My balance</span>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-comment-discussion"></i>
                            <span>Messages</span>
                            <span class="badge bg-teal-400 badge-pill align-self-center ml-auto">58</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-cog5"></i>
                            <span>Account settings</span>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="icon-switch2"></i>
                            <span>Logout</span>
                        </a>
                    
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    
                    
                </ul>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                @foreach($navItems as $key => $item)
                    @php
                        $isActive = str_starts_with($currentRoute, 'admin.'.$key);
                        $hasActiveChild = isset($item['children']) && 
                                        collect($item['children'])->contains(function($child) use ($currentRoute) {
                                            return $currentRoute === $child['route'];
                                        });
                        $isExpanded = $isActive || $hasActiveChild;
                    @endphp
                    
                    <li class="nav-item {{ $isExpanded ? 'nav-item-open nav-item-expanded' : '' }}">
                        <a href="{{ isset($item['route']) ? route($item['route']) : 'javascript:void(0)' }}" 
                        class="nav-link d-flex align-items-center {{ $isActive ? 'active' : '' }}">
                            <i class="{{ $item['icon'] }} icon-16px mr-2"></i>
                            <span class="flex-grow-1">{{ $item['title'] }}</span>
                            @if(isset($item['children']))
                                <i class="menu-arrow icon-arrow-down8 ml-auto {{ $isExpanded ? 'rotate-180' : '' }}"></i>
                            @endif
                        </a>
                        
                        @if(isset($item['children']))
                            <ul class="nav nav-group-sub" style="{{ $isExpanded ? 'display: block;' : 'display: none;' }}">
                                @foreach($item['children'] as $child)
                                    <li class="nav-item">
                                        <a href="{{ route($child['route']) }}" 
                                        class="nav-link {{ $currentRoute === $child['route'] ? 'active' : '' }}">
                                            {{ $child['title'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->
</div>

