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

                                                    <select class="filterbox" id="type">
                                                        <option value="0">Yearly
                                                        </option>
                                                        <option value="1">Custom
                                                        </option>
                                                    </select>

                                                    <div id="yearlydiv" style="display: none;" class="flex">
                                                        <div class="filtname" data-translate="Filters">
                                                            Year
                                                        </div>

                                                        <input value="2022" type="number" id="year1" class="filterbox"
                                                            min="1900" max="2040" step="1" />
                                                        <div class="filtname" data-translate="Filters">
                                                            Plot
                                                        </div>

                                                        <select class="filterbox" id="plot1">
                                                            <option value="0">
                                                                Revenue</option>
                                                            <option value="1">
                                                                Occupancy</option>
                                                        </select>


                                                    </div>

                                                    <div id="customdiv" style="display: none;" style="display: none;"
                                                        class="flex">
                                                        <div class="filtname" data-translate="Filters">
                                                            From
                                                        </div>

                                                        <input type="number" id="year2" class="filterbox" min="1900"
                                                            max="2040" step="1" value="2022" />

                                                        <select class="filterbox" id="month2" onchange="show_month()">
                                                            <option selected value="">--Select Month--</option>
                                                            <option value="1">Janaury</option>
                                                            <option value="2">February</option>
                                                            <option value="3">March</option>
                                                            <option value="4">April</option>
                                                            <option value="5">May</option>
                                                            <option value="6">June</option>
                                                            <option value="7">July</option>
                                                            <option value="8">August</option>
                                                            <option value="9">September</option>
                                                            <option value="10">October</option>
                                                            <option value="11">November</option>
                                                            <option value="12">December</option>
                                                        </select>

                                                        <div class="filtname" data-translate="Filters">
                                                            To
                                                        </div>

                                                        <input type="number" id="year3" class="filterbox" min="1900"
                                                            max="2040" step="1" value="2022" />

                                                        <select class="filterbox" id="month3" onchange="show_month()">
                                                            <option selected value="">--Select Month--</option>
                                                            <option value="1">Janaury</option>
                                                            <option value="2">February</option>
                                                            <option value="3">March</option>
                                                            <option value="4">April</option>
                                                            <option value="5">May</option>
                                                            <option value="6">June</option>
                                                            <option value="7">July</option>
                                                            <option value="8">August</option>
                                                            <option value="9">September</option>
                                                            <option value="10">October</option>
                                                            <option value="11">November</option>
                                                            <option value="12">December</option>
                                                        </select>

                                                        <div class="filtname" data-translate="Filters">
                                                            Plot
                                                        </div>

                                                        <select class="filterbox" id="plot2">
                                                            <option value="0">Net
                                                                profit</option>
                                                            <option value="1">
                                                                Gross profit</option>
                                                            <option value="2">
                                                                Revenue</option>
                                                            <option value="3">
                                                                Total cost</option>
                                                            <option value="4">
                                                                Variable cost</option>
                                                            <option value="5">
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
                                                        Total Income: £ |
                                                    </div>
                                                    <div class="filtname" data-translate="Filters">
                                                        Total Cost: £ |
                                                    </div>
                                                    <div class="filtname" data-translate="Filters">
                                                        Profit : £ |
                                                    </div>
                                                    <div class="filtname" data-translate="Filters">
                                                        Occupancy Ratio: |
                                                    </div>
                                                    <div class="filtname" data-translate="Filters">
                                                        Total Capital Expenditure: £
                                                    </div>
                                                </div>

                                                {{-- {% if all_reserve %}
                                                {% if type == 0 %} --}}
                                                <div>
                                                    <canvas id="myChart"
                                                        style="width: 100%; max-width: 600px;"></canvas>
                                                </div>


                                                <div class="card-body table-responsive p-0" id="tableMain">
                                                    <div>
                                                        <table class="table table-striped table-valign-middle"
                                                            id="tablemainundefined">
                                                            <thead>
                                                                <tr>
                                                                    <!-- <th>Id</th> -->
                                                                    <th>Month</th>
                                                                    <th>Total Days</th>
                                                                    <th>Number Of Bookings</th>
                                                                    <th>Average Length</th>
                                                                    <th>Total Income</th>
                                                                    <th>Occupancy</th>
                                                                    <!-- <th>Actions</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div>
                                                    <canvas id="myChart1"
                                                        style="width: 100%; max-width: 600px;"></canvas>
                                                </div>

                                                <div class="card-body table-responsive p-0" id="tableMain">
                                                    <div>
                                                        <table class="table table-striped table-valign-middle"
                                                            id="tablemainundefined">
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
                                                                <tr>
                                                                    <td>Temp</td>
                                                                    <td>Temp%</td>
                                                                    <td>Temp</td>
                                                                    <td>£Temp</td>
                                                                    <td>£Temp </td>
                                                                    <!-- <td><button>Key</button></td> -->
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="dialog">No data available</div>
                                            </div>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@endpush