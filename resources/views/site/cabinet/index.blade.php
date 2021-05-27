@extends('layouts.site')

@section('content')
<!-- Breadcrumb Section Begin -->
    @include('site.parts.breadcrumbs')
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
    @if($page == 'profile')
        @include('site.cabinet.my_profile')
    @elseif($page == 'orders')
        @include('site.cabinet.my_orders')
    @endif

<!-- Shoping Cart Section End -->

@endsection

@section('additional_scripts')
<script>
     function readURL(input) {
        if (input.files && input.files[0]) {

            var fileName = input.files[0].name;
            var ext = fileName.split('.').pop();

            var allowed_extensions = ["png", "jpeg", "gif", "bmp"];
            console.log(ext);
            if(allowed_extensions.includes(ext)) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
            else {
                $('#imgtype_error').html('<div class="help-block with-errors">Аватар должен быть изображением!</div>');
                setTimeout(function() {
                    $('#imgtype_error').html('');
                }, 2000);
            }

        }
    }
</script>
@endsection
