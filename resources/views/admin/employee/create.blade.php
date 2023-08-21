<x-app-layout>
    <div class="content-page rtl-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12" bis_skin_checked="1">
                    <div class="card" bis_skin_checked="1">
                    <div class="card-header d-flex justify-content-between" bis_skin_checked="1">
                        <div class="header-title" bis_skin_checked="1">
                            <h4 class="card-title">Add New Employee</h4>
                        </div>
                    </div>
                    <div class="card-body" bis_skin_checked="1">
                    
                        @if (count($errors) > 0)
                            <div class="alert alert-danger" role="alert" bis_skin_checked="1">
                                <div class="iq-alert-icon" bis_skin_checked="1">
                                    <i class="ri-information-line"></i>
                                </div>
                                <div class="iq-alert-text" bis_skin_checked="1">
                                    <b>Whoops!</b> There were some problems with your input
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                        @endif
                    
                        <div class="new-user-info" bis_skin_checked="1">
                            <form method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row" bis_skin_checked="1">
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="first_name">First Name <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="last_name">Last Name <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="picture">Picture</label>
                                        <input type="file" id="picture" name="picture" placeholder="Picture" value="{{ old('picture') }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="email">Email <span class="text text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="mobile_number">Mobile Number <span class="text text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number" value="{{ old('mobile_number') }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="nic">NIC <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nic" name="nic" placeholder="NIC" value="{{ old('nic') }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="basic_salary">Basic Salary <span class="text text-danger">*</span></label>
                                        <input type="number" class="form-control" id="basic_salary" name="basic_salary" placeholder="Basic Salary" value="{{ old('basic_salary') }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="zipcode">Zip Code</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Zip Code">
                                    </div>
                                    <div class="form-group col-sm-4" bis_skin_checked="1">
                                        <label>Status <span class="text text-danger">*</span></label>
                                        <div class="dropdown form-control" bis_skin_checked="1">
                                            <select class="form-control" id="status" name="status">
                                                <option>Select Status</option>
                                                @foreach (getGeneralStatus() as $statusKey => $statusLabel)
                                                    <option value="{{ ++$statusKey }}">{{ $statusLabel }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12" bis_skin_checked="1">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ old('address') }}">
                                    </div>
                                </div>
                                <hr>
                                <h5 class="mb-3">Security</h5>
                                <div class="row" bis_skin_checked="1">
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="pass">Password <span class="text text-danger">*</span></label>
                                        <input type="password" class="form-control" id="pass" name="password" placeholder="Password">
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="rpass">Repeat Password <span class="text text-danger">*</span></label>
                                        <input type="password" class="form-control" id="rpass" name="password_confirmation" placeholder="Repeat Password ">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Add</button>
                                <a href="{{route('employee.index')}}" class="btn btn-secondary float-right mr-1">Cancel</a>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>