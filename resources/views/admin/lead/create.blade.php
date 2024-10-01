<x-app-layout>
    <div class="content-page rtl-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12" bis_skin_checked="1">
                    <div class="card" bis_skin_checked="1">
                    <div class="card-header d-flex justify-content-between" bis_skin_checked="1">
                        <div class="header-title" bis_skin_checked="1">
                            <h4 class="card-title">Make New Examination</h4>
                        </div>
                    </div>
                    <div class="card-body" bis_skin_checked="1">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger" role="alert" bis_skin_checked="1">
                                <div class="iq-alert-icon" bis_skin_checked="1">
                                    <i class="ri-information-line"></i>
                                </div>
                                <div class="iq-alert-text" bis_skin_checked="1">
                                    <b>Whoops!</b> There were some problems with your inputs
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
                            <form method="POST" action="{{ route('lead.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row" bis_skin_checked="1">
                                    <div class="form-group col-md-3" bis_skin_checked="1">
                                        <label>Vendor <span class="text text-danger">*</span></label>
                                        <div class="dropdown" bis_skin_checked="1">
                                            <select class="form-control" id="vendor" name="vendor">
                                                <option>Select Vendor</option>
                                                @foreach ($vendors as $key => $vendor)
                                                    <option {{ (old('vendor') == $vendor->id) ? 'selected="selected"' : '' }} value="{{ $vendor->id }}">{{ $vendor->first_name }} {{ $vendor->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3" bis_skin_checked="1">
                                        <label>Lead Type <span class="text text-danger">*</span></label>
                                        <div class="dropdown" bis_skin_checked="1">
                                            <select class="form-control" id="lead_type" name="lead_type">
                                                <option>Select Lead Type</option>
                                                @foreach (getLeadType() as $key => $type)
                                                    @php $key = ++$key; @endphp
                                                    <option {{ (old('lead_type') == $key) ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3" bis_skin_checked="1">
                                        <label for="date">Date <span class="text text-danger">*</span></label>
                                        <input type="date" class="form-control" id="date" name="date" placeholder="Date Time" value="{{ old('date') }}">
                                    </div>
                                    <div class="form-group col-md-3" bis_skin_checked="1">
                                        <label>Status <span class="text text-danger">*</span></label>
                                        <div class="dropdown" bis_skin_checked="1">
                                            <select class="form-control" id="status" name="status">
                                                <option>Select Status</option>
                                                @foreach (getLeadStatus() as $key => $label)
                                                    @php $key = ++$key; @endphp
                                                    <option {{ (old('status') == $key) ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="first_name">First Name <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="last_name">Last Name <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="email">Email <span class="text text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="mobile_number">Mobile Number <span class="text text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number" value="{{ old('mobile_number') }}">
                                    </div>
                                    <div class="form-group col-md-12" bis_skin_checked="1">
                                        <label for="note">Note</label>
                                        <textarea type="text" class="form-control" id="note" name="note" placeholder="Note" rows="1">{{ old('note') }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Add</button>
                                <a href="{{route('lead.index')}}" class="btn btn-secondary float-right mr-1">Cancel</a>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
