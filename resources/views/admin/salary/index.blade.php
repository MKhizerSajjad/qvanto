<x-app-layout>
    <div class="content-page rtl-page">
        <div class="container-fluid">
            
            @if ($message = Session::get('success'))
                <div class="alert alert-success auto-colse-3" role="alert" bis_skin_checked="1">
                    {{-- <div class="iq-alert-icon"> --}}
                        <i class="ri-check-double-line"></i>
                    {{-- </div> --}}
                    <div class="iq-alert-text" bis_skin_checked="1">
                        <b>Success!</b> {{ $message }}
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        {{--  card-block card-stretch card-height --}}
                        <div class="card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title mb-0">Salaries List</h4>
                            </div>
                            <a href="{{route('salary.create')}}" class="btn btn-primary">Add New</a>
                            {{-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addContact">Add New</a> --}}
                        </div>

                        <div class="card-body">
                            @if (count($data) > 0)
                                <div class="table-responsive">
                                    {{--  data-table --}}
                                    <table class="table" style="width:100%">
                                        {{-- data-tables  --}}
                                        <thead>
                                            <tr>
                                                <th>Sr#</th>
                                                <th>Month</th>
                                                <th>Employee</th>
                                                <th>Total Amount</th>
                                                <th>Is Published</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $salary)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{ date('M Y', strtotime($salary->year_month)) }}</td>
                                                    <td>{{$salary->employee->first_name}} {{$salary->employee->last_name}}</td>
                                                    <td>{{$salary->total_amount}}</td>
                                                    <td>{!! getYesNo($salary->is_published, 'badge') !!}</td>
                                                    <td>{!! getPaymentStatus($salary->status, 'badge') !!}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center list-action">
                                                            <a class="badge bg-warning-light mr-2" data-toggle="tooltip"
                                                                data-placement="top" title="" data-original-title="Edit"
                                                                href="{{ route('salary.edit', $salary->id) }}">
                                                                <i class="fa fa-pen"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if ($data->hasPages())
                                    <div class="d-flex justify-content-end  mt-3 me-3">
                                        <div class="pagination-wrap">
                                    {{-- <div class="row justify-content-between mt-3">
                                        <div class="col-md-6" bis_skin_checked="1"> --}}
                                            <div class="pagination  justify-content-end mb-0">
                                                {{ $data->onEachSide(5)->links() }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            @else
                                <h4 class="text text-center text-danger font-weight-bold p-5">No Record Found</h4>    
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>