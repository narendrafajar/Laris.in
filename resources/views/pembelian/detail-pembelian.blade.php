@section('titlepage','Detail Titip Jual')
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
                    <h4 class="card-title mb-2">{{__('Detail Titip Jual')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="" class="form-label">{{__('Kode Pembelian')}}</label>
                                <div class="form-control-plaintext">{{$data['main']->cost_code}}</div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="" class="form-label">{{__('Nama Toko / Vendor')}}</label>
                                <div class="form-control-plaintext">{{$data['main']->vendor_name}}</div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="" class="form-label">{{__('Tanggal Pembelian')}}</label>
                                <div class="form-control-plaintext">{{date('d M Y H:i:s',strtotime($data['main']->cost_date))}}</div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="" class="form-label">{{__('Jumlah Item')}}</label>
                                <div class="form-control-plaintext">{{$totalItems}}</div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="" class="form-label">{{__('Total Pembelian')}}</label>
                                <div class="form-control-plaintext"><b class="text-danger">{{formatRupiah($data['main']->cost_total_amount)}}</b></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-control-plaintext">{{__('Daftar Barang / Produk / Item')}}</div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="mb-3">
                                <div class="table-responsive">
                                    <table class="table table-head-bg-danger">
                                        <thead>
                                            <tr>
                                                <th class="text-center">{{__('Jenis')}}</th>
                                                <th class="text-center">{{__('Item')}}</th>
                                                <th class="text-center">{{__('Qty')}}</th>
                                                <th class="text-center">{{__('Satuan')}}</th>
                                                <th class="text-center">{{__('Subtotal')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['detail'] as $key => $value )
                                            @php
                                                $unitPrice = $value->items_price / $value->items_amount;
                                            @endphp
                                            <tr>
                                                <td>{{$value->items_type}}</td>
                                                <td>{{$value->items_name}}</td>
                                                <td class="text-center">{{number_format($value->items_amount)}}</td>
                                                <td class="text-end">{{formatRupiah($unitPrice)}}</td>
                                                <td class="text-end">{{formatRupiah($value->items_price)}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a class="btn btn-danger btn-rounded" href="{{route('cost')}}">
                    <i class="fas fa-arrow-alt-circle-left"></i>
                    {{__(' Kembali')}}
                </a>
            </div>
        </div>
    </div>
    @section('additional_js')
	<script src="{{ asset('larisin/js/larisin/consigner-sale.js') }}"></script>
	@endsection  
</x-app-layout>