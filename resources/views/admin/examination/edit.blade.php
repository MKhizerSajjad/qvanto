<x-app-layout>
    <div class="content-page rtl-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12" bis_skin_checked="1">
                    <div class="card" bis_skin_checked="1">
                    <div class="card-header d-flex justify-content-between" bis_skin_checked="1">
                        <div class="header-title" bis_skin_checked="1">
                            <h4 class="card-title">Update Examination</h4>
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
                            <form method="POST" action="{{ route('examination.update', $examination->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row" bis_skin_checked="1">
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label>Examination Type <span class="text text-danger">*</span></label>
                                        <div class="dropdown" bis_skin_checked="1">
                                            <select class="form-control" id="case_type" name="case_type" multiple>
                                                <option>Select Examination Type</option>
                                                @foreach (getExamTypes() as $key => $label)
                                                    @php $key = ++$key @endphp
                                                    <option {{ (old('case_type', $examination->case_type_id) == $key) ? 'selected="selected"' : '' }} value="{{ ++$key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="datetime">Date Time <span class="text text-danger">*</span></label>
                                        <input type="datetime-local" class="form-control" id="datetime" name="datetime" placeholder="Date Time" value="{{ old('datetime', $examination->dated) }}">
                                    </div>
                                    @if (Auth::user()->user_type == 1)
                                        <div class="form-group col-sm-4" bis_skin_checked="1">
                                            <label>Counselor <span class="text text-danger">*</span></label>
                                            <div class="dropdown" bis_skin_checked="1">
                                                <select class="form-control" id="counselor" name="counselor">
                                                    <option>Select Counselor</option>
                                                    @foreach ($counselors as $key => $counselor)
                                                        <option {{ (old('counselor', $examination->counselor_id) == $counselor->id) ? 'selected="selected"' : '' }} value="{{ $counselor->id }}">{{ $counselor->first_name }} {{ $counselor->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4" bis_skin_checked="1">
                                            <label>Examinar <span class="text text-danger">*</span></label>
                                            <div class="dropdown" bis_skin_checked="1">
                                                <select class="form-control" id="examinar" name="examinar">
                                                    <option>Select Examinar</option>
                                                    @foreach ($employees as $key => $employee)
                                                        <option {{ (old('examinar', $examination->employee_id) == $employee->id) ? 'selected="selected"' : '' }} value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-4" bis_skin_checked="1">
                                            <label>Client <span class="text text-danger">*</span></label>
                                            <div class="dropdown" bis_skin_checked="1">
                                                <select class="form-control" id="client" name="client">
                                                    <option>Select Client</option>
                                                    @foreach ($customers as $key => $customer)
                                                        <option {{ (old('client', $examination->customer_id) == $customer->id) ? 'selected="selected"' : '' }} value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4" bis_skin_checked="1">
                                            <label>Status <span class="text text-danger">*</span></label>
                                            <div class="dropdown" bis_skin_checked="1">
                                                <select class="form-control" id="status" name="status">
                                                    <option>Select Status</option>
                                                    @foreach (getAppointmentStatus() as $key => $label)
                                                        @php $key = ++$key; @endphp
                                                        <option {{ (old('status', $examination->status) == $key) ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @elseif(Auth::user()->user_type == 2)
                                        <div class="form-group col-md-6" bis_skin_checked="1">
                                            <label>Customer <span class="text text-danger">*</span></label>
                                            <div class="dropdown" bis_skin_checked="1">
                                                <select class="form-control" id="customer" name="customer">
                                                    <option>Select Customer</option>
                                                    @foreach ($customers as $key => $customer)
                                                        <option {{ (old('customer', $examination->customer_id) == $customer->id) ? 'selected="selected"' : '' }} value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6" bis_skin_checked="1">
                                            <label>Status <span class="text text-danger">*</span></label>
                                            <div class="dropdown" bis_skin_checked="1">
                                                <select class="form-control" id="status" name="status">
                                                    <option>Select Status</option>
                                                    @foreach (getAppointmentStatus() as $key => $label)
                                                        @php $key = ++$key; @endphp
                                                        <option {{ (old('status', $examination->status) == $key) ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif


                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label>Language <span class="text text-danger">*</span></label>
                                        <div class="dropdown" bis_skin_checked="1">
                                            <select class="form-control" id="language" name="language">
                                                <option>Select Language</option>
                                                @foreach (getLanguages() as $key => $label)
                                                    @php $key = ++$key; @endphp
                                                    <option {{ (old('language', $examination->language) == $key) ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" class="form-control" id="other_language" name="other_language" placeholder="Language" value="{{ old('other_language', $examination->other_language) }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label>Autism <span class="text text-danger">*</span></label>
                                        <div class="dropdown" bis_skin_checked="1">
                                            <select class="form-control" id="autism" name="autism">
                                                <option>Concerns about Autism</option>
                                                @foreach (getBoolStatus() as $key => $label)
                                                    @php $key = ++$key; @endphp
                                                    <option {{ (old('autism', $examination->autism) == $key) ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label>Intellectual Disability <span class="text text-danger">*</span></label>
                                        <div class="dropdown" bis_skin_checked="1">
                                            <select class="form-control" id="intellectual_disability" name="intellectual_disability">
                                                <option>Concerns about an Intellectual Disability</option>
                                                @foreach (getBoolStatus() as $key => $label)
                                                    @php $key = ++$key; @endphp
                                                    <option {{ (old('intellectual_disability', $examination->intellectual_disability) == $key) ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="authorization">Authorization <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="authorization" name="authorization" placeholder="Authorization" value="{{ old('authorization', $examination->authorization) }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="disability">Disability <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="disability" name="disability" placeholder="Disability" value="{{ old('disability', $examination->disability) }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="prior_diagnoses">Prior Diagnoses <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="prior_diagnoses" name="prior_diagnoses" placeholder="Prior Diagnoses" value="{{ old('prior_diagnoses', $examination->prior_diagnoses) }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="medications">Medications <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="medications" name="medications" placeholder="Medications" value="{{ old('medications', $examination->medications) }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="vocational_objective">Vocational Objective <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="vocational_objective" name="vocational_objective" placeholder="Vocational Objective" value="{{ old('vocational_objective', $examination->vocational_objective) }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="payer">Payer <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="payer" name="payer" placeholder="Payer" value="{{ old('payer', $examination->payer) }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="emergency_name">Emergency Name <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="emergency_name" name="emergency_name" placeholder="Emergency Name" value="{{ old('emergency_name', $examination->emergency_name) }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="emergency_phone">Emergency Phone <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="emergency_phone" name="emergency_phone" placeholder="Emergency Phone" value="{{ old('emergency_phone', $examination->emergency_mobile_number) }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label>Family member relation <span class="text text-danger">*</span></label>
                                        <div class="dropdown" bis_skin_checked="1">
                                            <select class="form-control" id="family_member_relation" name="family_member_relation">
                                                <option>Select Family member relation</option>
                                                @foreach (getBoolStatus() as $key => $label)
                                                    @php $key = ++$key; @endphp
                                                    <option {{ (old('family_member_relation', $examination->family_relation) == $key) ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="family_member_name">Family Member Name <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="family_member_name" name="family_member_name" placeholder="Family Member Name" value="{{ old('family_member_name', $examination->family_name) }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="family_member_phone">Family Member Phone <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="family_member_phone" name="family_member_phone" placeholder="Family Member Phone" value="{{ old('family_member_phone', $examination->family_mobile_number) }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="family_member_email">Family Member Email <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="family_member_email" name="family_member_email" placeholder="Family Member Email" value="{{ old('family_member_email', $examination->family_email) }}">
                                    </div>
                                    <div class="form-group col-md-12" bis_skin_checked="1">
                                        <label for="note">Note</label>
                                        <textarea type="text" class="form-control" id="note" name="note" placeholder="Note">{{ old('note', $examination->note) }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Update</button>
                                <a href="{{route('examination.index')}}" class="btn btn-secondary float-right mr-1">Cancel</a>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
