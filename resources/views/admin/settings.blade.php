@extends('layout.admin.app')
@section('title', 'Settings')
@section('pagename', 'Settings')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="card-title">Admin Settings</div>
                </div>
            </div>
            <div id="errorsign" class="alert-box"></div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="" novalidate method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                @csrf
                                                <div class="col-lg-12">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        placeholder="Enter name" value="{{Auth::user()->username}}">
                                                    <input type="hidden" name="id" value="{{Auth::id()}}">
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="Enter email" value="{{Auth::user()->email}}">
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="text" class="form-control" id="password"
                                                        name="password" placeholder="Enter new password">

                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="map_image" class="form-label">Map Image</label>
                                                    <input type="file" class="form-control"
                                                        value="{{$settings[0]->map ?? ''}}" id="map_image"
                                                        name="map_image" />
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="calender" class="form-lable">Calender Iframe</label>
                                                    <textarea class="form-control" id="calender" name="calender"
                                                        placeholder="Paste calender iframe">{{$settings[0]->calender ?? ''}}</textarea>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="check_in" class="form-lable">Default Check In
                                                        Time</label>
                                                    <input type="time" class="form-control w-25" id="check_in"
                                                        name="check_in_time" value="{{$settings[0]->check_in_time ?? '00:00'}}" step="3600" placeholder="Enter new check in time">
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="check_out" class="form-lable">Default Check Out
                                                        Time</label>
                                                        <input type="time" class="form-control w-25" id="check_out"
                                                        name="check_out_time" value="{{$settings[0]->check_out_time?? '00:00'}}" step="3600" placeholder="Enter new check in time">
                                                </div>
                                                <div class="col-lg-12 mt-3">
                                                    <button class="btn btn-warning">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection