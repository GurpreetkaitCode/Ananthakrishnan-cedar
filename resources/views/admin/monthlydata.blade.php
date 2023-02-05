@extends('layout.admin.app')
@section('title', 'Monthly Data')
@section('content')
<div class="content-wrapper">
    {{--
    <link rel="stylesheet" type="text/css" href="{% static 'toastr.css' %}" />
    <script src="{% static 'toastr.min.js' %}"></script>
    <link rel="stylesheet" type="text/css" href="{% static 'ex-component-toastr.css' %}" /> --}}
    <style>
        #toast-container>.toast-error {
            background-color: #bd362f;
        }
    </style>
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
                                <h5 class="text-uppercase text-center">Monthly data</h5>
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
                                                        max="2040" step="1" value="{{$year}}" value="2022" />

                                                    <select class="filterbox" id="month1">
                                                        <option value="">--Select Month--</option>
                                                        <option value="1" {{$month==1? 'selected' : '' }}>January
                                                        </option>
                                                        <option value="2" {{$month==2? 'selected' : '' }}>February
                                                        </option>
                                                        <option value="3" {{$month==3? 'selected' : '' }}>March</option>
                                                        <option value="4" {{$month==4? 'selected' : '' }}>April</option>
                                                        <option value="5" {{$month==5? 'selected' : '' }}>May</option>
                                                        <option value="6" {{$month==6? 'selected' : '' }}>June</option>
                                                        <option value="7" {{$month==7? 'selected' : '' }}>July</option>
                                                        <option value="8" {{$month==8? 'selected' : '' }}>August
                                                        </option>
                                                        <option value="9" {{$month==9? 'selected' : '' }}>September
                                                        </option>
                                                        <option value="10" {{$month==10? 'selected' : '' }}>October
                                                        </option>
                                                        <option value="11" {{$month==11? 'selected' : '' }}>November
                                                        </option>
                                                        <option value="12" {{$month==12? 'selected' : '' }}>December
                                                        </option>
                                                    </select>
                                                    <div class="righthead">
                                                        <button class="filterbut" data-translate="Search"
                                                            onclick="searchTeam(event)">
                                                            Generate
                                                        </button>
                                                    </div>
                                                </div>
                                                @if($reservations)
                                                <div class="card-body table-responsive p-0" id="tableMain">
                                                    <div>
                                                        <table class="table table-striped table-valign-middle"
                                                            id="tablemainundefined">
                                                            <thead>
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <!-- <th>Create Date</th> -->
                                                                    <th>Guest First Name</th>
                                                                    <th>Guest Last Name</th>
                                                                    <th>Email</th>
                                                                    <th>Country</th>
                                                                    <th>Check In Date</th>
                                                                    <th>Check Out Date</th>
                                                                    <th>Room Type</th>
                                                                    <th>Unit</th>
                                                                    <th>Income</th>
                                                                    <th>Days</th>

                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($reservations as $item)
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td>{{$item->guest_first_name}}</td>
                                                                    <td>{{$item->guest_last_name}}</td>
                                                                    <td>{{$item->email}}</td>
                                                                    <td>{{$item->country}}</td>
                                                                    <td>{{date('d',strtotime($item->check_in))}}</td>
                                                                    <td>{{date('d',strtotime($item->check_out))}}</td>
                                                                    <td>{{$item->room}}</td>
                                                                    <td>{{$item->unit_no}} </td>
                                                                    <td>{{$item->revenue}}</td>
                                                                    <td>{{$item->total_days}}</td>
                                                                    <td>
                                                                        <button type="button"
                                                                            class="btn btn-primary edit_income_btn"
                                                                            data-revenue="{{$item->revenue}}"
                                                                            data-recordid="{{$item->id}}">Edit</button>
                                                                        <button type="button"
                                                                            class="btn btn-warning view_monthly_data_btn"
                                                                            data-revenue="{{$item->revenue}}"
                                                                            data-reservation-number="#{{$item->reservation_no}}"
                                                                            data-notes="{{$item->notes}}"
                                                                            data-createdat="{{$item->created_at}}"
                                                                            data-currency="{{$item->currency}}"
                                                                            data-guest-first-name="{{$item->guest_first_name}}"
                                                                            data-guest-last-name="{{$item->guest_last_name}}"
                                                                            data-email="{{$item->email}}"
                                                                            data-country="{{$item->country}}"
                                                                            data-check-in="{{$item->check_in}}"
                                                                            data-check-out="{{$item->check_out}}"
                                                                            data-room="{{$item->room}}"
                                                                            data-unit-no="{{$item->unit_no}}"
                                                                            data-total-days="{{$item->total_days}}"
                                                                            data-adults="{{$item->adults}}"
                                                                            data-children="{{$item->children}}"
                                                                            data-recordid="{{$item->id}}">View</button>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="dialog">No data available</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="editRevenueModal" tabindex="-1"
                                        aria-labelledby="editRevenueModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editRevenueModalLabel">
                                                        Edit Revenue
                                                    </h1>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('updateMonthlyData')}}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="incomeeditable">Income</label>
                                                            <input type="number" class="time form-control"
                                                                id="incomeeditable" name="revenue" aria-required="false"
                                                                required>
                                                            <input type="hidden" id="recordId" name="id">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary"
                                                                id="updateKeys">Update changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- VIEW ALL DATA MODEl --}}
                                    <div class="modal fade" id="viewMonthlyDataModal" tabindex="-1"
                                        aria-labelledby="viewMonthlyDataModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="viewMonthlyDataModalLabel">
                                                        View Data
                                                    </h1>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Column</th>
                                                                <th scope="col">Data</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">Reservation Number</th>
                                                                <th scope="row" id="reservationNumber">1</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">First Name</th>
                                                                <th scope="row" id="firstName">1</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Last Name</th>
                                                                <th scope="row" id="lastName">1</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Country</th>
                                                                <th scope="row" id="country">1</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Email</th>
                                                                <th scope="row" id="email">1</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Room</th>
                                                                <th scope="row" id="room">1</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Unit Number</th>
                                                                <th scope="row" id="unitNumber">1</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Revenue</th>
                                                                <th scope="row" id="revenue">1</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Check In Date</th>
                                                                <th scope="row" id="checkInDate">1</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Check Out Date</th>
                                                                <th scope="row" id="checkOutDate">1</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Adults</th>
                                                                <th scope="row" id="adults">1</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Children</th>
                                                                <th scope="row" id="children">1</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Notes</th>
                                                                <th scope="row" id="notes">1</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Total Days</th>
                                                                <th scope="row" id="totalDays">1</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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
