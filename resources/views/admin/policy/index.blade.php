@extends('layouts.app')

@section('title', 'Policy')

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
                        <h3>Policy</h3>
                    </div>
                </div>
            </div>
            <div class="content-box">
                <div class="content active">
                    <div class="row">
                        <div class="row mt-5">
                            <div class="col-md-6 text-center">
                                <div class="border border-secondary">
                                    <i class="ti ti-brand-pocket" style="font-size: 48px;"></i>
                                    <h5>
                                        Policies
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="border border-secondary">
                                    <i class="ti ti-clipboard" style="font-size: 48px;"></i>
                                    <h5>
                                        Agreements and other documents
                                    </h5>
                                </div>
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