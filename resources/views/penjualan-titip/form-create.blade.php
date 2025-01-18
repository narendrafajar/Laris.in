@section('titlepage','Tambah Titip Penjualan')
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
            <div class="card mb-3">
                <form action="" class="form-card" method="post">
                    @csrf
                    <div class="card-header">
                        <h4 class="card-title">{{__('Form Tambah Titip Penjualan')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="consignercompany" class="form-label">{{__('Pilih Usaha')}}</label>
                                    <select name="consignercompany" id="consignercompany" class="form-control select2" required>
                                        <option value="" disabled> {{__('Pilih Usaha')}}</option>
                                        @foreach ($data['company'] as $key => $value)
                                            <option value="{{$value->id}}">{{$value->company_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="consignercontact" class="form-label">{{__('Pilih Vendor / Toko / Kontak')}}</label>
                                    <select name="consignercontact" id="consignercontact" class="form-control select2" required>
                                        @if (isset($data['kontak']) && count($data['kontak']) > 0)
                                            <option value="" disabled> {{__('Pilih Vendor / Toko / Kontak')}}</option>
                                            @foreach ($data['kontak'] as $keyKontak => $valueKontak)
                                                <option value="{{$valueKontak->id}}">{{$valueKontak->contact_name.' / '.$valueKontak->contact_store_name}}</option>
                                            @endforeach
                                        @else
                                            <option value=""><button>{{__('Tambahkan Kontak')}}</button></option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-12 text-center" id="cancelButton" style="display: none">
                                <div class="mb-3">
                                    <button type="button" class="btn btn-danger btn-rounded" id="btnCancel"><i class="fas fa-times"></i>{{__(' Batalkan')}}</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row" id="productdisplay" style="display: none">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="product" class="form-label">{{__('Pilih Produk')}}</label>
                                    <select name="product" id="product" class="form-control select2" style="width: 100%"></select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="productqty" class="form-label">{{__('Jumlah Produk')}}</label>
                                    <input type="text" class="form-control numeric-input text-center" name="productqty" id="productqty">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="productprice" class="form-label">{{__('Harga Titip Produk')}}</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp. </span>
                                        <input type="text" class="form-control text-end numeric-input" name="productprice" id="productprice">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-12 text-center">
                                <div class="mb-3">
                                    <button type="button" class="btn btn-primary btn-rounded" id="btnAdd" onclick="addToListProduct()"><i class="fas fa-cart-arrow-down"></i>{{__(' Masukkan Ke Daftar Titip')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- bagian daftar itip --}}
            <div class="card" style="display: none" id="tableList">
                <div class="card-header">
                    <h4 class="card-title">{{__('Daftar Produk Dititipkan')}}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">{{__('Produk')}}</th>
                                    <th class="text-center">{{__('Jumlah')}}</th>
                                    <th class="text-center">{{__('Harga')}}</th>
                                    <th class="text-center">{{__('Subtotal')}}</th>
                                    <th class="w-1">{{__(' ')}}</th>
                                </tr>
                            </thead>
                            <tbody id="listProduct"></tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-end" colspan="3">{{__('Total')}}</th>
                                    <td class="text-end" colspan="2"><b class="text-danger" id="totalTitipan"></b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-danger btn-rounded" href="{{route('product')}}">
                        <i class="fas fa-ban"></i>
                        {{__('Keluar')}}
                    </a>
                    <button type="button" id="btnSubmitConsigner" class="btn btn-primary btn-rounded" style="float: right" onclick="submitConsignor()" disabled>
                        <i class="fas fa-save"></i>
                        {{__('Simpan')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @section('additional_js')
	<script src="{{ asset('larisin/js/larisin/consigner-sale.js') }}"></script>
	@endsection  
</x-app-layout>