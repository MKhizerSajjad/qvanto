<x-app-layout>
    <div class="content-page rtl-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12" bis_skin_checked="1">
                    <div class="card" bis_skin_checked="1">
                    <div class="card-header d-flex justify-content-between" bis_skin_checked="1">
                        <div class="header-title" bis_skin_checked="1">
                            <h4 class="card-title">Update Lead</h4>
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
                            <form method="POST" action="{{ route('lead.update', $lead->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row" bis_skin_checked="1">
                                    <div class="form-group col-md-3" bis_skin_checked="1">
                                        <label>Associato <span class="text text-danger">*</span></label>
                                        <div class="dropdown" bis_skin_checked="1">
                                            <select class="form-control" id="vendor" name="vendor">
                                                <option>Select Associato</option>
                                                @foreach ($vendors as $key => $vendor)
                                                    <option {{ (old('vendor', $lead->vendor_id) == $vendor->id) ? 'selected="selected"' : '' }} value="{{ $vendor->id }}">{{ $vendor->first_name }} {{ $vendor->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3" bis_skin_checked="1">
                                        <label>Tipologia Lead <span class="text text-danger">*</span></label>
                                        <div class="dropdown" bis_skin_checked="1">
                                            <select class="form-control" id="lead_type" name="lead_type">
                                                <option>Select Tipologia Lead</option>
                                                @foreach (getLeadType() as $key => $type)
                                                    @php $key = ++$key; @endphp
                                                    <option {{ (old('lead_type', $lead->lead_type) == $key) ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3" bis_skin_checked="1">
                                        <label for="date">Date {{$lead->dated}} <span class="text text-danger">*</span></label>
                                        <input type="date" class="form-control" id="date" name="date" placeholder="Date Time" value="{{ old('date', $lead->dated) }}">
                                    </div>
                                    <div class="form-group col-md-3" bis_skin_checked="1">
                                        <label>Stato <span class="text text-danger">*</span></label>
                                        <div class="dropdown" bis_skin_checked="1">
                                            <select class="form-control" id="status" name="status">
                                                <option>Select Stato</option>
                                                @foreach (getLeadStatus() as $key => $label)
                                                    @php $key = ++$key; @endphp
                                                    <option {{ (old('status', $lead->status) == $key) ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="first_name">Nome <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nome" value="{{ old('first_name', $lead->first_name) }}">
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="last_name">Cognome <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Cognome" value="{{ old('last_name', $lead->last_name) }}">
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="email">Email <span class="text text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email', $lead->email) }}">
                                    </div>
                                    <div class="form-group col-md-6" bis_skin_checked="1">
                                        <label for="mobile_number">Cellulare <span class="text text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="mobile_number" name="mobile_number" placeholder="Cellulare" value="{{ old('mobile_number', $lead->mobile_number) }}">
                                    </div>
                                    <div class="form-group col-md-12" bis_skin_checked="1">
                                        <label for="note">Note</label>
                                        <textarea type="text" class="form-control" id="note" name="note" placeholder="Note" rows="1">{{ old('note', $lead->note) }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Update</button>
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
