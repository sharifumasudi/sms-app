@extends('layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>{{ __('SMS') }}</h4>
                    <span class="ml-1">{{ __('SMS Sent') }}</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('SMS SENT') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->


        @livewire('s-m-s.list-of-sent-message-component')
    </div>
</div>
@endsection
