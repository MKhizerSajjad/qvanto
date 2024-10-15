<x-app-layout>
    <div class="content-page rtl-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12" bis_skin_checked="1">
                    <div class="card" bis_skin_checked="1">
                    <div class="card-header d-flex justify-content-between" bis_skin_checked="1">
                        <div class="header-title" bis_skin_checked="1">
                            <h4 class="card-title">Update Associato</h4>
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
                            <form method="POST" action="{{ route('vendor.update', $vendor->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row" bis_skin_checked="1">
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="first_name">Nome <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nome" value="{{ old('first_name', $vendor->first_name) }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="last_name">Cognome <span class="text text-danger">*</span></label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Cognome" value="{{ old('last_name', $vendor->last_name) }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="picture">Immagine</label>
                                        <input type="file" id="picture" name="picture" placeholder="Immagine" value="{{ old('picture', $vendor->picture) }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="email">Email <span class="text text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email', $vendor->email) }}">
                                    </div>
                                    <div class="form-group col-md-4" bis_skin_checked="1">
                                        <label for="mobile_number">Cellulare <span class="text text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="mobile_number" name="mobile_number" placeholder="Cellulare" value="{{ old('mobile_number', $vendor->mobile_number) }}">
                                    </div>
                                    <div class="form-group col-sm-4" bis_skin_checked="1">
                                        <label>Stato <span class="text text-danger">*</span></label>
                                        <div class="dropdown" bis_skin_checked="1">
                                            <select class="form-control" id="status" name="status">
                                                <option value="">Select Stato</option>
                                                @foreach (getGeneralStatus() as $statusKey => $statusLabel)
                                                    @php $key = ++$statusKey @endphp
                                                    <option {{ (old('status', $vendor->status) == $key) ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $statusLabel }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                                        <label for="rpass">Ripetere Password <span class="text text-danger">*</span></label>
                                        <input type="password" class="form-control" id="rpass" name="password_confirmation" placeholder="Ripetere Password ">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Update</button>
                                <a href="{{route('vendor.index')}}" class="btn btn-secondary float-right mr-1">Cancel</a>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
