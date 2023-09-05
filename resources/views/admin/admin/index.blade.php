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
                                <h4 class="card-title mb-0">Admins List</h4>
                            </div>
                            <a href="{{route('admins.create')}}" class="btn btn-primary">Add New</a>
                            {{-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addContact">Add New</a> --}}
                        </div>
                        <div class="card-body">
                            @if (count($data) > 0)
                                <div class="table-responsive">
                                    {{--  data-table --}}
                                    <table class="table data-table" style="width:100%">
                                        {{-- data-tables  --}}
                                        <thead>
                                            <tr>
                                                <th>Sr#</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone No.</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $admin)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>
                                                        <img src="{{ asset('images/admins/'.$admin->picture) }}" onerror="this.onerror=null;this.src='{{ asset('admin/images/user/user-dummy-img.png') }}';" alt="{{ $admin->first_name }}"  class="rounded avatar-40 img-fluid" >
                                                    </td>
                                                    <td>{{$admin->first_name}} {{$admin->last_name}}</td>
                                                    <td>{{$admin->email}}</td>
                                                    <td>{{$admin->mobile_number}}</td>
                                                    <td>{!! getGeneralStatus($admin->status, 'badge') !!}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center list-action">
                                                            <a class="badge bg-warning-light mr-2" data-toggle="tooltip"
                                                                data-placement="top" title="" data-original-title="Edit"
                                                                href="{{ route('admins.edit', $admin->id) }}">
                                                                <i class="fa fa-pen"></i>
                                                            </a>
                                                            {{-- <a class="badge bg-danger-light mr-2 rtl-ml-2" data-toggle="modal tooltip"
                                                                data-target=".deleteModal" data-placement="top" title="" 
                                                                data-original-title="Delete" 
                                                                href="#deleteRecord{{$admin->id}}"
                                                                href="#" id="deleteOrder" delete-id="{{$admin->id}}">
                                                                    <i class="lar la-eye"></i>
                                                            </a> --}}

                                                            {{-- <span class="badge bg-primary-light" data-toggle="tooltip"
                                                                data-placement="top" title="" data-original-title="Action"
                                                                href="#">
                                                                <div class="dropdown">
                                                                    <span class="text-primary dropdown-toggle action-item"
                                                                        id="moreOptions1" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false" href="#">

                                                                    </span>
                                                                    <div class="dropdown-menu" aria-labelledby="moreOptions1">
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Delete</a>
                                                                        <a class="dropdown-item" href="#">Hide from Contacts</a>
                                                                    </div>
                                                                </div>
                                                            </span> --}}

                                                                                
                                                            <!-- Delete Modal -->  
                                                            {{-- show --}}
                                                            {{-- <div class="modal fade bd-example-modal-sm" id="deleteOrder" tabindex="-1" role="dialog" bis_skin_checked="1" style="padding-right: 4px; display: block;" aria-modal="true">
                                                                <div class="modal-dialog modal-sm" bis_skin_checked="1">
                                                                    <div class="modal-content" bis_skin_checked="1">
                                                                        <div class="modal-header" bis_skin_checked="1">
                                                                        <h5 class="modal-title">Modal title</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                        </button>
                                                                        </div>
                                                                        <div class="modal-body" bis_skin_checked="1">
                                                                            <h4>You are about to delete a record ?</h4>
                                                                            <p class="text-muted fs-14 mb-4">By deleting, this record will remove permanently.</p>
                                                                        </div>
                                                                        <div class="modal-footer" bis_skin_checked="1">
                                                                            <form method="POST" action="{{ route('admins.destroy', ['admin' => $admin->id]) }}">
                                                                                @method('DELETE')
                                                                                @csrf
                                                                                <button type="submit" class="btn btn-danger float-right">Yes, Delete It</button>
                                                                                <a href="{{ route('admins.index') }}" class="btn btn-secondary float-right mr-1">Cancel</a>
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
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


@push('script')
    <script>
        $(document).ready(function(){
            $(document).on('click', '#deleteOrder', function(){
                let deleteId = $(this).attr('delete-id');
                let id = $(this).attr('id');
                $(id).modal('show');
            })
        })
    </script>
@endpush