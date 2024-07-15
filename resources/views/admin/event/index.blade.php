@extends('layouts.app')

@section('title', 'Events')

@section('content')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('admin.partials.sidebar')
    <div class="body-wrapper">
        @include('admin.partials.header')
        <div class="container-fluid">
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <h3>Events</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-primary"><i class="ti ti-plus"></i> Add Event</button>
                    </div>
                </div>
            </div>
            <div class="tab-container">
                <div class="tab-box">
                    <button class="tab-btn active">Events/Webinar</button>
                    <button class="tab-btn">Announcements</button>
                    <button class="tab-btn">Draft</button>
                </div>
                <div class="content-box">
                    <div class="content active">
                    <x-table id="event-table" :columns="['id', 'name', 'start_date', 'end_date','time', 'announcements', 'total_likes', 'total_views','status', 'created_by']" ajaxUrl="{{ route('admin.event') }}" />
                    </div>
                    <div class="content">
                    <div class="row mb-3">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.partials.footer')
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.tab-btn');
        const contents = document.querySelectorAll('.content');

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                contents.forEach(c => c.classList.remove('active'));
                contents[index].classList.add('active');
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#skills, #hobbies").select2({
            placeholder: "Select",
            allowClear: true,
        });
    });
</script>
@endsection