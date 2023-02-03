<aside style="background-color: #fff !important;" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('static/img/avt.png')}}" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a href="javascript:void(0)" style="color: #000000;" class="d-block" data-translate="Admin panel">Hi,
                    {{Auth::user()->username}}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- <li class="nav-item">
              <a href="/dashboard/" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p data-translate="Dashboard">Dashboard</p>
              </a>
            </li> -->

                <li class="nav-item">
                    <a href="{{route('monthlydata')}}" class="nav-link">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p data-translate="Dashboard">Monthly data</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('cleaning')}}" class="nav-link">
                        <i class="nav-icon fas fa-broom"></i>
                        <p data-translate="Dashboard">Cleaning</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('keys')}}" class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p data-translate="Dashboard">Keys</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('revenue')}}" class="nav-link">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p data-translate="Dashboard">Revenue</p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="{{route('tax')}}" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p data-translate="Dashboard">Tax</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('calender')}}" class="nav-link">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p data-translate="Dashboard">Calendar</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route("showCapitalExpenditure")}}" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p data-translate="Dashboard">Capital expenditure</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('costs')}}" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p data-translate="Dashboard">Costs</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('map')}}" class="nav-link">
                        <i class="nav-icon fas fa-map"></i>
                        <p data-translate="Dashboard">Map</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('upload')}}" class="nav-link">
                        <i class="nav-icon fas fa-upload"></i>
                        <p data-translate="Dashboard">Upload data</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('settings')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p data-translate="Logout">Settings</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p data-translate="Logout">Logout</p>
                    </a>
                </li>

                <!-- <div id="google_translate_element"></div> -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<div class="popup" id="logoutpop" style="display: none;">
    <div class="card" style="
          border-bottom: 1px solid #e5e5e5;
          box-shadow: 0 5px 15px rgb(0 0 0 / 50%);
          border: 1px solid rgba(0, 0, 0, 0.2);
          border-radius: 6px;
          outline: 0;
        ">
        <div class="card-body table-responsive p-0" style="padding: 5px !important;">
            <div class="dialog" data-translate="Are you sure , you want to logout?">
                Are you sure , you want to logout?
            </div>

            <div class="flex">
                <button type="button" class="btn btn-block btn-primary" style="
                width: 100px;
                margin-left: auto;
                margin-top: 30px;
                margin-right: 5px;
                color: #fff;
                background-color: #337ab7;
                border-color: #2e6da4;
              " onclick="logout(event)" data-translate="Yes">
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
              " data-translate="No" onclick="hideLogout()">
                    No
                </button>
            </div>
        </div>
        <!--  -->
    </div>
</div>