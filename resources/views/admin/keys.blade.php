@extends('layout.admin.app')
@section('title', 'Keys')
@section('pagename','Keys Managmenet')
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
        <div class="container">
            <main role="main" class="pb-3">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="text-uppercase text-center">Klevio Key Management</h5>
                            </div>
                            <p style="color: red;"></p>
                            <p style="color: red;"></p>
                            <p style="color: red;"></p>

                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="" style="width: 100%;">
                                            <div class="card">
                                                <div class="searchfilters" id="searchfilters">
                                                    <div class="filtname" data-translate="Filters">
                                                        Date
                                                    </div>
                                                    <input type="number" id="year1" class="filterbox" min="1900"
                                                        max="2040" step="1" value="{{$year !== null ? $year : 2023}}" />

                                                    <select class="filterbox" id="month1">
                                                        <option value="1" {{$month==0 ? 'selected' : '' }}>--Select--
                                                        </option>
                                                        <option value="1" {{$month==1 ? 'selected' : '' }}>January 
                                                        </option>
                                                        <option value="2" {{$month==2 ? 'selected' : '' }}>
                                                            February</option>
                                                        <option value="3" {{$month==3 ? 'selected' : '' }}>March
                                                        </option>
                                                        <option value="4" {{$month==4 ? 'selected' : '' }}>April
                                                        </option>
                                                        <option value="5" {{$month==5 ? 'selected' : '' }}>May
                                                        </option>
                                                        <option value="6" {{$month==6 ? 'selected' : '' }}>June
                                                        </option>
                                                        <option value="7" {{$month==7 ? 'selected' : '' }}>July
                                                        </option>
                                                        <option value="8" {{$month==8 ? 'selected' : '' }}>August
                                                        </option>
                                                        <option value="9" {{$month==9 ? 'selected' : '' }}>
                                                            September</option>
                                                        <option value="10" {{$month==10 ? 'selected' : '' }}>
                                                            October</option>
                                                        <option value="11" {{$month==11 ? 'selected' : '' }}>
                                                            November</option>
                                                        <option value="12" {{$month==12 ? 'selected' : '' }}>
                                                            December</option>
                                                    </select>
                                                    <div class="righthead">
                                                        <button class="filterbut" data-translate="Search"
                                                            onclick="searchTeam(event)">
                                                            Generate
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body table-responsive p-0" id="tableMain">
                                                    <div>
                                                        <table class="table table-striped table-valign-middle"
                                                            id="tablemainundefined">
                                                            <thead>
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Guest Name</th>
                                                                    <th>Email</th>
                                                                    <th>Check In Date</th>
                                                                    <th>Check Out Date</th>
                                                                    <th>Unit</th>
                                                                    <th>Klevio Key</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if($records)
                                                                @foreach($records as $record)
                                                                <tr>
                                                                    <td>{{$record->id}}</td>
                                                                    <td>{{$record->guest_first_name}}
                                                                        {{$record->guest_last_name}}</td>
                                                                    <td>{{$record->email}}</td>
                                                                    <td>{{date('d',strtotime($record->check_in))}}
                                                                    </td>
                                                                    <td>{{date('d',strtotime($record->check_out))}}
                                                                    </td>
                                                                    <td>{{$record->unit_no}}</td>
                                                                    <td>
                                                                        <button  data-disable="{{route('kleviodisable',$record->id)}}" data-kleviokey="{{$record->klevio_key}}" data-enable="{{route('klevio',$record->id)}}" class="btn btn-primary kleviokeybtn tag-{{$record->id}}"
                                                                            data-id="{{$record->id}}"> @if($record->klevio_key == 1 ) Disable Key @else Enable Key @endif</button>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                @else
                                                                <tr>
                                                                    <td colspan="7" class="text-center">No data
                                                                        available</td>
                                                                </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="timeeditableModal" tabindex="-1"
                                            aria-labelledby="timeeditableModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="timeeditableModalLabel">Edit Keys Data
                                                        </h1>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form novalidate action="{{route('updateKeys')}}" method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="checkin">Check In Time</label>
                                                                <input type="time" class="time form-control" id="checkin"
                                                                    name="check_in_time" aria-required="false">
                                                                <input type="hidden" id="recordId" name="id">
                                                            </div>
                                                            <div class="form-group">
                                              {{-- <label for="checkout">Check Out Time</label> --}}
                                                                <input type="time" class="time form-control" id="checkout"
                                                                    name="check_out_time" aria-required="false">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btnclose btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    id="updateKeys">Update
                                                                    changes</button>
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
            </main>
        </div>
    </div>
