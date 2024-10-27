
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
    @php
        if (Auth::user()->user_type == 1) {
            $show = true;
            $col = "col-sm-12 col-md-3";
        } else {
            $show = false;
            $col = "col-sm-12 col-md-4";
        }
    @endphp
    <div class="container-fluid px-4" style="display: {{ request()->has('vendor') || request()->has('lead_type') || request()->has('status') || request()->has('from') || request()->has('to') ? 'block' : 'none' }};">
        <div class="alert alert-info pb-0" role="alert" bis_skin_checked="1">
            <i class="fa fa-search pt-1"></i>

            <div class="iq-alert-text" bis_skin_checked="1">
                <ul class="row">
                    <strong>Applied Filters:</strong>
                    @if(request()->get('vendor'))
                        <li class="ml-4">Associati: {{ $vendors->where('id', request()->get('vendor'))->first()->first_name ?? '' }}</li>
                    @endif
                    @if(request()->get('lead_type'))
                        <li class="ml-4">Lead Tipologia: {{ getLeadType(request()->get('lead_type')) }}</li>
                    @endif
                    @if(request()->get('status'))
                        <li class="ml-4">Stato: {{ getLeadStatus(request()->get('status')) }}</li>
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

                @if ($show)
                <div class="{{ $col }}">
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
                @endif
                <div class="{{ $col }}">
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
                <div class="{{ $col }}">
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
                <div class="{{ $col }}">
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
                                        @php
                                        $lead = isset($vendor->leads[0]) ? $vendor->leads[0] : null;
                                        $converted = $lead ? ((int)$lead->{'Fatto Watt'} ?? 0) + ((int)$lead->{'Chiuso Spark 2up'} ?? 0) + ((int)$lead->{'Chiuso Spark 1up'} ?? 0) : 0;
                                        $notConverted = $lead ? ((int)$lead->{'In Chiusura'} ?? 0) + ((int)$lead->{'Non Risponde'} ?? 0) + ((int)$lead->{'Mi Ha Bloccato'} ?? 0) + ((int)$lead->{'Rimandato'} ?? 0) : 0;
                                        $convt = $lead && $lead->total ? ($converted / $lead->total) * 100 : 0;
                                        $notConvt = $lead && $lead->total ? ($notConverted / $lead->total) * 100 : 0;
                                    @endphp
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            <img src="{{ asset('images/vendors/'.$vendor->picture) }}" onerror="this.onerror=null;this.src='{{ asset('admin/images/user/user-dummy-img.png') }}';" alt="{{ $vendor->first_name }}" class="rounded avatar-40 img-fluid">
                                        </td>
                                        <td>{{ numberFormat($convt, 'percentage') }} ({{$converted}})</td>
                                        <td>{{ numberFormat($notConvt, 'percentage') }} ({{$notConverted}})</td>
                                        <td>{{ isset($lead) ? $lead->total : '-' }}</td>
                                        <td>{{ $vendor->first_name }} {{ $vendor->last_name }}</td>
                                        <td>{{ $vendor->email }}</td>
                                        <td>{{ $vendor->mobile_number }}</td>
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

    // Define the colors for each status
    var statusColors = [
        '#41d394', // Status 1
        '#41d394', // Status 2
        '#836cff', // Status 3
        '#fdc941', // Status 4
        '#fe4c4a', // Status 5
        '#6c757e', // Status 6
        '#41d394'  // Status 7
    ];

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
        series: seriesData, // use count
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
        tooltip: {
            y: {
                formatter: function(val) {
                    return val; //+ "%"; // Add percentage sign
                }
            }
        },
        // dataLabels: {
        //     enabled: true,
        //     formatter: function(val) {
        //         return val + "%"; // Add percentage sign to data labels
        //     }
        // },
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
        }],
        colors: ['#41d394', '#41d394', '#836cff', '#fdc941', '#fe4c4a', '#6c757e', '#41d394'], // Add your colors here
    };

    var chart = new ApexCharts(document.querySelector("#casesStatusChart"), options);
    chart.render();

    // The data passed from PHP to JavaScript
    var seriesData = {!! json_encode($caseStatusCounts2->groupBy('date')->toArray()) !!};
    var statusLabels = {!! json_encode(array_values($statusMappings)) !!};  // Status labels passed from PHP

    var options = {
        series: [],
        chart: {
            height: 350,
            type: 'line',
            background: 'transparent',
        },
        dataLabels: {
            enabled: false,
        },
        theme: {
            mode: 'dark',
            palette: 'palette1',
            monochrome: {
                enabled: false
            }
        },
        stroke: {
            curve: 'smooth',
        },
        xaxis: {
            categories: Object.values(seriesData).map((data) => data[0].date), // Dates on the X-axis
            labels: {
                formatter: function (value) {
                    return value; // Optionally format the date
                }
            }
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy', // Tooltip date format
            },
            y: {
                formatter: function (value, { seriesIndex, dataPointIndex, w }) {
                    if (seriesIndex < statusLabels.length) { // For status series
                        return w.config.series[seriesIndex].data[dataPointIndex]; // Show status count
                    }
                    return value; // Show other values (total cases)
                }
            }
        },
        colors: ['#275894', '#41d394', '#41d394', '#836cff', '#fdc941', '#fe4c4a', '#6c757e', '#41d394'], // Add your colors here
    };

    // Add the total cases series (Leads Totali)
    options.series.push({
        name: 'Leads Totali',
        data: Object.values(seriesData).map((data) => data[0].total_cases), // Total cases
    });

    // Add the status series dynamically based on the statusMappings
    statusLabels.forEach(function(label) {
        options.series.push({
            name: label, // Status name as the series name
            data: Object.values(seriesData).map((data) => data[0][label]), // Corresponding status count
        });
    });

    // Initialize and render the chart
    var chart = new ApexCharts(document.querySelector("#caseStatusSplineChart"), options);
    chart.render();


