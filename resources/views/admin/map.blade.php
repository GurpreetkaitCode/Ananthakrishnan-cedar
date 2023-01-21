@extends('layout.admin.app')
@section('title', 'Map')
@section('pagename', 'Map')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
            </div>
            <div id="errorsign" class="alert-box"></div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="justify-content: center;">
                <div class="mapimage">
                    <img src="{{asset('static/'.$map[0]->map)}}" alt="" />
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
@endsection
@push('styles')
<style>
    .mapimage {
        height: 800px;
        width: 800px;
    }

    .mapimage img {
        height: 100%;
        width: 100%;
    }
</style>
@endpush