@push('scripts')
<script>
    $('.view_monthly_data_btn').click(function(){
        var revenue = $(this).data('revenue');
        var guestFirstName = $(this).data('guest-first-name');
        var guestLastName = $(this).data('guest-last-name');
        var email = $(this).data('email');
        var country = $(this).data('country');
        var checkIn = $(this).data('check-in');
        var checkOut = $(this).data('check-out');
        var room = $(this).data('room');
        var unitNo = $(this).data('unit-no');
        var totalDays = $(this).data('total-days');
        var adults = $(this).data('adults');
        var children = $(this).data('children');
        var notes = $(this).data('notes');
        var reservationNumber = $(this).data('reservation-number');
        $('#reservationNumber').text(reservationNumber);
        $('#firstName').text(guestFirstName);
        $('#lastName').text(guestLastName);
        $('#country').text(country);
        $('#email').text(email);
        $('#room').text(room);
        $('#unitNumber').text(unitNo);
        $('#checkInDate').text(checkIn);
        $('#checkOutDate').text(checkOut);
        $('#revenue').text(revenue);
        $('#adults').text(adults);
        $('#children').text(children);
        $('#notes').text(notes);
        $('#totalDays').text(totalDays);

        $('#viewMonthlyDataModal').modal('show');
    });
    $('.edit_income_btn').click(function(){
        var revenue = $(this).data('revenue');
        var recordId = $(this).data('recordid');
        $('#incomeeditable').val(revenue);
        $('#recordId').val(recordId);
        $('#editRevenueModal').modal('show');
    });
    var sessionId = getCookie("session_id_$cedar");
sessionId = sessionId.slice(1, -1);
function getCookie(name) {
var nameEQ = name + "=";
var ca = document.cookie.split(";");
for (var i = 0; i < ca.length; i++) {
  var c = ca[i];
  while (c.charAt(0) == " ") c = c.substring(1, c.length);
  if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
}
return null;
}
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
    "{{route('monthlydata')}}/?year=" +
      year +
      "&month=" +
      month
  );
}
}

function getParam(param) {
return new URLSearchParams(window.location.search).get(param);
}
</script>
@endpush
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