// // The data passed from PHP to JavaScript
// var seriesData = {!! json_encode($caseStatusCounts2->groupBy('date')->toArray()) !!};
// var statusLabels = {!! json_encode(array_values($statusMappings)) !!};  // Status labels passed from PHP

// var options = {
//     series: [{
//         name: 'Leads Totali',
//         data: Object.values(seriesData).map((data) => data[0].total_cases), // Total cases
//     }],
//     chart: {
//         height: 350,
//         type: 'line',
//         zoom: {
//             enabled: false
//         }
//     },
//     dataLabels: {
//         enabled: false
//     },
//     stroke: {
//         curve: 'straight'
//     },
//     title: {
//         text: 'Case Status Trends',
//         align: 'left'
//     },
//     grid: {
//         row: {
//             colors: ['#f3f3f3', 'transparent'],
//             opacity: 0.5
//         }
//     },
//     xaxis: {
//         categories: Object.values(seriesData).map((data) => data[0].date),
//         labels: {
//             formatter: function (value) {
//                 return value;
//             }
//         }
//     },
//     tooltip: {
//         x: {
//             format: 'dd/MM/yy',
//         },
//         y: {
//             formatter: function (value, { seriesIndex, dataPointIndex, w }) {
//                 if (seriesIndex < statusLabels.length + 1) {
//                     return w.config.series[seriesIndex].data[dataPointIndex]; // Show status count
//                 }
//                 return value; // Show other values (total cases)
//             }
//         },
//         style: {
//             fontSize: '12px', // Adjust font size if needed
//             background: '#000', // Dark background for tooltip
//             color: '#000', // White text for better contrast
//             border: '1px solid red', // Optional: border for better visibility
//         }
//     },
//     colors: ['#275894', '#41d394', '#836cff', '#fdc941', '#fe4c4a', '#6c757e'],
// };

// // Add the status series dynamically based on the statusMappings
// statusLabels.forEach(function(label) {
//     options.series.push({
//         name: label,
//         data: Object.values(seriesData).map((data) => data[0][label]),
//     });
// });

// // Initialize and render the chart
// var chart = new ApexCharts(document.querySelector("#caseStatusSplineChart"), options);
// chart.render();

</script>
