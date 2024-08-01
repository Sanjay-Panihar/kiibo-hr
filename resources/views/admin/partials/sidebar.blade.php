<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between"
      style="background-color: rgb(73 190 255);">
      <a href="./index.html" class="text-nowrap logo-img">
        <img src="{{ asset('../assets/images/logos/dark-logo.svg')}}" width="180" alt="" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('home') }}" aria-expanded="false">
            <span>
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">COMPONENTS</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.event')}}" aria-expanded="false">
            <span>
              <i class="ti ti-article"></i>
            </span>
            <span class="hide-menu">Events</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="javascript:void(0)" aria-expanded="false">
            <span>
              <i class="ti ti-school"></i>
            </span>
            <span class="hide-menu">Learnings</span>
            <span class="chevron">
              <i class="ti ti-chevron-down"></i>
            </span>
          </a>
          <ul class="sidebar-submenu" style="display: none;">
            <li class="sidebar-subitem">
              <a class="sidebar-sublink" href="#submenu1">
                <i class="ti ti-book"></i>
                <span>Courses</span>
              </a>
            </li>
            <li class="sidebar-subitem">
              <a class="sidebar-sublink" href="#submenu2">
                <i class="ti ti-certificate"></i>
                <span>Certificates</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.attendence') }}" aria-expanded="false">
            <span>
              <i class="ti ti-cards"></i>
            </span>
            <span class="hide-menu">Attendence</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin.timesheet') }}" aria-expanded="false">
            <span>
              <i class="ti ti-file-description"></i>
            </span>
            <span class="hide-menu">Timesheet</span>
          </a>
        </li>
        <!-- <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.leave') }}" aria-expanded="false">
            <span>
              <i class="ti ti-typography"></i>
            </span>
            <span class="hide-menu">Leaves</span>
          </a>
        </li> -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="javascript:void(0)" aria-expanded="false">
            <span>
              <i class="ti ti-beach"></i>
            </span>
            <span class="hide-menu">Leaves</span>
            <span class="chevron">
              <i class="ti ti-chevron-down"></i>
            </span>
          </a>
          <ul class="sidebar-submenu" style="display: none;">
            <li class="sidebar-subitem">
              <a class="sidebar-sublink" href="{{ route('admin.leave') }}">
                <i class="ti ti-ambulance"></i>
                <span>Leave Details</span>
              </a>
            </li>
            <li class="sidebar-subitem">
              <a class="sidebar-sublink" href="#submenu1">
                <i class="ti ti-file-plus"></i>
                <span>Apply Leave</span>
              </a>
            </li>
            <li class="sidebar-subitem">
              <a class="sidebar-sublink" href="#submenu2">
                <i class="ti ti-pencil"></i>
                <span>Employee Leave Entry</span>
              </a>
            </li>
            <li class="sidebar-subitem">
              <a class="sidebar-sublink" href="#submenu2">
                <i class="ti ti-eraser"></i>
                <span>Cancel Employee Leave Entry</span>
              </a>
            </li>
            <li class="sidebar-subitem">
              <a class="sidebar-sublink" href="#submenu2">
                <i class="ti ti-report"></i>
                <span>Employee Leave Summary</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.policy')}}" aria-expanded="false">
            <span>
              <i class="ti ti-aperture"></i>
            </span>
            <span class="hide-menu">Policy</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
            <span>
              <i class="ti ti-clipboard-text"></i>
            </span>
            <span class="hide-menu">Approval Report</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.myteam') }}" aria-expanded="false">
            <span>
              <i class="ti ti-user-plus"></i>
            </span>
            <span class="hide-menu">My Team</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.employee-report.index') }}" aria-expanded="false">
            <span>
              <i class="ti ti-mood-happy"></i>
            </span>
            <span class="hide-menu">Employee Report</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
            <span>
              <i class="ti ti-list"></i>
            </span>
            <span class="hide-menu">Holiday List</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
            <span>
              <i class="ti ti-analyze"></i>
            </span>
            <span class="hide-menu">HR Panel</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.settings') }}" aria-expanded="false">
            <span>
              <i class="ti ti-settings"></i>
            </span>
            <span class="hide-menu">Settings</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.help-and-support') }}" aria-expanded="false">
            <span>
              <i class="ti ti-help"></i>
            </span>
            <span class="hide-menu">Help & Support</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
            <span>
              <i class="ti ti-logout"></i>
            </span>
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
          </a>
        </li>
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>