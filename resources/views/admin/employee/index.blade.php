<x-app-layout>
    <div class="content-page rtl-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        {{--  card-block card-stretch card-height --}}
                        <div class="card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title mb-0">Employees List</h4>
                            </div>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addContact">Add New</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                {{--  data-table --}}
                                <table class="table" style="width:100%">
                                    {{-- data-tables  --}}
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone No.</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $employee)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('images/admin/'.$employee->picture) }}" onerror="this.onerror=null;this.src='{{ asset('admin/images/user/user-dummy-img.png') }}';" alt="{{ $employee->first_name }}"  class="rounded avatar-40 img-fluid" >
                                                </td>
                                                <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                                                <td>{{$employee->email}}</td>
                                                <td>{{$employee->mobile_number}}</td>
                                                <td>
                                                    <div class="d-flex align-items-center list-action">
                                                        <a class="badge bg-warning-light mr-2" data-toggle="tooltip"
                                                            data-placement="top" title="" data-original-title="Rating"
                                                            href="#"><i class="far fa-star"></i></a>
                                                        <a class="badge bg-success-light mr-2 rtl-ml-2" data-toggle="tooltip"
                                                            data-placement="top" title="" data-original-title="View"
                                                            href="#"><i class="lar la-eye"></i></a>
                                                        <span class="badge bg-primary-light" data-toggle="tooltip"
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
                                                                    <a class="dropdown-item" href="#">Hide from
                                                                        Contacts</a>
                                                                </div>
                                                            </div>
                                                        </span>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>