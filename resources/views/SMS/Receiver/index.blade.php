@extends('layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>{{ __('Registereg Receivers') }}</h4>
                    <span class="ml-1">{{ __('SMS Receiver') }}</span> <br>
                    <a href="{{ route('phone_to_excel') }}" class="btn btn-info"><i class="fa fa-download mr-2"></i>{{ __('Export To Excel') }}</a>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('Receivers') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        @livewire('s-m-s.receiver-list-component')
    </div>
</div>
@endsection
