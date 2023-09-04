<x-app-layout>
    <div class="content-page rtl-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12" bis_skin_checked="1">
                    <div class="card" bis_skin_checked="1">
                    <div class="card-header d-flex justify-content-between" bis_skin_checked="1">
                        <div class="header-title" bis_skin_checked="1">
                            <h4 class="card-title">Add Salary</h4>
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
                            <form method="POST" action="{{ route('salary.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row" bis_skin_checked="1">
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label>Employee <span class="text text-danger">*</span></label>
                                        <div class="dropdown" bis_skin_checked="1">
                                            <select class="form-control" id="employee" name="employee">
                                                <option>Select Employee</option>
                                                @foreach ($employees as $key => $employee)
                                                    <option {{ (old('employee') == $employee->id) ? 'selected="selected"' : '' }} value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label>Published <span class="text text-danger">*</span></label>
                                        <div class="dropdown" bis_skin_checked="1">
                                            <select class="form-control" id="published" name="published">
                                                <option>Select Option</option>
                                                @foreach (getYesNo() as $key => $status)
                                                    @php $key = ++$key @endphp
                                                    <option {{ (old('published') == $key) ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="month">Month <span class="text text-danger">*</span></label>
                                        <input type="month" class="form-control" id="month" name="month" placeholder="Date Time" value="{{ old('month') }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="basic_salary">Basic Salary <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="basic_salary" name="basic_salary" placeholder="00" readonly>
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="case_comission">Comission <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="case_comission" name="case_comission" placeholder="00" readonly>
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="total_amount">Total Amount <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_amount" name="total_amount" placeholder="00" readonly>
                                    </div>
                                    <div class="form-group col-md-12" bis_skin_checked="1">
                                        <label for="note">Note</label>
                                        <textarea type="text" class="form-control" id="note" name="note" placeholder="Note">{{ old('note') }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Add</button>
                                <a href="{{route('salary.index')}}" class="btn btn-secondary float-right mr-1">Cancel</a>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Get references to the input fields
        var basicSalaryInput = $('#basic_salary');
        var commissionInput = $('#case_comission');
        var totalInput = $('#total_amount');
        
        // Attach an event listener to the employee select input
        $('#employee').on('change', function() {
            var selectedEmployeeId = $(this).val();

            // alert(selectedEmployeeId);
            // Use AJAX to fetch the employee's data based on the selected ID
            $.ajax({
                url: '/get-salary-detail/' + selectedEmployeeId, // Replace with the actual route
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Update the input fields with the fetched data
                    basicSalaryInput.val(data.basic_salary);
                    commissionInput.val(data.commission);
                    totalInput.val(data.total_amount);
                },
                error: function() {
                    // Handle error if needed
                }
            });
        });
    });
</script>