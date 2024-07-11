@extends('layouts.app')

@section('content')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('admin.partials.sidebar')
    <!-- Sidebar End -->
    <!-- Main wrapper -->
    <div class="body-wrapper">
        <!-- Header Start -->
        @include('admin.partials.header')
        <!-- Header End -->
        <div class="container-fluid">
            <!-- Row 1 -->
            <div class="row">
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">Personal Info</a></li>
                        <li><a href="#tabs-2">Experience</a></li>
                    </ul>
                    <div id="tabs-1">
                        <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec
                            sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et
                            lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna
                            quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam
                            nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor
                            nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
                    </div>
                    <div id="tabs-2">
                        <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa
                            metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada,
                            metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem.
                            Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing
                            adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere
                            viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus
                            pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis.
                            Mauris consectetur tortor et purus.</p>
                    </div>
                </div>
                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank"
                            class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a
                            href="https://themewagon.com">ThemeWagon</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(function() {
        $("#tabs").tabs();
    });
</script>
@endsection
