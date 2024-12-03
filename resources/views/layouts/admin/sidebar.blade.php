<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('admin.index') }}"
                                             aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Dashboard</span></a></li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Users</span></li>

                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('admin.users.index') }}"
                                             aria-expanded="false">
                        <i data-feather="users" class="feather-icon"></i>
                        <span class="hide-menu">Users</span></a>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Tasks</span></li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('admin.tasks.index') }}"
                    aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
   class="hide-menu">{{ __('All Tasks') }}</span></a></li>
                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
