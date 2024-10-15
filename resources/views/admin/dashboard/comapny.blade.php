
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="d-flex align-items-center justify-content-between welcome-content">
            <div class="navbar-breadcrumb">
                <h4 class="mb-0">Welcome To Dashboard</h4>
            </div>

            <div class="">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filters" title="Filters">
                    <i class="fa fa-search"></i>
                </button>
                <a href="{{route('dashboard')}}" type="button" class="btn btn-secondary" title="Remove Filters">
                    <i class="fa">&#xf00d;</i>
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid px-4" style="display: {{ request()->has('vendor') || request()->has('lead_type') || request()->has('status') || request()->has('from') || request()->has('to') ? 'block' : 'none' }};">
        <div class="alert alert-info pb-0" role="alert" bis_skin_checked="1">
            <i class="fa fa-search pt-1"></i>

            <div class="iq-alert-text" bis_skin_checked="1">
                <ul class="row">
                    <strong>Applied Filters:</strong>
                    @if(request()->get('vendor'))
                        <li class="ml-4">Vendor: {{ $vendors->where('id', request()->get('vendor'))->first()->first_name ?? '' }}</li>
                    @endif
                    @if(request()->get('lead_type'))
                        <li class="ml-4">Lead Type: {{ getLeadType(request()->get('lead_type')) }}</li>
                    @endif
                    @if(request()->get('status'))
                        <li class="ml-4">Status: {{ getLeadStatus(request()->get('status')) }}</li>
                    @endif
                    @if(request()->get('from'))
                        <li class="ml-4">From Date: {{ request()->get('from') }}</li>
                    @endif
                    @if(request()->get('to'))
                        <li class="ml-4">To Date: {{ request()->get('to') }}</li>
                    @endif
                </ul>
            </div>
            <button type="button" class="close pb-2 text text-info" data-dismiss="alert" aria-label="Close">
                <i class="ri-close-line"></i>
            </button>
        </div>
    </div>

    <div class="container-fluid pt-2">
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


    @if (Auth::user()->user_type == 1)
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
    @endif

    <div class="modal fade d-example-modal-lg" id="filters" tabindex="-1" role="dialog" aria-labelledby="filtersLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filtersLabel">Filter The Stato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="GET" action="{{ route('dashboard') }}">
                    <div class="modal-body">
                        <div class="row">

                            @if (Auth::user()->user_type == 1)
                                @php
                                    $col = 4;
                                @endphp
                                <div class="form-group col-md-{{$col}}">
                                    <label>Associato</label>
                                    <select class="form-control" id="vendor" name="vendor">
                                        <option value="">Select Associato</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}" {{ request('vendor') == $vendor->id ? 'selected' : '' }}>
                                                {{ $vendor->first_name }} {{ $vendor->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                @php
                                    $col = 6;
                                @endphp
                            @endif
                            <div class="form-group col-md-{{$col}}">
                                <label>Lead Tipologia</label>
                                <select class="form-control" id="lead_type" name="lead_type">
                                    <option value="">Select Tipologia Lead</option>
                                    @foreach (getLeadType() as $key => $type)
                                        <option value="{{ ++$key }}" {{ request('lead_type') == $key ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-{{$col}}">
                                <label>Stato</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">Select Stato</option>
                                    @foreach (getLeadStatus() as $index => $label)
                                        <option value="{{ ++$index }}" {{ request('status') == $index ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="from">From</label>
                                <input type="date" class="form-control" id="from" name="from" placeholder="Date Time" value="{{ request('from') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="to">To</label>
                                <input type="date" class="form-control" id="to" name="to" placeholder="Date Time" value="{{ request('to') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>

    // Case Status wise chart - Multiple Radialbars
    // Extract the 'count' values from the $2 result
    var seriesData = {!! json_encode($caseStatusCounts->pluck('count')->toArray()) !!};
    var labelsData = {!! json_encode($caseStatusCounts->pluck('label')->toArray()) !!};

    // Calculate total count
    var total = seriesData.reduce((acc, val) => acc + val, 0);
    // Calculate percentages
    var percentageData = seriesData.map(count => ((count / total) * 100).toFixed(2)); // Two decimal places

    var options = {
        series: percentageData, // Use percentage data
        // series: seriesData, // use count
        labels: labelsData,
        chart: {
          type: 'polarArea',
          background: 'transparent',
        },
        stroke: {
          colors: ['#fff']
        },
        theme: {
            mode: 'dark',
            palette: 'palette1',
            monochrome: {
                enabled: false
            }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'center',
            floating: false,
            fontSize: '14px',
            // fontFamily: undefined,
            fontWeight: 400,
            color: '#fff',
        },
        fill: {
          opacity: 0.8
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#casesStatusChart"), options);
    chart.render();

    // var options = {
    //       series: seriesData,
    //       labels: labelsData,
    //       chart: {
    //       type: 'donut',
    //     },
    //     responsive: [{
    //       breakpoint: 480,
    //       options: {
    //         chart: {
    //             height: 350,
    //         //   width: 200
    //         },
    //         legend: {
    //           position: 'bottom'
    //         }
    //       }
    //     }]
    // };

    // var chart = new ApexCharts(document.querySelector("#casesStatusChart"), options);
    // chart.render();

    // var options = {
    //     series: seriesData, // Use the 'count' values as the series data
    //     chart: {
    //         height: 350,
    //         type: 'radialBar',
    //     },
    //     plotOptions: {
    //         radialBar: {
    //             dataLabels: {
    //                 name: {
    //                     fontSize: '22px',
    //                 },
    //                 value: {
    //                     fontSize: '16px',
    //                 },
    //                 total: {
    //                     show: true,
    //                     label: 'Totali',
    //                     formatter: function (w) {
    //                         // Calculate the sum of all 'count' values
    //                         var total = seriesData.reduce((a, b) => Number(a) + Number(b), 0);
    //                         return total;
    //                     }
    //                 }
    //             }
    //         }
    //     },
    //     labels: {!! json_encode($caseStatusCounts->pluck('label')->toArray()) !!} // Use the 'label' values as labels
    // };

    // var chart = new ApexCharts(document.querySelector("#casesStatusChart"), options);
    // chart.render();

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
            background: 'transparent',
        },
        dataLabels: {
            enabled: false,
        },
        theme: {
            mode: 'dark',
            palette: 'palette4',
            monochrome: {
                enabled: false
            }
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

</script>
