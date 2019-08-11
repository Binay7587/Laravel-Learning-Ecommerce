@extends('admin.layouts.master')
@section('title', 'Admin Dashboard | Admin Nayabazar')
@section('main-content')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">201</h2>
                    <div class="m-b-5">NEW ORDERS</div><i class="ti-shopping-cart widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>25% higher</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">1250</h2>
                    <div class="m-b-5">UNIQUE VIEWS</div><i class="ti-bar-chart widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>17% higher</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-warning color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">$1570</h2>
                    <div class="m-b-5">TOTAL INCOME</div><i class="fa fa-money widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>22% higher</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-danger color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">108</h2>
                    <div class="m-b-5">NEW USERS</div><i class="ti-user widget-stat-icon"></i>
                    <div><i class="fa fa-level-down m-r-5"></i><small>-12% Lower</small></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-body">
                    <div class="flexbox mb-4">
                        <div>
                            <h3 class="m-0">Statistics</h3>
                            <div>Your shop sales analytics</div>
                        </div>
                        <div class="d-inline-flex">
                            <div class="px-3" style="border-right: 1px solid rgba(0,0,0,.1);">
                                <div class="text-muted">WEEKLY INCOME</div>
                                <div>
                                    <span class="h2 m-0">$850</span>
                                    <span class="text-success ml-2"><i class="fa fa-level-up"></i> +25%</span>
                                </div>
                            </div>
                            <div class="px-3">
                                <div class="text-muted">WEEKLY SALES</div>
                                <div>
                                    <span class="h2 m-0">240</span>
                                    <span class="text-warning ml-2"><i class="fa fa-level-down"></i> -12%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <canvas id="bar_chart" style="height:260px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Latest Orders</div>

                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th width="91px">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <a href="invoice.html">AT2584</a>
                            </td>
                            <td>@Jack</td>
                            <td>$564.00</td>
                            <td>
                                <span class="badge badge-success">Shipped</span>
                            </td>
                            <td>10/07/2017</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice.html">AT2575</a>
                            </td>
                            <td>@Amalia</td>
                            <td>$220.60</td>
                            <td>
                                <span class="badge badge-success">Shipped</span>
                            </td>
                            <td>10/07/2017</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice.html">AT1204</a>
                            </td>
                            <td>@Emma</td>
                            <td>$760.00</td>
                            <td>
                                <span class="badge badge-default">Pending</span>
                            </td>
                            <td>10/07/2017</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice.html">AT7578</a>
                            </td>
                            <td>@James</td>
                            <td>$87.60</td>
                            <td>
                                <span class="badge badge-warning">Expired</span>
                            </td>
                            <td>10/07/2017</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice.html">AT0158</a>
                            </td>
                            <td>@Ava</td>
                            <td>$430.50</td>
                            <td>
                                <span class="badge badge-default">Pending</span>
                            </td>
                            <td>10/07/2017</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice.html">AT0127</a>
                            </td>
                            <td>@Noah</td>
                            <td>$64.00</td>
                            <td>
                                <span class="badge badge-success">Shipped</span>
                            </td>
                            <td>10/07/2017</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <!-- PAGE LEVEL PLUGINS-->
    <script src="{{ asset('js/Chart.min.js') }}" type="text/javascript"></script>

    <script>

        $(function() {
            var a = {
                    labels: ["Sunday", "Munday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                    datasets: [{
                        label: "Data 1",
                        borderColor: 'rgba(52,152,219,1)',
                        backgroundColor: 'rgba(52,152,219,1)',
                        pointBackgroundColor: 'rgba(52,152,219,1)',
                        data: [29, 48, 40, 19, 78, 31, 85]
                    },{
                        label: "Data 2",
                        backgroundColor: "#DADDE0",
                        borderColor: "#DADDE0",
                        data: [45, 80, 58, 74, 54, 59, 40]
                    }]
                },
                t = {
                    responsive: !0,
                    maintainAspectRatio: !1
                },
                e = document.getElementById("bar_chart").getContext("2d");
            new Chart(e, {
                type: "line",
                data: a,
                options: t
            });


            var doughnutData = {
                labels: ["Desktop","Tablet","Mobile" ],
                datasets: [{
                    data: [47,30,23],
                    backgroundColor: ["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"]
                }]
            } ;


            var doughnutOptions = {
                responsive: true,
                legend: {
                    display: false
                },
            };


            var ctx4 = document.getElementById("doughnut_chart").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});


        });
    </script>
    @endsection
