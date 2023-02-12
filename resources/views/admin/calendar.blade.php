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
                    @if(is_array($calender) &&  $calender)
                    @if(array_key_exists(0,$calender))
                            {!! $calender[0]->calender !!}
                    @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
