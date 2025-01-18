@section('titlepage','Penyelesaian Titip Jual')
<x-app-layout>
    @if (Session::has('error'))
		<div class="alert alert-important alert-danger alert-dismissible" role="alert">
			<div class="d-flex">
				<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><desc>Download more icon variants from https://tabler-icons.io/i/alert-circle</desc><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
				<div>
					{{ __(Session::get('error')) }}
				</div>
			</div>
			<a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
		</div>
	@endif
	@if(Session::has('success'))
		<div class="alert alert-important alert-success alert-dismissible" role="alert">
			<div class="d-flex">
				<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><desc>Download more icon variants from https://tabler-icons.io/i/check</desc><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
				<div>
					{{ __(Session::get('success')) }}
				</div>
			</div>
			<a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
		</div>
	@endif
	<div id="message-alert"></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-2">{{__('Form Penyelesaian Titip Jual')}}</h4>
                    @php
                        $classBadge = "";
                        $badgeText = "";
                        $iconText = "";
                        if($data['main']->consignor_stats == "START"){
                            $iconText = "fas fa-play";
                            $badgeText = "Belum Diambil";
                            $classBadge = "badge badge-primary";
                        } elseif ($data['main']->consignor_stats == "CLEAR") {
                            $iconText = "fas fa-check";
                            $badgeText = "Sudah Diambil";
                            $classBadge = "badge badge-success";
                        } else {
                            $iconText = "fas fa-ban";
                            $badgeText = "Terjadi Kesalahan";
                            $classBadge = "badge badge-danger";
                        }
                    @endphp
                    <span class="{{$classBadge}}"><i class="{{$iconText}}"></i>{{$badgeText}}</span>
                </div>
                <form action="{{route('update_jual_titip')}}" class="form-card" method="post">
                    @csrf
                    <input type="hidden" value="{{$data['main']->id}}" name="idConsignor" id="idConsignor">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{__('Kode Titip Jual')}}</label>
                                    <div class="form-control-plaintext">{{$data['main']->consignor_code}}</div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{__('Nama Toko / Vendor')}}</label>
                                    <div class="form-control-plaintext">{{$data['main']->kontak->contact_name}}</div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{__('Tanggal Titip Jual')}}</label>
                                    <div class="form-control-plaintext">{{date('d M Y H:i:s',strtotime($data['main']->consignor_date_store))}}</div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{__('Jumlah Item')}}</label>
                                    <div class="form-control-plaintext">{{$data['main']->consignor_item_total}}</div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{__('Total Titipan')}}</label>
                                    <div class="form-control-plaintext">{{formatRupiah($data['main']->consignor_total_amount)}}</div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{__('Tanggal Diambil')}}</label>
                                    <div class="form-control-plaintext">{{$data['main']->consignor_date_pickup != NULL ? $data['main']->consignor_date_pickup : "-- : -- : --"}}</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-control-plaintext">{{__('Daftar Produk / Barang Dititipkan')}}</div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <div class="table-responsive">
                                        <table class="table table-head-bg-primary">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">{{__('Produk')}}</th>
                                                    <th class="text-center">{{__('Qty')}}</th>
                                                    <th class="text-center">{{__('harga')}}</th>
                                                    <th class="text-center">{{__('Terjual')}}</th>
                                                    <th class="text-center">{{__('Sisa')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['detail'] as $key => $value )
                                                <tr>
                                                    <td>{{$value->product->product_name}}</td>
                                                    <td class="text-center">{{$value->qty}}</td>
                                                    <td class="text-end">{{formatRupiah($value->price)}}</td>
                                                    <td id="{{$value->id}}">
                                                        <input type="text" name="soldQty[{{$value->id}}]" id="soldQty_{{$value->id}}" class="form-control numeric-input text-center bg-danger text-white" oninput="calculatingRemaining({{$value->qty}}, {{$value->id}})" placeholder="Jumlah terjual">
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-control-plaintext"><b id="sisaProduk_{{$value->id}}"></b></div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" id="footerCard" style="display: none">
                        <a class="btn btn-danger btn-rounded" href="{{route('jual_titip')}}">
                            <i class="fas fa-ban"></i>
                            {{__('Keluar')}}
                        </a>
                        <button type="submit" id="btnSubmitComplete" class="btn btn-primary btn-rounded" style="float: right" disabled>
                            <i class="fas fa-save"></i>
                            {{__('Selesaikan Titipan')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @section('additional_js')
	<script src="{{ asset('larisin/js/larisin/consigner-sale.js') }}"></script>
	@endsection  
</x-app-layout>