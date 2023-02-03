@extends('layout.admin.app')
@section('title', 'Revenue')
@section('pagename', 'Revenue')
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
                                <h5 class="text-uppercase text-center">Revenue summary</h5>
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
                                                        Type
                                                    </div>
                                                    <select class="filterbox" id="type" onchange="changeType(event)">
                                                        <option value="0" @if($type==0) selected @endif>Yearly
                                                        </option>
                                                        <option value="1" @if($type==1) selected @endif>Custom
                                                        </option>
                                                    </select>
                                                    <div id="yearlydiv" @if($type==1) style="display:none;" @endif
                                                        class="flex">
                                                        <div class="filtname" data-translate="Filters">
                                                            Year
                                                        </div>
                                                        <input value="{{$year != '' ? $year : 2023}}" type="number"
                                                            id="year1" class="filterbox" min="1900" max="2040"
                                                            step="1" />
                                                        <div class="filtname" data-translate="Filters">
                                                            Plot
                                                        </div>

                                                        <select class="filterbox" id="plot1">
                                                            <option value="0" {{$plot==0 ? 'selected' : '' }}>
                                                                Revenue</option>
                                                            <option value="1" {{$plot==1 ? 'selected' : '' }}>
                                                                Occupancy</option>
                                                        </select>
                                                    </div>
                                                    <div id="customdiv" @if($type==0) style="display:none;" @endif
                                                        class="flex">
                                                        <div class="filtname" data-translate="Filters">
                                                            From
                                                        </div>
                                                        <input type="number" id="year2" class="filterbox" min="1900"
                                                            max="2040" step="1" value="2022" />
                                                        <select class="filterbox" id="month2" onchange="show_month()">
                                                            <option {{$frommonth==0 ? 'selected' : '' }} value="">
                                                                --Select Month--</option>
                                                            <option {{$frommonth==1 ? 'selected' : '' }} value="1">
                                                                Janaury</option>
                                                            <option {{$frommonth==2 ? 'selected' : '' }} value="2">
                                                                February</option>
                                                            <option {{$frommonth==3 ? 'selected' : '' }} value="3">March
                                                            </option>
                                                            <option {{$frommonth==4 ? 'selected' : '' }} value="4">April
                                                            </option>
                                                            <option {{$frommonth==5 ? 'selected' : '' }} value="5">May
                                                            </option>
                                                            <option {{$frommonth==6 ? 'selected' : '' }} value="6">June
                                                            </option>
                                                            <option {{$frommonth==7 ? 'selected' : '' }} value="7">July
                                                            </option>
                                                            <option {{$frommonth==8 ? 'selected' : '' }} value="8">
                                                                August</option>
                                                            <option {{$frommonth==9 ? 'selected' : '' }} value="9">
                                                                September</option>
                                                            <option {{$frommonth==10 ? 'selected' : '' }} value="10">
                                                                October</option>
                                                            <option {{$frommonth==11 ? 'selected' : '' }} value="11">
                                                                November</option>
                                                            <option {{$frommonth==12 ? 'selected' : '' }} value="12">
                                                                December</option>
                                                        </select>

                                                        <div class="filtname" data-translate="Filters">
                                                            To
                                                        </div>

                                                        <input type="number" id="year3" class="filterbox" min="1900"
                                                            max="2040" step="1" value="2022" />

                                                        <select class="filterbox" id="month3" onchange="show_month()">
                                                            <option {{$tomonth==0 ? 'selected' : '' }} value="">--Select
                                                                Month--</option>
                                                            <option {{$tomonth==1 ? 'selected' : '' }} value="1">Janaury
                                                            </option>
                                                            <option {{$tomonth==2 ? 'selected' : '' }} value="2">
                                                                February</option>
                                                            <option {{$tomonth==3 ? 'selected' : '' }} value="3">March
                                                            </option>
                                                            <option {{$tomonth==4 ? 'selected' : '' }} value="4">April
                                                            </option>
                                                            <option {{$tomonth==5 ? 'selected' : '' }} value="5">May
                                                            </option>
                                                            <option {{$tomonth==6 ? 'selected' : '' }} value="6">June
                                                            </option>
                                                            <option {{$tomonth==7 ? 'selected' : '' }} value="7">July
                                                            </option>
                                                            <option {{$tomonth==8 ? 'selected' : '' }} value="8">August
                                                            </option>
                                                            <option {{$tomonth==9 ? 'selected' : '' }} value="9">
                                                                September</option>
                                                            <option {{$tomonth==10 ? 'selected' : '' }} value="10">
                                                                October</option>
                                                            <option {{$tomonth==11 ? 'selected' : '' }} value="11">
                                                                November</option>
                                                            <option {{$tomonth==12 ? 'selected' : '' }} value="12">
                                                                December</option>
                                                        </select>

                                                        <div class="filtname" data-translate="Filters">
                                                            Plot
                                                        </div>
                                                        <select class="filterbox" id="plot2">
                                                            <option value="0" {{$plot==0 ? 'selected' : '' }}>Net
                                                                profit</option>
                                                            <option value="1" {{$plot==1 ? 'selected' : '' }}>
                                                                Gross profit</option>
                                                            <option value="2" {{$plot==2 ? 'selected' : '' }}>
                                                                Revenue</option>
                                                            <option value="3" {{$plot==3 ? 'selected' : '' }}>
                                                                Total cost</option>
                                                            <option value="4" {{$plot==4 ? 'selected' : '' }}>
                                                                Variable cost</option>
                                                            <option value="5" {{$plot==5 ? 'selected' : '' }}>
                                                                Occupancy</option>
                                                        </select>
                                                    </div>
                                                    <div class="righthead">
                                                        <button class="filterbut" data-translate="Search"
                                                            onclick="searchTeam(event)">
                                                            Generate
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="searchfilters" id="searchfilters"
                                                    style="color: green;padding: 10px;">
                                                    <div class="filtname" data-translate="Filters">
                                                        Total Income: £ {{$totalIncome ?? 0}} |
                                                    </div>
                                                    <div class="filtname" data-translate="Filters">
                                                        Total Cost: £ {{$totalCost?? 0}}|
                                                    </div>
                                                    <div class="filtname" data-translate="Filters">
                                                        Profit : £ {{$totalProfit ?? 0}}|
                                                    </div>
                                                    <div class="filtname" data-translate="Filters">
                                                        Occupancy Ratio: {{$totalOcc ?? 0}} % |
                                                    </div>
                                                    <div class="filtname" data-translate="Filters">
                                                        Total Capital Expenditure: £ {{$totalCap ?? 0}} |
                                                    </div>
                                                </div>
                                                @if($records)
                                                <div>
                                                    <canvas id="myChart"
                                                        style="width: 100%; max-width: 600px;"></canvas>
                                                    @php
                                                    $data = [];
                                                    $month = [];

                                                    if($records){
                                                    // $month = [];
                                                    // $data = [];
                                                    foreach ($records as $key => $value) {
                                                    $month []= $value['month'];
                                                    if($fromyear){
                                                    if($plot == 0){
                                                    $data [] = $value['profit'];
                                                    }elseif($plot == 1){
                                                    $data [] = $value['grossprofit'] ?? 0;
                                                    }elseif($plot == 2){
                                                    $data [] = $value['income'] ?? 0;
                                                    }elseif($plot == 3){
                                                    $data [] = $value['cost'] ?? 0;
                                                    }elseif($plot == 4){
                                                    $data [] = $value['variablecost'] ?? 0;
                                                    }elseif($plot == 5){
                                                    $data [] = $value['occ'] ?? 0;
                                                    }

                                                    }else{
                                                    if($plot == 0){
                                                    $data [] = $value['income'];
                                                    }elseif($plot == 1){
                                                    $data [] = $value['occ'] ?? 0;
                                                    }
                                                    }
                                                    }
                                                    }
                                                    @endphp
                                                    <script>
                                                        // Dummy data for the chart
                                                        var chartData = @json($data);
                                                        var chartLabels = @json($month);
                                                        // var plot = @json($plot);
                                                            var data = {
                                                            labels: chartLabels,
                                                            datasets: [{
                                                                label: 'Data',
                                                                data: chartData,
                                                                backgroundColor: "rgba(0, 0, 255, 1)",
                                                                borderColor: "rgba(0, 0, 255, 1)",
                                                                borderWidth: 1
                                                            }]
                                                            };
                                                            // Get the chart container
                                                            var ctx = document.getElementById("myChart").getContext("2d");
                                                            // Create the chart
                                                            var myBarChart = new Chart(ctx, {
                                                            type: "bar",
                                                            data: data,
                                                            options: {
                                                                scales: {
                                                                y: {
                                                                    beginAtZero: true
                                                                }
                                                                }
                                                            }
                                                            });
                                                    </script>
                                                </div>


                                                <div class="card-body table-responsive p-0" id="tableMain">
                                                    <div>
                                                        <table class="table table-striped table-valign-middle"
                                                            id="tablemainundefined">
                                                            <thead>
                                                                <tr>
                                                                    <!-- <th>Id</th> -->
                                                                    @if($type == 0)
                                                                    <th>Month</th>
                                                                    <th>Total Days</th>
                                                                    <th>Number Of Bookings</th>
                                                                    <th>Average Length</th>
                                                                    <th>Total Income</th>
                                                                    <th>Occupancy</th>
                                                                    @else
                                                                    <th>Date</th>
                                                                    <th>Occupancy</th>
                                                                    <th>Tot Costs</th>
                                                                    <th>Income</th>
                                                                    <th>profits</th>
                                                                    @endif
                                                                    <!-- <th>Actions</th> -->

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($records as $record)
                                                                @if($type == 0)
                                                                <tr>
                                                                    <td>{{$record['month']}}</td>
                                                                    <td>{{$record['totaldays'] ?? 0}}</td>
                                                                    <td>{{$record['bookings'] ?? 0}}</td>
                                                                    <td>{{$record['averageLength'] ?? 0}}</td>
                                                                    <td>£ {{$record['income'] ?? 0}}</td>
                                                                    <td>{{$record['occ']??0}} %</td>
                                                                </tr>
                                                                @else
                                                                <tr>
                                                                    <td>{{$record['month']}}</td>
                                                                    <td>{{$record['occ']??0}} %</td>
                                                                    <td>£{{$record['cost'] ?? 0}}</td>
                                                                    <td>£{{$record['income'] ?? 0}}</td>
                                                                    <td>£{{$record['profit'] ?? 0}}</td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                @else
                                                <div>
                                                    <div class="dialog">No data available</div>
                                                </div>
                                                @endif
                                                <!-- /.card -->
                                            </div>
                                            <!-- /.col-md-6 -->
                                        </div>

                                        <!-- /.container-fluid -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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

    #customdiv,
    #yearlydiv {
        align-items: center;
    }

    .hidden {
        display: none;
    }

    /*  */
