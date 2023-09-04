<x-app-layout>
    <div class="content-page rtl-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12" bis_skin_checked="1">
                    <div class="card" bis_skin_checked="1">
                    <div class="card-header d-flex justify-content-between" bis_skin_checked="1">
                        <div class="header-title" bis_skin_checked="1">
                            <h4 class="card-title">Case Details</h4>
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
                            <form method="POST" action="{{ route('case-detail.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row" bis_skin_checked="1">
                                    <input type="hidden" id="case_id" name="case_id" value="{{ old('case_id', $case->id) }}">
                                    <input type="hidden" id="case_type" name="case_type" value="{{ old('case_type', $case->case_type_id) }}">
                                    
                                    @foreach (getCaseQuestions() as $key => $label)
                                        {{-- @php $key = ++$key; @endphp
                                        <div class="form-group col-md-6" bis_skin_checked="1">
                                            <label for="detail">{{$label}}</label>
                                            <input type="hidden" id="question_id" name="question_id[]" value="{{ old('question_id', $key) }}">
                                            <textarea type="text" class="form-control" id="detail" name="detail[]" placeholder="Type your answer">{{ old('detail') }}</textarea>
                                        </div> --}}
                                        @php 
                                            $withoutInc = $key;
                                            $key = ++$key; 
                                        @endphp
                                        <div class="form-group col-md-6" bis_skin_checked="1">
                                            <label for="detail">{{$label}}</label>
                                            <input type="hidden" id="question_id" name="question_id[]" value="{{ old('question_id', $key) }}">
                                            <textarea type="text" class="form-control" id="detail" name="detail[]" placeholder="Type your answer">{{ $caseDetails[$withoutInc]->detail ?? old('detail') }}</textarea>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Update</button>
                                <a href="{{route('appointment.index')}}" class="btn btn-secondary float-right mr-1">Cancel</a>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
