@extends('layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome back!</h4>
                    <span class="ml-1">{{ __('SMS Categories') }}</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Categories</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-md-12">
             <form action="#" class="form-material">
                 @csrf
                   <div class="form-group row form-default">
                     <div class="col-md-6">
                       <input type="password" name="current_password" class="form-control" required="">
                       <span class="form-bar"></span>
                       <label class="float-label">Old Password</label>
                     </div>
                     <div class="col-md-6">
                       <input type="password" name="new_password" class="form-control" required="">
                       <span class="form-bar"></span>
                       <label class="float-label">New Password</label>
                     </div>
                   </div>
                   <div class="form-group row form-default">
                     <div class="col-md-6">
                       <input type="password" name="new_confirm_password" class="form-control" required="">
                       <span class="form-bar"></span>
                       <label class="float-label">Confirm New Password</label>
                     </div>
                   </div>
                   <div class="form-group">
                     <button type="submit" id='submit' class="btn btn-primary">Update Password</button>
                   </div>
             </form>
            </div>
             <!-- /# column -->
         </div>
    </div>
</div>
@endsection
