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
            @php
                if (Auth::user()->user_type == 1) {
                    $restricted = false;
                } else {
                    $restricted = true;
                }
            @endphp
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title mb-0">Leads List</h4>
                            </div>

                            {{-- @if($restricted == false) --}}
                                <a href="{{route('lead.create')}}" class="btn btn-primary">Add New</a>
                            {{-- @endif --}}
                        </div>

                        <div class="card-body">
                            @if (count($data) > 0)
                                <div class="table-responsive">
                                    <table class="table data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sr#</th>
                                                <th>Nome</th>
                                                <th>Suriname </th>
                                                <th>Prone</th>
                                                <th>Email</th>
                                                @if($restricted == false)
                                                <th>Assciati</th>
                                                @endif
                                                <th>Data</th>
                                                <th>Tipologia</th>
                                                <th>Stato</th>
                                                <th>Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $lead)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{$lead->first_name ?? ''}}</td>
                                                    <td>{{$lead->last_name ?? ''}}</td>
                                                    <td>{{$lead->mobile_number ?? ''}}</td>
                                                    <td>{{$lead->email ?? ''}}</td>
                                                    @if($restricted == false)
                                                        <td>{{$lead->vendor->first_name ?? ''}}</td>
                                                    @endif
                                                    <td>{{$lead->dated}}</td>
                                                    <td>{!! getLeadType($lead->lead_type, 'badge')  !!}</td>
                                                    <td>{!! getLeadStatus($lead->status, 'badge') !!}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center list-action">
                                                            @if($restricted == false)
                                                                <a class="badge bg-warning-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="{{ route('lead.edit', $lead->id) }}">
                                                                    <i class="fa fa-pen"></i>
                                                                </a>
                                                            @endif
                                                            <a class="badge bg-primary-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Comment" href="{{ route('lead.comment', $lead->id) }}">
                                                                <i class="fa fa-comment"></i>
                                                            </a>
                                                            @if (count($lead->leadStatus) > 0)
                                                                <a href="" class="badge bg-success-light mr-2" data-toggle="modal" data-target="#exampleModalScrollable-{{$lead->id}}">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalScrollable-{{$lead->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Cronologia dello stato dei lead</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Timeline -->
                                                            <div class="timeline">
                                                                @foreach ($lead->leadStatus as $key => $stat)
                                                                    <div class="timeline-item font-size-16">
                                                                        {!! getTimelineStatus($stat->status, 'badge') !!}
                                                                        <div class="pl-20">
                                                                            <div class="d-flex justify-content-between">
                                                                                <p class="badge badge-secondary">{{ date('D d, M, Y', strtotime($stat->dated)) }}</p>
                                                                                <p class="badge badge-secondary">{{ $stat->user->first_name }}</p>
                                                                            </div>
                                                                            <p>{{ $stat->note }}</p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
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

<style>
    /* General Timeline Styles */
.timeline {
   position: relative;
   padding: 20px 0;
   margin: 0;
   list-style: none;
}

/* Timeline Items */
.timeline-item {
   position: relative;
   padding-left: 40px;
   margin-bottom: 20px;
   border-left: 2px solid #e0e0e0;
   padding-top: 10px;
   padding-bottom: 10px;
}

/* Timeline Marker (The circle or status indicator) */
.timeline-marker {
   position: absolute;
   left: -15px;
   top: 0;
   width: 30px;
   height: 30px;
   /* background-color: white;
   border: 2px solid #fff; */
   border-radius: 50%;
   text-align: center;
   line-height: 30px;
   color: white;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.modal-body {
   padding: 0 40px;
}

</style>
