<header class="main-header">
  <!-- Logo -->
  <a href="/home" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b><i class="fa fa-globe"></i></b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">
        <b>LARAVEL BL<i class="fa fa-globe"></i>G</b>
    </span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            @if(!auth()->user()->avatar)
                <img class="user-image" src="/admin/images/default/default-user.png"
                    alt="User profile picture">
            @else
                <img class="user-image" src="/storage/images/profile/{{auth()->user()->avatar}}"
                    alt="User Image">
            @endif
            <span class="hidden-xs">{{ auth()->user()->name }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
                @if(!auth()->user()->avatar)
                    <img class="profile-user-img img-responsive img-circle"
                        src="/admin/images/default/default-user.png"
                        alt="User profile picture">
                @else
                    <img class="profile-user-img img-responsive img-circle"
                        src="/storage/images/profile/{{auth()->user()->avatar}}"
                        alt="User profile picture">
                @endif

              <p>
                {{ auth()->user()->name }}
                <small>{{ auth()->user()->email }}</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="/profile" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();"
                     class="btn btn-default btn-flat">Sign out</a>
                 <form id="logout-form" action="{{ route('logout') }}"
                    method="POST" style="display: none;">
                     {{ csrf_field() }}
                 </form>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
