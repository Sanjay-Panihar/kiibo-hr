@extends('layouts.app')

@section('title', 'Help And Support')

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
                        <h3>Help And Support</h3>
                    </div>
                </div>
            </div>
            <div class="content-box">
                <div class="content active">
                    <div class="row">
                        <div class="col-md-12 mb-5 text-center">
                        <i class="ti ti-headphones" style="font-size: 48px;"></i>
                        <h2>How can we help you?</h2>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4 text-center">
                            <i class="ti ti-mail" style="font-size: 48px;"></i>
                                <h5>
                                    HR related queries
                                </h5>
                            </div>
                            <div class="col-md-4 text-center">
                            <i class="ti ti-mail" style="font-size: 48px;"></i>
                                   <h5>
                                   IT related queries
                                   </h5>
                            </div>
                            <div class="col-md-4 text-center">
                            <i class="ti ti-mail" style="font-size: 48px;"></i>
                                   <h5>
                                   Admin related queries
                                   </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.partials.footer')
    </div>
</div>
@endsection
