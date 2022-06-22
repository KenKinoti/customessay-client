<aside class="left-sidebar bg-primary">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-link text-white mt-3">
                        <i class="ti ti-home"></i>
                        @lang('nav.sidebar.dashboard')
                    </a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Orders</span></li>
                <li class="sidebar-item">
                    <a href="{{ route('orders.pending') }}" class="sidebar-link text-white">
                        <i class="ti ti-timer"></i>
                        @lang('nav.sidebar.orders.pending')
                        @if($pendingCount)
                            <span class="counter badge badge-warning badge-counter mx-4">{{ $pendingCount }}</span>
                        @endif
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('orders.assigned') }}" class="sidebar-link text-white">
                        <i class="ti ti-hand-point-right"></i>
                        @lang('nav.sidebar.orders.assigned')
                        @if($assignedCount)
                            <span class="counter badge badge-warning badge-counter mx-4">{{ $assignedCount }}</span>
                        @endif
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('orders.submitted') }}" class="sidebar-link text-white">
                        <i class="ti ti-check"></i>
                        @lang('nav.sidebar.orders.submitted')
                        @if($submittedCount)
                            <span class="counter badge badge-warning badge-counter mx-4">{{ $submittedCount }}</span>
                        @endif
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('orders.reviewed') }}" class="sidebar-link text-white">
                        <i class="ti ti-pencil-alt"></i>
                        @lang('nav.sidebar.orders.revisions')
                        @if($revisionsCount)
                            <span class="counter badge badge-warning badge-counter mx-4">{{ $revisionsCount }}</span>
                        @endif
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('orders.disputed') }}" class="sidebar-link text-white">
                        <i class="ti ti-alert"></i>
                        @lang('nav.sidebar.orders.disputes')
                        @if($disputesCount)
                            <span class="counter badge badge-warning badge-counter mx-4">{{ $disputesCount }}</span>
                        @endif
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('orders.archived') }}" class="sidebar-link text-white">
                        <i class="ti ti-files"></i>
                        {{ __('archived') }}
                        @if($archievedCount)
                          <span class="badge badge-warning badge-counter">{{ $archievedCount }}</span>
                           @endif</a>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
