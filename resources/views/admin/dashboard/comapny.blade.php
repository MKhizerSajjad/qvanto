
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="d-flex align-items-center justify-content-between welcome-content">
            <div class="navbar-breadcrumb">
                <h4 class="mb-0">Welcome To Dashboard</h4>
            </div>
            {{-- <div class="">
                <a class="button btn btn-skyblue button-icon" href="#">Facebook<i
                        class="ml-2 ri-arrow-down-s-fill"></i></a>
                <a class="button btn btn-primary ml-2 button-icon rounded-small rtl-mr-2 rtl-ml-0"
                    href="#"><i class="ri-add-line m-0"></i></a>
            </div> --}}
        </div>
    </div>

    <div class="container-fluid pt-4">
        <div class="col-12">
            <div class="row">
                <div class="col-3">
                    <div class="row">
                        <div class="col-11 card bg-secondary w-25 p-3 mx-2">
                            <div class="row">
                                <div class="text-white col-12">
                                    <i class="fas fa-users fa-3x"></i>
                                </div>
                                <div class="text-white col-8">
                                    Associati
                                </div>
                                <div class="text-white col-4 text-right font-size-20">
                                    {{$count->vendor}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-11 card bg-info w-25 p-3 mx-2">
                            <div class="row">
                                <div class="text-white col-12">
                                    <i class="fas fa-bullhorn fa-3x"></i>
                                </div>
                                <div class="text-white col-8">
                                    Leads Totali
                                </div>
                                <div class="text-white col-4 text-right font-size-20">
                                    {{$count->leadTotal}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-11 card bg-success w-25 p-3 mx-2">
                            <div class="row">
                                <div class="text-white col-12">
                                    <i class="fas fa-check fa-3x"></i>
                                </div>
                                <div class="text-white col-8">
                                    Convertiti
                                </div>
                                <div class="text-white col-4 text-right font-size-20">
                                    {{$count->leadResolved}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-11 card bg-warning w-25 p-3 mx-2">
                            <div class="row">
                                <div class="text-white col-12">
                                    <i class="fas fa-retweet fa-3x"></i>
                                </div>
                                <div class="text-white col-8">
                                    In Corso
                                </div>
                                <div class="text-white col-4 text-right font-size-20">
                                    {{$count->leadPending}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header border-none">
                <div class="header-title">
                    <h4 class="card-title">Stato </h4>
                </div>
            </div>
            <div class="card-body">
                <div id="casesStatusChart"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card card-block card-stretch card-height">
            <div class="card-header border-none">
                <div class="header-title">
                    <h4 class="card-title">Statistics</h4>
                </div>
            </div>
            <div class="card-body">
                <div id="caseStatusSplineChart"></div>
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-12">
        <div class="card card-block card-stretch card-height">
            <div class="card-header border-none">
                <div class="header-title">
                    <h4 class="card-title">Account Statistics</h4>
                </div>
            </div>
            <div class="card-body">
                <div id="accountsChart"></div>
            </div>
        </div>
    </div> --}}


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title mb-0">Top Associati</h4>
                </div>
            </div>

            <div class="card-body">
                @if (count($topVendors) > 0)
                    <div class="table-responsive">
                        <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Photo</th>
                                    <th>Conversioni (%)</th>
                                    <th>Non Convertiti (%)</th>
                                    <th>Total</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Cellulare</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topVendors as $key => $vendor)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>
                                            <img src="{{ asset('images/vendors/'.$vendor->picture) }}" onerror="this.onerror=null;this.src='{{ asset('admin/images/user/user-dummy-img.png') }}';" alt="{{ $vendor->first_name }}"  class="rounded avatar-40 img-fluid" >
                                        </td>
                                        <td>{{isset($vendor->leads[0]) ? ($vendor->leads[0]->Resolved / $vendor->leads[0]->total) * 100 : '-'}}</td>
                                        <td>{{isset($vendor->leads[0]) ?($vendor->leads[0]->Withdrawed / $vendor->leads[0]->total) * 100 : '-'}}</td>
                                        <td>{{isset($vendor->leads[0]) ? $vendor->leads[0]->total : '-'}}</td>
                                        <td>{{$vendor->first_name}} {{$vendor->last_name}}</td>
                                        <td>{{$vendor->email}}</td>
                                        <td>{{$vendor->mobile_number}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h4 class="text text-center text-danger font-weight-bold p-5">No Vednors Found</h4>
                @endif
            </div>
        </div>
    </div>
</div>



<script>

    // Case Status wise chart - Multiple Radialbars
    // Extract the 'count' values from the $2 result
    var seriesData = {!! json_encode($caseStatusCounts->pluck('count')->toArray()) !!};

    var options = {
        series: seriesData, // Use the 'count' values as the series data
        chart: {
            height: 350,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: '22px',
                    },
                    value: {
                        fontSize: '16px',
                    },
                    total: {
                        show: true,
                        label: 'Totali',
                        formatter: function (w) {
                            // Calculate the sum of all 'count' values
                            var total = seriesData.reduce((a, b) => a + b, 0);
                            return total;
                        }
                    }
                }
            }
        },
        labels: {!! json_encode($caseStatusCounts->pluck('label')->toArray()) !!} // Use the 'label' values as labels
    };

    var chart = new ApexCharts(document.querySelector("#casesStatusChart"), options);
    chart.render();

    // Line Chart
    // var seriesData = {!! json_encode($caseStatusCounts2->groupBy('status')->toArray()) !!};

    // var options = {
    //     series: Object.values(seriesData).map((data) => ({
    //         name: data[0].label,
    //         data: data.map((item) => item.count),
    //     })),
    //     chart: {
    //         height: 350,
    //         type: 'area',
    //     },
    //     dataLabels: {
    //         enabled: false,
    //     },
    //     stroke: {
    //         curve: 'smooth',
    //     },
    //     xaxis: {
    //         type: 'datetime',
    //         categories: seriesData[Object.keys(seriesData)[0]].map((item) => item.date),
    //     },
    //     tooltip: {
    //         x: {
    //             format: 'dd/TMM/yy HH:mm',
    //         },
    //     },
    // };

    // var chart = new ApexCharts(document.querySelector("#caseStatusSplineChart"), options);
    // chart.render();

    var seriesData = {!! json_encode($caseStatusCounts2->groupBy('date')->toArray()) !!};

    var options = {
        series: [
            {
                name: 'Leads Totali',
                data: Object.values(seriesData).map((data) => data[0].total_cases),
            },
            {
                name: 'Conversioni',
                data: Object.values(seriesData).map((data) => data[0].resolved_cases),
            },
        ],
        chart: {
            height: 350,
            type: 'area',
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: 'smooth',
        },
        xaxis: {
            categories: Object.values(seriesData).map((data) => data[0].date),
            labels: {
                formatter: function (value) {
                    return value;
                }
            }
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy',
            },
        },
        // title: {
        //     text: 'Monthly Cases',
        //     align: 'left'
        // },
    };

    var chart = new ApexCharts(document.querySelector("#caseStatusSplineChart"), options);
    chart.render();


    // Accounts Chart
    var casesAmounts = @json($casesAmounts);
    var options = {
    series: [{
        name: 'Total Amount',
        type: 'column',
        data: casesAmounts.map(entry => entry.total_amount),
    }, {
        name: 'Commission Amount',
        type: 'column',
        data: casesAmounts.map(entry => entry.commission_amount),
    }, {
        name: 'Profit Amount',
        type: 'line',
        data: casesAmounts.map(entry => entry.profit_amount),
    }],
    chart: {
        height: 350,
        type: 'line',
        stacked: false,
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: [1, 1, 4],
    },
    // title: {
    //     text: 'XYZ - Stock Analysis (2009 - 2016)',
    //     align: 'left',
    //     offsetX: 110,
    // },
    xaxis: {
        categories: casesAmounts.map(entry => entry.date), // Use the date from the query result
    },
    // ... (rest of your options)
    };

    var chart = new ApexCharts(document.querySelector("#accountsChart"), options);
    chart.render();

</script>
