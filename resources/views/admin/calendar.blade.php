@extends('layout.admin.app')
@section('title', 'Calender')
@section('pagename', 'Calender')
@section('content')
<div class="content-wrapper">
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
                    {!! $calender[0]->calender !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection