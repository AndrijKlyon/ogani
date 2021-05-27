<!DOCTYPE html>

<html>
    @include('admin.parts.head')

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
        <!-- Main Header -->
            @include('admin.parts.header')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

            <!-- search form (Optional) -->
                @include('admin.parts.side_search')
            <!-- /.search form -->

            <!-- Sidebar Menu -->
                @include('admin.parts.side_menu')
            <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(Session::has('message'))

                @if(is_array(Session::get('message')))
                    <ul class="alert {{ Session::get('alert-class', 'alert-info') }}">
                        @foreach(Session::get('message') as $item)
                            <li class="px-2">
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>

                @else
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                        {{ Session::get('message') }}
                    </p>
                @endif

            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')

        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
            <b>&copy; KA Studio AdminPanel </b> v2.0.3
            </div>
            <!-- Default to the left -->
            <strong>&copy; {{ now()->year }} <a href="{{ route('home') }}"> {{ config('template_settings.site.title') }}</a>.</strong> Все права защищены.
        </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->
        <script>
        var admindir = homedir + '/admin/';
        </script>
        <script src="{{ asset('js/admin.js') }}"></script>
        <script src="{{ asset('js/custom_admin.js') }}"></script>
        @yield('additional_scripts')

        <!-- Modal - danger-delete -->
            @include('admin.parts.modal')
        <!-- / Modal - danger-delete  -->

    </body>
</html>