</div>
@endsection
@push('styles')
<style>
    .flex {
        margin-bottom: 10px;
    }

    canvas {
        justify-content: center;
        margin: auto;
        margin-bottom: 40px;
        margin-top: 40px;
    }

    .mr-10 {
        margin-right: 10px;
    }

    .filterbox1 {
        border-radius: 3px;
        padding: 5px;
        border: 1px solid palevioletred;
        width: 100%;
    }

    #errorsign,
    .error {
        /* display: none; */
        text-align: center;
        position: absolute;
        right: 0;
        z-index: 200;

        border-radius: 8px;
        margin-right: 10px;
        transition: 0.5s;
        width: 0px;
    }

    .next-prev {
        margin-bottom: 20px;
    }

    .next-previn {
        display: flex;
        text-align: center;
        justify-content: center;
    }

    .prev {
        color: blue;
        cursor: pointer;
        margin-right: 10px;
    }

    .next {
        color: blue;
        cursor: pointer;
        margin-left: 10px;
    }

    .page-no {}

    .cap-in {
        /* margin-left: 10px; */
        margin-bottom: 10px;
    }

    .righthead {
        margin-left: auto;
        display: flex;
    }

    .headcreate {
        font-size: 14px;
        color: #0000ff;
        margin-right: 15px;
        cursor: pointer;
    }

    .headsearch {
        font-size: 15px;
        display: flex;
        align-items: center;
        margin-top: 3px;
        margin-right: 10px;
        cursor: pointer;
    }

    .searchfilters {
        transition: 0.3s;
        display: flex;
        overflow-y: hidden;
        background-color: rgba(0, 0, 0, 0.05);
        border: 0 solid rgba(0, 0, 0, 0.125);
        align-items: center;
        padding: 0 10px;
    }

    .filterbut {
        width: 100px;
        height: 35px;
        margin-left: auto;
        color: #fff;
        background-color: #337ab7;
        border: 1px solid #2e6da4;
    }

    .clearbut {
        width: 100px;
        height: 35px;
        margin-right: auto;
        color: #333;
        background-color: #fff;
        border: 1px solid #ccc;
        margin-right: 10px;
    }

    .filtname {
        text-transform: uppercase;
        font-weight: 600;
        margin-right: 10px;
    }

    .filterbox {
        border-radius: 3px;
        /* border: none; */
        padding: 5px;
        border: 1px solid palevioletred;
        min-width: 100px;
        max-width: 137px;
        margin-right: 10px;
    }

    .align-center {
        margin: 10px;
        text-align: center;
    }

    /*  */
</style>
@endpush
@push('scripts')
<script>
    $('.editModal').on('click', function () {
        $('#timeeditableModal').modal('show');
        let checkin = $(this).attr('data-checkin');
        let checkout = $(this).attr('data-checkout');
        let id = $(this).attr('data-id');
        $('#checkin').val(checkin);
        $('#checkout').val(checkout);
        $('#recordId').val(id);
    });
    $('.btnclose').on('click', function () {
        $('#timeeditableModal').modal('hide');
    });
    function searchTeam(event) {
    event.preventDefault();
    var year = document.getElementById("year1").value;
    var month = document.getElementById("month1").value;
    if (
      year == "" ||
      year == " " ||
      month == "" ||
      month == " "
    ) {
      toastr.error("Enter all required fields.");
      return;
    } else {
      window.location.replace(
        "{{route('keys')}}/?year=" +
          year +
          "&month=" +
          month
      );
    }
  }

  function getParam(param) {
    return new URLSearchParams(window.location.search).get(param);
  }

//   function enableKey(id){
//       $.ajax({
//       type: "POST",
//       url: "{{route('klevio')}}",
//       data: {
//         id: id,
//         sessionId:sessionId
//       },
//       success: function (data) {
//         if (data.hasOwnProperty("error")) {
//           toastr.clear();
//           toastr.error(data["error"]);
//         } else {
//           toastr.clear();
//           console.log(data);
//           toastr.success("Key enabled successfully.");
//           setTimeout(function () {
//             window.location.reload();
//           }, 2000);
//         }
//       },
//       error: function (data) {
//         console.log("Error!");
//       },
//     });
    
//   }
$(document).ajaxStart(function () {
        $('#preloader').show();
    }).ajaxStop(function () {
        $('#preloader').hide();
    });
$('.kleviokeybtn').on('click',function(){
    var id = $(this).attr('data-id');
    let kleviokey = $(this).attr('data-kleviokey');
    let url;
    let setText;
    let keyint = 0;
    if(kleviokey == '1'){
      url = $(this).attr('data-disable');
    setText = 'Disable Key';
    keyint = 0;
    }else{
         url = $(this).attr('data-enable');
            keyint = 1;
         setText = 'Enable Key';
    }
    $.ajax({
      type: "get",
      method: "get",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      url: url,
      data: {
        id: id,
      },
      success: function (data) {
        data = JSON.parse(data);
        if(data.error == true){
            toastr.error(data.message,'Error');
        }else{
            toastr.clear();
            toastr.success("Key enabled successfully.",'Success');
            $(`.tag-${id}`).text(setText);
            $(`.tag-${id}`).attr('data-kleviokey',keyint);
        }
    },
      error: function (data) {
        console.log("Error!");
      },
    });    
});

</script>
@endpush