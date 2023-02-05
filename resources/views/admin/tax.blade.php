@extends('layout.admin.app')
@section('title', 'Tax')
@section('pagename', 'Tax')
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
                <h5 class="text-uppercase text-center">Tax summary</h5>
              </div>
              <p style="color: red;"></p>
              <p style="color: red;"></p>
              <p style="color: red;"></p>

              <div class="card-body">
                <div class="container-fluid">
                  <div class="row">
                    <div class="" style="width: 100%;">
                      <div class="card">

                        {{-- <form action="{{route('tax')}}" method="GET"> --}}
                          <div class="searchfilters" id="searchfilters">
                            <div class="filtname" data-translate="Filters">
                              Type
                            </div>
                            <select class="filterbox" id="type" onchange="changeType()" name="type">
                              <option value="0" @if($fromyear==null) selected @endif>Yearly
                              </option>
                              <option value="1" @if($fromyear !==null) selected @endif>Custom
                              </option>
                            </select>
                            <div id="yearlydiv" @if($toyear !==null) style="display: none" @endif class="flex">
                              <div class="filtname" data-translate="Filters">
                                Year
                              </div>
                              <input value="@if($toyear){{$toyear}}@else{{'2023'}}@endif" type="number" name="year"
                                id="year1" class="filterbox" min="1900" max="2040" step="1" />
                              <div class="filtname" data-translate="Filters">
                                Plot
                              </div>
                              <select class="filterbox" name="plot" id="plot1">
                                <option value="0" {{$plot==0 ? 'selected' : '' }}>
                                  Net
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
                            <div id="customdiv" @if($toyear==null) style="display: none;" @endif class="flex">
                              <div class="filtname" data-translate="Filters">
                                From
                              </div>
                              <input type="number" id="year2" class="filterbox" min="1900" max="2040" step="1"
                                value="@if($fromyear){{$fromyear}}@else {{'2023'}} @endif" />
                              <select class="filterbox" id="month2">
                                <option {{$frommonth=='' ? 'selected' : '' }} value="">--Select Month--</option>
                                <option value="1" {{$frommonth==1 ? 'selected' : '' }}>January </option>
                                <option value="2" {{$frommonth==2 ? 'selected' : '' }}>February</option>
                                <option value="3" {{$frommonth==3 ? 'selected' : '' }}>March</option>
                                <option value="4" {{$frommonth==4 ? 'selected' : '' }}>April</option>
                                <option value="5" {{$frommonth==5 ? 'selected' : '' }}>May</option>
                                <option value="6" {{$frommonth==6 ? 'selected' : '' }}>June</option>
                                <option value="7" {{$frommonth==7 ? 'selected' : '' }}>July</option>
                                <option value="8" {{$frommonth==8 ? 'selected' : '' }}>August</option>
                                <option value="9" {{$frommonth==9 ? 'selected' : '' }}> September</option>
                                <option value="10" {{$frommonth==10 ? 'selected' : '' }}>October</option>
                                <option value="11" {{$frommonth==11 ? 'selected' : '' }}>November</option>
                                <option value="12" {{$frommonth==12 ? 'selected' : '' }}>December</option>
                              </select>
                              <div class="filtname" data-translate="Filters">
                                To
                              </div>
                              <input type="number" id="year3" class="filterbox" min="1900" max="2040" step="1"
                                value="@if($toyear){{$toyear}}@else{{'2023'}}@endif" />

                              <select class="filterbox" id="month3">
                                <option {{$tomonth=='' ? 'selected' : '' }} value="">--Select Month--</option>
                                <option value="1" {{$tomonth==1 ? 'selected' : '' }}>January </option>
                                <option value="2" {{$tomonth==2 ? 'selected' : '' }}> February</option>
                                <option value="3" {{$tomonth==3 ? 'selected' : '' }}>March</option>
                                <option value="4" {{$tomonth==4 ? 'selected' : '' }}>April</option>
                                <option value="5" {{$tomonth==5 ? 'selected' : '' }}>May</option>
                                <option value="6" {{$tomonth==6 ? 'selected' : '' }}>June</option>
                                <option value="7" {{$tomonth==7 ? 'selected' : '' }}>July</option>
                                <option value="8" {{$tomonth==8 ? 'selected' : '' }}>August</option>
                                <option value="9" {{$tomonth==9 ? 'selected' : '' }}>September</option>
                                <option value="10" {{$tomonth==10 ? 'selected' : '' }}>October</option>
                                <option value="11" {{$tomonth==11 ? 'selected' : '' }}>November</option>
                                <option value="12" {{$tomonth==12 ? 'selected' : '' }}>December</option>
                              </select>

                              <div class="filtname" data-translate="Filters">
                                Plot
                              </div>

                              <select class="filterbox" name="plot" id="plot2">
                                <option value="0" {{$plot==0 ? 'selected' : '' }}>
                                  Net
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
                              <button class="filterbut" data-translate="Search" onclick="searchTeam(event)">
                                Generate
                              </button>
                            </div>
                          </div>
                          <div class="searchfilters" id="searchfilters" style="color: green;padding: 10px;">
                            <div class="filtname" data-translate="Filters">
                              Total Income: £ {{$totalIncome}} |
                            </div>
                            <div class="filtname" data-translate="Filters">
                              Total Cost: £ {{$totalCost}} |
                            </div>
                            <div class="filtname" data-translate="Filters">
                              Profit : £ {{$totalProfit}} |
                            </div>
                            <div class="filtname" data-translate="Filters">
                              Occupancy Ratio: {{$totalOcc}}% |
                            </div>
                            <div class="filtname" data-translate="Filters">
                              Total Capital Expenditure: £ {{$totalCap}}
                            </div>
                          </div>
                          <div>
                            <canvas id="myChart1" style="width: 100%; max-width: 600px;"></canvas>
                            @php
                            $data = [];
                            $month = [];

                            if($records){
                            $month = [];
                            $data = [];
                            foreach ($records as $key => $value) {
                            $month []= $value['month'];
                            if($plot == 1)
                            {
                            $data []= $value['grossprofit'];
                            }else if($plot == 2){
                            $data []= $value['income'];
                            }else if($plot == 3){
                            $data []= $value['cost'] ;
                            break;
                            }else if($plot == 4){
                            $data []= $value['variablecost'];
                            }else if($plot == 5){
                            $data []= $value['occ'];
                            }else{
                            $data []= $value['profit'];
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
                                var ctx = document.getElementById("myChart1").getContext("2d");
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
                              <table class="table table-striped table-valign-middle" id="tablemainundefined">
                                <thead>
                                  <tr>
                                    <!-- <th>Id</th> -->
                                    <th>Date</th>
                                    <th>Occupancy</th>
                                    <th>Tot Costs</th>
                                    <th>Income</th>
                                    <th>profits</th>
                                    <!-- <th>Actions</th> -->
                                  </tr>
                                </thead>
                                <tbody>
                                  @if($records)
                                  @foreach($records as $record)
                                  <tr>
                                    <td>{{$record['month']}}</td>
                                    <td>{{$record['occ'] ?? 0}}%</td>
                                    <td>£{{$record['cost']?? 0}}</td>
                                    <td>£{{$record['income']}}</td>
                                    <td>£{{$record['profit']}}</td>
                                  </tr>
                                  @endforeach
                                  @else
                                  <tr>
                                    <td colspan="5" class="text-center">No records found</td>
                                  </tr>
                                  @endif
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
        </div>
      </main>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
  function searchTeam(event) {
    event.preventDefault();
    var type = document.getElementById("type").value;
    // 
    // var month = document.getElementById("month1").value;

    if (type == 0) {

      var year2 = document.getElementById("year1").value;

      var plot1 = document.getElementById("plot1").value;
      if (
        year2 == "" ||
        year2 == " " ||
        plot1 == "" ||
        plot1 == " "
      ) {
        toastr.error("Enter all required fields.");
        return;
      } else {
        var year1 = parseInt(year2) - 1
        window.location.replace(
          "{{route('tax')}}/?type=0&fromYear=" +
          year1 +
          "&toYear=" + year2 + "&fromMonth=4&toMonth=3&plot=" +
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
          "{{route('tax')}}/?type=1&fromYear=" +
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

  // function generateChart() {
  //   var d = JSON.parse(document.getElementById("all_costs").textContent);
  //   console.log(d);
  //   costDic = {};
  //   var type = getParam("type")
  //   var plot = getParam("plot")
  //   if (plot == "0") {
  //     for (i = 0; i < d.length; i++) {
  //       if (costDic.hasOwnProperty(d[i]["Date"])) {
  //         costDic[d[i]["Date"]] += d[i]["Profit"];
  //       } else {
  //         costDic[d[i]["Date"]] = d[i]["Profit"];
  //       }
  //     }
  //     var xValues = [],
  //       yValues = [];
  //     for (var property in costDic) {
  //       if (!costDic.hasOwnProperty(property)) {
  //         continue;
  //       }
  //       xValues.push(property);
  //       yValues.push(costDic[property]);
  //     }
  //     var barColors = "blue";
  //     window.myChart1 = new Chart("myChart1", {
  //       type: "bar",
  //       data: {
  //         labels: xValues,
  //         datasets: [
  //           {
  //             backgroundColor: barColors,
  //             data: yValues,
  //           },
  //         ],
  //       },
  //       options: {
  //         legend: {
  //           display: false
  //         },
  //         scales: {
  //           yAxes: [{
  //             ticks: {
  //               // Include a dollar sign in the ticks
  //               callback: function (value, index, values) {
  //                 return '$' + value;
  //               }
  //             }
  //           }]
  //         },
  //         title: {
  //           display: false
  //         },
  //         tooltips: {
  //           callbacks: {
  //             label: function (tooltipItem, data) {
  //               var dataset = data.datasets[tooltipItem.datasetIndex];
  //               var currentValue = dataset.data[tooltipItem.index];

  //               return (
  //                 "£" + String(currentValue)
  //               );
  //             },
  //           },
  //         },
  //       },
  //     });



  //   }
  //   else if (plot == "2") {


  //     for (i = 0; i < d.length; i++) {
  //       if (costDic.hasOwnProperty(d[i]["Date"])) {
  //         costDic[d[i]["Date"]] += d[i]["TotalIncome"];
  //       } else {
  //         costDic[d[i]["Date"]] = d[i]["TotalIncome"];
  //       }

  //     }
  //     var xValues = [],
  //       yValues = [];

  //     for (var property in costDic) {
  //       if (!costDic.hasOwnProperty(property)) {
  //         continue;
  //       }

  //       xValues.push(property);
  //       yValues.push(costDic[property]);
  //     }
  //     var barColors = "blue";


  //     window.myChart1 = new Chart("myChart1", {
  //       type: "bar",
  //       data: {
  //         labels: xValues,
  //         datasets: [
  //           {
  //             backgroundColor: barColors,
  //             data: yValues,
  //           },
  //         ],
  //       },
  //       options: {
  //         legend: {
  //           display: false
  //         },
  //         scales: {
  //           yAxes: [{
  //             ticks: {
  //               // Include a dollar sign in the ticks
  //               callback: function (value, index, values) {
  //                 return '$' + value;
  //               }
  //             }
  //           }]
  //         },
  //         title: {
  //           display: false
  //         },
  //         tooltips: {
  //           callbacks: {
  //             label: function (tooltipItem, data) {
  //               var dataset = data.datasets[tooltipItem.datasetIndex];
  //               var currentValue = dataset.data[tooltipItem.index];

  //               return (
  //                 "£" + String(currentValue)
  //               );
  //             },
  //           },
  //         },
  //       },
  //     });



  //   } else if (plot == "3") {
  //     for (i = 0; i < d.length; i++) {
  //       if (costDic.hasOwnProperty(d[i]["Date"])) {
  //         costDic[d[i]["Date"]] += d[i]["TotalCost"];
  //       } else {
  //         costDic[d[i]["Date"]] = d[i]["TotalCost"];
  //       }

  //     }
  //     var xValues = [],
  //       yValues = [];

  //     for (var property in costDic) {
  //       if (!costDic.hasOwnProperty(property)) {
  //         continue;
  //       }

  //       xValues.push(property);
  //       yValues.push(costDic[property]);
  //     }
  //     var barColors = "blue";


  //     window.myChart1 = new Chart("myChart1", {
  //       type: "bar",
  //       data: {
  //         labels: xValues,
  //         datasets: [
  //           {
  //             backgroundColor: barColors,
  //             data: yValues,
  //           },
  //         ],
  //       },
  //       options: {
  //         legend: {
  //           display: false
  //         },
  //         scales: {
  //           yAxes: [{
  //             ticks: {
  //               // Include a dollar sign in the ticks
  //               callback: function (value, index, values) {
  //                 return '$' + value;
  //               }
  //             }
  //           }]
  //         },
  //         title: {
  //           display: false
  //         },
  //         tooltips: {
  //           callbacks: {
  //             label: function (tooltipItem, data) {
  //               var dataset = data.datasets[tooltipItem.datasetIndex];
  //               var currentValue = dataset.data[tooltipItem.index];

  //               return (
  //                 "£" + String(currentValue)
  //               );
  //             },
  //           },
  //         },
  //       },
  //     });
  //   } else if (plot == "5") {
  //     for (i = 0; i < d.length; i++) {
  //       if (costDic.hasOwnProperty(d[i]["Date"])) {
  //         costDic[d[i]["Date"]] += d[i]["Occupancy"];
  //       } else {
  //         costDic[d[i]["Date"]] = d[i]["Occupancy"];
  //       }

  //     }
  //     var xValues = [],
  //       yValues = [];

  //     for (var property in costDic) {
  //       if (!costDic.hasOwnProperty(property)) {
  //         continue;
  //       }

  //       xValues.push(property);
  //       yValues.push(costDic[property]);
  //     }
  //     var barColors = "blue";


  //     window.myChart1 = new Chart("myChart1", {
  //       type: "bar",
  //       data: {
  //         labels: xValues,
  //         datasets: [
  //           {
  //             backgroundColor: barColors,
  //             data: yValues,
  //           },
  //         ],
  //       },
  //       options: {
  //         legend: {
  //           display: false
  //         },
  //         scales: {
  //           yAxes: [{
  //             ticks: {
  //               // Include a dollar sign in the ticks
  //               callback: function (value, index, values) {
  //                 return value + "%";
  //               }
  //             }
  //           }]
  //         },
  //         title: {
  //           display: false
  //         },
  //         tooltips: {
  //           callbacks: {
  //             label: function (tooltipItem, data) {
  //               var dataset = data.datasets[tooltipItem.datasetIndex];
  //               var currentValue = dataset.data[tooltipItem.index];

  //               return (
  //                 String(currentValue) + "%"
  //               );
  //             },
  //           },
  //         },
  //       },
  //     });
  //   } else if (plot == "4") {
  //     for (i = 0; i < d.length; i++) {
  //       if (costDic.hasOwnProperty(d[i]["Date"])) {
  //         costDic[d[i]["Date"]] += d[i]["VariableCost"];
  //       } else {
  //         costDic[d[i]["Date"]] = d[i]["VariableCost"];
  //       }

  //     }
  //     var xValues = [],
  //       yValues = [];

  //     for (var property in costDic) {
  //       if (!costDic.hasOwnProperty(property)) {
  //         continue;
  //       }

  //       xValues.push(property);
  //       yValues.push(costDic[property]);
  //     }
  //     var barColors = "blue";


  //     window.myChart1 = new Chart("myChart1", {
  //       type: "bar",
  //       data: {
  //         labels: xValues,
  //         datasets: [
  //           {
  //             backgroundColor: barColors,
  //             data: yValues,
  //           },
  //         ],
  //       },
  //       options: {
  //         legend: {
  //           display: false
  //         },
  //         scales: {
  //           yAxes: [{
  //             ticks: {
  //               // Include a dollar sign in the ticks
  //               callback: function (value, index, values) {
  //                 return "$" + value;
  //               }
  //             }
  //           }]
  //         },
  //         title: {
  //           display: false
  //         },
  //         tooltips: {
  //           callbacks: {
  //             label: function (tooltipItem, data) {
  //               var dataset = data.datasets[tooltipItem.datasetIndex];
  //               var currentValue = dataset.data[tooltipItem.index];

  //               return (
  //                 "$" + String(currentValue)
  //               );
  //             },
  //           },
  //         },
  //       },
  //     });
  //   } else if (plot == "1") {

  //     for (i = 0; i < d.length; i++) {
  //       if (costDic.hasOwnProperty(d[i]["Date"])) {
  //         costDic[d[i]["Date"]] += d[i]["GrossProfit"];
  //       } else {
  //         costDic[d[i]["Date"]] = d[i]["GrossProfit"];
  //       }

  //     }
  //     var xValues = [],
  //       yValues = [];

  //     for (var property in costDic) {
  //       if (!costDic.hasOwnProperty(property)) {
  //         continue;
  //       }

  //       xValues.push(property);
  //       yValues.push(costDic[property]);
  //     }
  //     var barColors = "blue";


  //     window.myChart1 = new Chart("myChart1", {
  //       type: "bar",
  //       data: {
  //         labels: xValues,
  //         datasets: [
  //           {
  //             backgroundColor: barColors,
  //             data: yValues,
  //           },
  //         ],
  //       },
  //       options: {
  //         legend: {
  //           display: false
  //         },
  //         scales: {
  //           yAxes: [{
  //             ticks: {
  //               // Include a dollar sign in the ticks
  //               callback: function (value, index, values) {
  //                 return "$" + value;
  //               }
  //             }
  //           }]
  //         },
  //         title: {
  //           display: false
  //         },
  //         tooltips: {
  //           callbacks: {
  //             label: function (tooltipItem, data) {
  //               var dataset = data.datasets[tooltipItem.datasetIndex];
  //               var currentValue = dataset.data[tooltipItem.index];

  //               return (
  //                 "$" + String(currentValue)
  //               );
  //             },
  //           },
  //         },
  //       },
  //     });
  //   }
  // }
  // generateChart();
</script>
@endpush
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