<x-app-layout>
    <div class="content-page rtl-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-9 col-lg-8" bis_skin_checked="1">
                    <div class="card" bis_skin_checked="1">
                    <div class="card-header d-flex justify-content-between" bis_skin_checked="1">
                        <div class="header-title" bis_skin_checked="1">
                            <h4 class="card-title">New User Information</h4>
                        </div>
                    </div>
                    
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-border-left alert-dismissible fade show auto-colse-10">
                            <label>Whoops!</label> There were some problems with your input.<br><br>
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body" bis_skin_checked="1">
                        <div class="new-user-info" bis_skin_checked="1">
                            <form method="POST" action="employee.store">
                                <div class="row" bis_skin_checked="1">
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="first_name">First Name:</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="last_name">Last Name:</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                                    </div>
                                    {{-- <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="add1">Street Address 1:</label>
                                        <input type="text" class="form-control" id="add1" placeholder="Street Address 1">
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="add2">Street Address 2:</label>
                                        <input type="text" class="form-control" id="add2" placeholder="Street Address 2">
                                    </div>
                                    <div class="form-group col-md-12" bis_skin_checked="1">
                                        <label for="cname">Company Name:</label>
                                        <input type="text" class="form-control" id="cname" placeholder="Company Name">
                                    </div> --}}
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="mobno">Mobile Number:</label>
                                        <input type="text" class="form-control" id="mobno" placeholder="Mobile Number">
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="zip_code">Zip Code:</label>
                                        <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip Code">
                                    </div>
                                    {{-- <div class="form-group col-sm-6" bis_skin_checked="1">
                                        <label>Country:</label>
                                        <div class="dropdown bootstrap-select form-control" bis_skin_checked="1">
                                            <select class="selectpicker form-control" id="selectcountry">
                                                <option>Select Country</option>
                                                <option>Caneda</option>
                                                <option>Noida</option>
                                                <option>USA</option>
                                                <option>India</option>
                                                <option>Africa</option>
                                            </select>
                                            <button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="combobox" aria-owns="bs-select-2" aria-haspopup="listbox" aria-expanded="false" data-id="selectcountry" title="Select Country">
                                                <div class="filter-option" bis_skin_checked="1">
                                                    <div class="filter-option-inner" bis_skin_checked="1">
                                                        <div class="filter-option-inner-inner" bis_skin_checked="1">Select Country</div>
                                                    </div>
                                                </div>
                                            </button>
                                            <div class="dropdown-menu " bis_skin_checked="1"><div class="inner show" role="listbox" id="bs-select-2" tabindex="-1" bis_skin_checked="1">
                                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="form-group col-md-12" bis_skin_checked="1">
                                        <label for="city">Town/City:</label>
                                        <input type="text" class="form-control" id="city" placeholder="Town/City">
                                    </div> --}}
                                    </div>
                                    <hr>
                                    <h5 class="mb-3">Security</h5>
                                    <div class="row" bis_skin_checked="1">
                                    <div class="form-group col-md-12" bis_skin_checked="1">
                                        <label for="uname">User Name:</label>
                                        <input type="text" class="form-control" id="uname" placeholder="User Name">
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="pass">Password:</label>
                                        <input type="password" class="form-control" id="pass" placeholder="Password">
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="rpass">Repeat Password:</label>
                                        <input type="password" class="form-control" id="rpass" placeholder="Repeat Password ">
                                    </div>
                                </div>
                                <div class="checkbox" bis_skin_checked="1">
                                <label><input class="mr-2 rtl-ml-2 rtl-mr-0" type="checkbox">Enable Two-Factor-Authentication</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Add New User</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>