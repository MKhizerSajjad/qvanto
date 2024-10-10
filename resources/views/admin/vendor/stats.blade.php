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
                        <div class="card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title mb-0">Lista Associati</h4>
                            </div>
                            <a href="{{route('vendor.create')}}" class="btn btn-primary">Add New</a>
                        </div>
                        <div class="card-body">
                            @if (count($data) > 0)
                                <div class="table-responsive">
                                    <table class="table data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sr#</th>
                                                <th>Foto</th>
                                                <th>Conversioni (%)</th>
                                                <th>Non Convertiti (%)</th>
                                                <th>Total</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Cellulare</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $vendor)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>
                                                        <img src="{{ asset('images/vendors/'.$vendor->picture) }}" onerror="this.onerror=null;this.src='{{ asset('admin/images/user/user-dummy-img.png') }}';" alt="{{ $vendor->first_name }}"  class="rounded avatar-40 img-fluid" >
                                                    </td>
                                                    <td>{{isset($vendor->leads[0]) ? ($vendor->leads[0]->Resolved / $vendor->leads[0]->total) * 100 : '-'}}</td>
                                                    <td>{{isset($vendor->leads[0]) ?($vendor->leads[0]->Withdrawed / $vendor->leads[0]->total) * 100 : '-'}}</td>
                                                    <td>{{isset($vendor->leads[0]) ? $vendor->leads[0]->total : '-'}}</td>
                                                    <td>{{$vendor->first_name}} {{$vendor->last_name}}</td>
                                                    <td>{{$vendor->email}}</td>
                                                    <td>{{$vendor->mobile_number}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
