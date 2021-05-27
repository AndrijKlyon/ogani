<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('admin.home') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="{{ url('/admin/mail/messages?filter[folder]=inbox') }}">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">{{ $new_messages }}</span>
            </a>
          </li>
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="{{ route('admincomments.index') }}" >
              <i class="fa fa-comment-o"></i>
              <span class="label label-warning">{{ $new_comments }}</span>
            </a>
          </li>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="{{ route('orders.index') }}" >
              <i class="fa fa-opencart"></i>
              <span class="label label-danger">{{ $new_orders }}</span>
            </a>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="@if(Auth::user()['img'] != null)
                  {{ asset('/') . Auth::user()['img'] }}
                @else
                  {{ 'https://www.gravatar.com/avatar/' . md5(Auth::user()['email']) . 'jpg?d=mm&s=70' }}
                @endif"
            class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()['name'] }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="
                  @if(Auth::user()['img'] != null)
                    {{ asset('/') . Auth::user()['img'] }}
                  @else
                    {{ 'https://www.gravatar.com/avatar/' . md5(Auth::user()['email']) . 'jpg?d=mm&s=70' }}
                  @endif
                " class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()['name'] }} - {{ Auth::user()['role'] }}
                  <small>Зарегистрирован: {{ Auth::user()['created_at']->format('d.m.Y') }} </small>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('users.show', ['user' => Auth::user()['id'] ]) }}" class="btn btn-default btn-flat">Профиль</a>
                </div>
                <div class="pull-right">
                  <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-default btn-flat">Выход</button>
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