</style>
@endpush
@push('scripts')
<script>
    function searchTeam(event) {
    event.preventDefault();
    var type = document.getElementById("type").value;
    // 
    // var month = document.getElementById("month1").value;

    if (type == 0) {

      var year1 = document.getElementById("year1").value;
      var plot1 = document.getElementById("plot1").value;
      if (
        year1 == "" ||
        year1 == " " ||
        plot1 == "" ||
        plot1 == " "
      ) {
        toastr.error("Enter all required fields.");
        return;
      } else {
        window.location.replace(
          "{{route('revenue')}}//?type=0&year=" +
          year1 +
          "&plot=" +
          plot1
        );
      }
    } else {
      var year2 = document.getElementById("year2").value;
      var month2 = document.getElementById("month2").value;
      var year3 = document.getElementById("year3").value;
      var month3 = document.getElementById("month3").value;
      var plot2 = document.getElementById("plot2").value;
      if (
        year2 == "" ||
        year2 == " " ||
        year3 == "" ||
        year3 == " " ||
        month2 == "" ||
        month2 == " " ||
        month3 == "" ||
        month3 == " " ||
        plot2 == "" ||
        plot2 == " "
      ) {
        toastr.error("Enter all required fields.");
        return;
      } else {
        window.location.replace(
          "{{route('revenue')}}/?type=1&fromYear=" +
          year2 + "&fromMonth=" + month2 + "&toYear=" + year3 + "&toMonth=" + month3 +
          "&plot=" +
          plot2
        );
      }
    }
  }
  function getParam(param) {
    return new URLSearchParams(window.location.search).get(param);
  }
  function changeType() {
    var type = document.getElementById('type').value
    console.log(type)
    if (type == "0") {
      document.getElementById('yearlydiv').style.display = "flex"
      document.getElementById('customdiv').style.display = "none"
    } else {
      document.getElementById('yearlydiv').style.display = "none"
      document.getElementById('customdiv').style.display = "flex"
    }
  }


</script>
@endpush