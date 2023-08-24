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
                                <h4 class="card-title mb-0">Appointments List</h4>
                            </div>
                            <a href="{{route('appointment.create')}}" class="btn btn-primary">Add New</a>
                            {{-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addContact">Add New</a> --}}
                        </div>

                        @php
                            if (Auth::user()->user_type == 3) {
                                $hideCustomer = true;
                                $hideEmployee = false;
                            } elseif(Auth::user()->user_type == 2) {
                                $hideCustomer = false;
                                $hideEmployee = true;
                            } else {
                                $hideCustomer = false;
                                $hideEmployee = false;
                            }                         
                        @endphp

                        <div class="card-body">
                            @if (count($data) > 0)
                                <div class="table-responsive">
                                    {{--  data-table --}}
                                    <table class="table" style="width:100%">
                                        {{-- data-tables  --}}
                                        <thead>
                                            <tr>
                                                <th>Sr#</th>
                                                <th>Case Type</th>
                                                @if($hideCustomer == false) 
                                                    <th>Customer</th>
                                                @endif
                                                @if($hideEmployee == false) 
                                                    <th>Employee</th>
                                                @endif
                                                <th>Date</th>
                                                {{-- <th>Is Accepted</th> --}}
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $appointment)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{getCaseTypes($appointment->case_type_id)}}</td>
                                                    @if($hideCustomer == false) 
                                                        <td>{{$appointment->customer->first_name}} {{$appointment->customer->last_name}}</td>
                                                    @endif
                                                    @if($hideEmployee == false) 
                                                        <td>{{isset($appointment->employee->first_name) ? $appointment->employee->first_name : ''}} {{isset($appointment->employee->last_name) ? $appointment->employee->last_name : ''}}</td>
                                                    
                                                    @endif
                                                    <td>{{$appointment->dated}}</td>
                                                    {{-- <td>{{$appointment->is_accepted}}</td> --}}
                                                    <td>{!! getAppointmentStatus($appointment->status, 'badge') !!}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center list-action">
                                                            <a class="badge bg-warning-light mr-2" data-toggle="tooltip"
                                                                data-placement="top" title="" data-original-title="Edit"
                                                                href="{{ route('appointment.edit', $appointment->id) }}">
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