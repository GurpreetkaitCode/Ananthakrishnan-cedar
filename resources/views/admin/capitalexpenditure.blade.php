@extends('layout.admin.app')
@section('title', 'Capital Expenditure')
@section ('pagename', 'Capital Expenditure')
@section ('content')

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
                                <h5 class="text-uppercase text-center">Capital Expenditure</h5>
                            </div>
                            <p style="color: red;"></p>
                            <p style="color: red;"></p>
                            <p style="color: red;"></p>

                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="" style="width: 100%;">
                                            <div class="card">
                                                {{-- <div class="card-header border-0 flex">
                                                    <div class="righthead flex">
                                                        <div class="headcreate" onclick="showCreateExpType()">
                                                            +
                                                            <span data-translate="Create Team">Create expense
                                                                type</span>
                                                        </div>
                                                        <div class="headcreate" onclick="showAddExp()">
                                                            +
                                                            <span data-translate="Create Team">Add expense</span>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="searchfilters" id="searchfilters">
                                                    <div class="filtname" data-translate="Filters">
                                                        From
                                                    </div>

                                                    <input type="number" id="year1" name="fromyear" class="filterbox"
                                                        min="1900" max="2040" step="1"
                                                        value="{{$fromyear == 0 ? 2022 : $fromyear}}" />

                                                    <select class="filterbox" id="month1" name="frommonth"
                                                        onchange="show_month()">
                                                        <option selected value="">--Select Month--</option>
                                                        <option value="1" {{$frommonth==1 ? 'selected' : '' }}>
                                                            January </option>
                                                        <option value="2" {{$frommonth==2 ? 'selected' : '' }}>
                                                            February</option>
                                                        <option value="3" {{$frommonth==3 ? 'selected' : '' }}>
                                                            March</option>
                                                        <option value="4" {{$frommonth==4 ? 'selected' : '' }}>
                                                            April</option>
                                                        <option value="5" {{$frommonth==5 ? 'selected' : '' }}>
                                                            May</option>
                                                        <option value="6" {{$frommonth==6 ? 'selected' : '' }}>
                                                            June</option>
                                                        <option value="7" {{$frommonth==7 ? 'selected' : '' }}>
                                                            July</option>
                                                        <option value="8" {{$frommonth==8 ? 'selected' : '' }}>
                                                            August</option>
                                                        <option value="9" {{$frommonth==9 ? 'selected' : '' }}>
                                                            September</option>
                                                        <option value="10" {{$frommonth==10 ? 'selected' : '' }}>October
                                                        </option>
                                                        <option value="11" {{$frommonth==11 ? 'selected' : '' }}>
                                                            November</option>
                                                        <option value="12" {{$frommonth==12 ? 'selected' : '' }}>
                                                            December</option>
                                                    </select>

                                                    <div class="filtname" data-translate="Filters">
                                                        To
                                                    </div>

                                                    <input type="number" id="year2" class="filterbox" min="1900"
                                                        max="2040" step="1" value="{{$toyear == 0 ? 2022 : $toyear}}" />

                                                    <select class="filterbox" id="month2" onchange="show_month()">
                                                        <option selected value="">--Select Month--</option>
                                                        <option value="1" {{$tomonth==1 ? 'selected' : '' }}>
                                                            January </option>
                                                        <option value="2" {{$tomonth==2 ? 'selected' : '' }}>
                                                            February</option>
                                                        <option value="3" {{$tomonth==3 ? 'selected' : '' }}>
                                                            March</option>
                                                        <option value="4" {{$tomonth==4 ? 'selected' : '' }}>
                                                            April</option>
                                                        <option value="5" {{$tomonth==5 ? 'selected' : '' }}>May
                                                        </option>
                                                        <option value="6" {{$tomonth==6 ? 'selected' : '' }}>
                                                            June</option>
                                                        <option value="7" {{$tomonth==7 ? 'selected' : '' }}>
                                                            July</option>
                                                        <option value="8" {{$tomonth==8 ? 'selected' : '' }}>
                                                            August</option>
                                                        <option value="9" {{$tomonth==9 ? 'selected' : '' }}>
                                                            September</option>
                                                        <option value="10" {{$tomonth==10 ? 'selected' : '' }}>
                                                            October</option>
                                                        <option value="11" {{$tomonth==11 ? 'selected' : '' }}>
                                                            November</option>
                                                        <option value="12" {{$tomonth==12 ? 'selected' : '' }}>
                                                            December</option>
                                                    </select>
                                                    <div class="righthead">
                                                        <button class="filterbut" data-translate="Search"
                                                            onclick="searchTeam(event)">
                                                            Generate
                                                        </button>
                                                    </div>
                                                </div>
                                                @php
                                                $expensetypename = array();
                                                $expenseamount = array();
                                                if($expenses){
                                                foreach($expenses as $expense){
                                                $expensetypename[] = $expense->getExpenseType->type;
                                                $expenseamount[] = $expense->amount;
                                                }
                                                }
                                                @endphp
                                                <span class="text-center mt-4">Capital Expenditure Pie Chart</span>
                                                <canvas id="myChart" style="width: 100%; max-width: 600px;"></canvas>
                                                <script>
                                                    var colors = [];
                          var expenseTypeName = @json($expensetypename);
                          var expenseAmount = @json($expenseamount);
                          var dynamicColors = function () {
                            var r = Math.floor(Math.random() * 255);
                            var g = Math.floor(Math.random() * 255);
                            var b = Math.floor(Math.random() * 255);
                            return "rgb(" + r + "," + g + "," + b + ")";
                          };
                          for(var i in expenseAmount)
                          {
                            colors.push(dynamicColors());
                          }
                        
                          var ctx = document.getElementById('myChart').getContext('2d');
                          var myChart = new Chart(ctx, {
                              type: 'pie',
                              data: {
                                  labels: expenseTypeName,
                                  datasets: [{
                                      label: '# of Votes',
                                      data: expenseAmount,
                                      backgroundColor: colors,
                                  }],
                              },
                          });
                                                </script>

                                                <div class="card-body table-responsive p-0" id="tableMain">
                                                    @if($expenses)
                                                    <div>
                                                        <table class="table table-striped table-valign-middle"
                                                            id="tablemainundefined">
                                                            <thead>
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Date</th>
                                                                    <th>Expense</th>
                                                                    <th>Amount</th>
                                                                    <th>Reciept</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @foreach($expenses as $expense)
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td>{{date('Y-m-d',strtotime($expense->date))}}</td>
                                                                    <td>{{$expense->getExpenseType->type}}</td>
                                                                    <td>{{$expense->amount}}</td>
                                                                    <td>
                                                                        <a href="{{asset('uploads/'.$expense->receipt)}}"
                                                                            target="_blank">
                                                                            <img style="height: 35px; width: 35px; border-radius: 50%;"
                                                                                src="{{asset('uploads/'.$expense->receipt)}}"
                                                                                alt="" />
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <i class="fas fa-trash"
                                                                            onclick="showDelete('{{$expense->id}}')"></i>
                                                                    </td>
                                                                <tr>
                                                                    @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="dialog">No data available</div>
                                                @endif
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

<div class="popup" id="createpop" style="display: none;">
    <div class="card" style="
        border-bottom: 1px solid #e5e5e5;
        box-shadow: 0 5px 15px rgb(0 0 0 / 50%);
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 6px;
        outline: 0;
      ">
        <div class="card-body table-responsive p-0" style="padding: 5px !important;">
            <div class="dialog">
                Create expense type
            </div>
            <div class="dialog">
                <form action="{{route('addExpenseType')}}" method="post">
                    @csrf
                    <div class="flex">
                        <label for="" style="text-align: left;">Cost category</label>

                        <select class="form-control form-rounded" name="category_id" id="costcateg">
                            @if($costCategories)
                            @foreach($costCategories as $costCategory)
                            <option value="{{$costCategory->id}}">{{$costCategory->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="flex">
                        <label for="" style="text-align: left;">Type</label>
                        <input style="max-width: 322px; margin-left: auto;" name="type" class="form-control" type="text"
                            id="createinptype" placeholder="Type" />
                    </div>
                    <div class="flex">
                        <button type="submit" class="btn btn-block btn-primary" style="
                      width: 100px;
                      margin-left: auto;
                      margin-top: 30px;
                      margin-right: 5px;
                      color: #fff;
                      background-color: #337ab7;
                      border-color: #2e6da4;
                    " data-translate="Yes">
                            Create
                        </button>
                        <button type="button" class="btn btn-block btn-primary" style="
                      width: 100px;
                      margin-right: auto;
                      margin-top: 30px;
                      margin-left: 5px;
                      color: #333;
                      background-color: #fff;
                      border-color: #ccc;
                    " data-translate="No" onclick="hideCreateExpType()">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>

        </div>
        <!--  -->
    </div>
</div>
<div class="popup" id="createpop1" style="display: none;">
    <div class="card" style="
        border-bottom: 1px solid #e5e5e5;
        box-shadow: 0 5px 15px rgb(0 0 0 / 50%);
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 6px;
        outline: 0;
      ">
        <div class="card-body table-responsive p-0" style="padding: 5px !important;">
            <form action="{{route('addExpense')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="dialog">
                    Add expense
                </div>
                <div class="dialog">
                    <div class="flex">
                        <label for="">Date</label>
                        <input style="margin-left: 33px;" type="number" name="year" id="year3" class="filterbox"
                            min="1900" max="2040" step="1" value="2022" />
                        <select style="width: 100%; margin-right: 0; max-width: 100%;" name="month" class="filterbox"
                            id="month3">
                            <option selected value="">--Select Month--</option>
                            <option value="1">January </option>
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
                    </div>
                    <div class="flex">
                        <label class="mr-10" for="">Expense</label>
                        <select class="form-control form-rounded filterbox1" name="expense_relation_id" id="expenses">
                            @if($expensestypes)
                            @foreach($expensestypes as $expenseType)
                            <option value="{{$expenseType->id.'__'.$expenseType->category_id}}">{{$expenseType->type}}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="flex">
                        <label for="" class="mr-10">Amount</label>
                        <input id="amount" class="filterbox1" name="amount" type="number" />
                    </div>
                    <div class="flex">
                        <label class="mr-10" for="">Reciept</label>
                        <input id="reciept" name="receipt" type="file" class="filterbox1" accept=".png,.jpg,.jpeg" />
                    </div>
                </div>

                <div class="flex">
                    <button type="submit" class="btn btn-block btn-primary" style="
              width: 100px;
              margin-left: auto;
              margin-top: 30px;
              margin-right: 5px;
              color: #fff;
              background-color: #337ab7;
              border-color: #2e6da4;
            " data-translate="Yes">
                        Create
                    </button>
                    <button type="button" class="btn btn-block btn-primary" style="
              width: 100px;
              margin-right: auto;
              margin-top: 30px;
              margin-left: 5px;
              color: #333;
              background-color: #fff;
              border-color: #ccc;
            " data-translate="No" onclick="hideAddExp()">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
        <!--  -->
    </div>
</div>

<div class="popup" id="deletepop" style="display: none;">
    <div class="card" style="
        border-bottom: 1px solid #e5e5e5;
        box-shadow: 0 5px 15px rgb(0 0 0 / 50%);
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 6px;
        outline: 0;
      ">
        <div class="card-body table-responsive p-0" style="padding: 5px !important;">
            <div class="dialog">
                Do you want to delete the expense?
            </div>

            <form action="{{route('deleteCost')}}" method="post">
                @csrf
                <div class="flex">
                    <input type="hidden" name="id" id="idofcost">
                    <button type="submit" class="btn btn-block btn-primary" style="
              width: 100px;
              margin-left: auto;
              margin-top: 30px;
              margin-right: 5px;
              color: #fff;
              background-color: #337ab7;
              border-color: #2e6da4;
            " data-translate="Yes">
                        Yes
                    </button>
                    <button type="button" class="btn btn-block btn-primary" style="
              width: 100px;
              margin-right: auto;
              margin-top: 30px;
              margin-left: 5px;
              color: #333;
              background-color: #fff;
              border-color: #ccc;
            " data-translate="No" onclick="hideDelete()">
                        No
                    </button>
                </div>
            </form>
        </div>
        <!--  -->
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

    /*  */
</style>
@endpush
@push('scripts')
<script>
    function showCreateExpType() {
    document.getElementById("createpop").style.display = "flex";
  }

  function hideCreateExpType() {
    document.getElementById("createpop").style.display = "none";
  }

  function showAddExp() {
    document.getElementById("createpop1").style.display = "flex";
  }

  function hideAddExp() {
    document.getElementById("createpop1").style.display = "none";
  }

  function showDelete(id) {
    document.getElementById("deletepop").style.display = "flex";
    selectedState = id;
    document.getElementById('idofcost').value = id;
  }

  function hideDelete() {
    document.getElementById("deletepop").style.display = "none";
  }

  function searchTeam(event) {
    event.preventDefault();
    var fromYear = document.getElementById("year1").value;
    var fromMonth = document.getElementById("month1").value;
    var toYear = document.getElementById("year2").value;
    var toMonth = document.getElementById("month2").value;

    if (
      fromYear == "" ||
      fromYear == " " ||
      fromMonth == "" ||
      fromMonth == " " ||
      toYear == "" ||
      toYear == " " ||
      toMonth == "" ||
      toMonth == " "
    ) {
      toastr.error("Enter all required fields.");
      return;
    } else {
      window.location.replace(
        "{{route('showCapitalExpenditure')}}/?fromyear=" +
          fromYear +
          "&frommonth=" +
          fromMonth +
          "&toyear=" +
          toYear +
          "&tomonth=" +
          toMonth
      );
    }
  }

  function getParam(param) {
    return new URLSearchParams(window.location.search).get(param);
  }
</script>
@endpush