@section('titlepage','Tambah Pembelian')
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
                    <h4 class="card-title">{{__('Form Buat Pembelian / Pengeluaran')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">{{__('Tanggal Pembelian')}}</label>
                                <input type="date" class="form-control" name="costDate" id="costDate" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">{{__('Nama Toko / Tempat Beli')}}</label>
                                <input type="text" class="form-control" name="costVendor" id="costVendor" placeholder="Masukkan tempat pembelian barang / bahan">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="mb-3">
                                <label for="costType" class="form-label">{{__('Jenis Pembelian')}}</label>
                                <select name="costType" id="costType" class="form-control">
                                    <option value="">{{__('Pilih Jenis Pembelian')}}</option>
                                    <option value="BAHAN">{{__('Bahan / Perlengkapan / Peralatan')}}</option>
                                    <option value="LAINNYA">{{__('Lainnya')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="mb-3">
                                <label for="costProduct" class="form-label">{{__('Nama Barang')}}</label>
                            <input type="text" class="form-control" name="costProduct" id="costProduct" placeholder="Masukkan nama barang / bahan yang dibeli">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="mb-3">
                            <label for="costQty" class="form-label">{{__('Jumlah')}}</label>
                            <input type="text" class="form-control numeric-input text-center" name="costQty" id="costQty" placeholder="Masukkan jumlah barang / bahan yang dibeli">
                           </div>
                        </div>
                        <div class="col-sm-4 col-md-6 col-lg-6">
                            <div class="mb-3">
                                <label for="costVol" class="form-label">{{__('Satuan Produk / Barang')}}</label>
                                <select name="costVol" id="costVol" class="form-control" required>
                                    <option value="">{{__('Pilih Satuan Produk / Barang')}}</option>
                                    <option value="PCS">{{__('Pcs')}}</option>
                                    <option value="KG">{{__('Kilogram')}}</option>
                                    <option value="GRAM">{{__('Gram')}}</option>
                                    <option value="PACK">{{__('Paket')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="mb-3">
                                <label for="costPrice" class="form-label">{{__('Harga')}}</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp. </span>
                                    <input type="text" class="form-control text-end numeric-input" name="costPrice" id="costPrice" placeholder="Masukkan harga bahan / barang yang dibeli">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-12 text-center">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary btn-rounded" id="btnAdd" onclick="addToListCost()"><i class="fas fa-cart-arrow-down"></i>{{__(' Masukkan Ke Daftar Pembelian')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('Daftar Pembelian')}}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">{{__('Jenis')}}</th>
                                    <th class="text-center">{{__('Keterangan')}}</th>
                                    <th class="text-center">{{__('Satuan')}}</th>
                                    <th class="text-center">{{__('Jumlah')}}</th>
                                    <th class="text-center">{{__('Harga Satuan')}}</th>
                                    <th class="text-center">{{__('Subtotal')}}</th>
                                    <th class="w-1"{{__(' ')}}></th>
                                </tr>
                            </thead>
                            <tbody id="costBody"></tbody>
                            <tfoot id="costFoot">
                                <tr>
                                    <th class="text-end" colspan="5">{{__('Total Pembelian')}}</th>
                                    <td class="text-end" colspan="2"><b class="text-danger" id="totalPembelianText"></b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer" id="costFooter" style="display: none">
                    <a class="btn btn-danger btn-rounded" href="{{route('cost')}}">
                        <i class="fas fa-ban"></i>
                        {{__('Keluar')}}
                    </a>
                    <button type="button" id="btnSubmitCost" class="btn btn-primary btn-rounded" style="float: right" onclick="submitCost()" disabled>
                        <i class="fas fa-save"></i>
                        {{__('Simpan')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @section('additional_js')
	<script src="{{ asset('larisin/js/larisin/cost.js') }}"></script>
	@endsection  
</x-app-layout>