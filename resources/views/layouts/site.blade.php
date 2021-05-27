<!DOCTYPE html>
<html lang="ru">

@include('site.parts.head')

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
        @include('site.parts.mobilemenu')
    <!-- Humberger End -->

    <!-- Header Section Begin -->
        @include('site.parts.header')
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
        @include('site.parts.herosection')
    <!-- Hero Section End -->

        @yield('content')

    <!-- Footer Section Begin -->
        @include('site.parts.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('js/basetemplate.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    @yield('additional_scripts')

    @include('site.parts.modal')

</body>

</html>
