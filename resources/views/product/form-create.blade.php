@section('titlepage','Tambah Produk / Barang')
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <form action="{{route('store_product')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">{{__('Form Tambah Produk / Barang')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="productcompany" class="form-label">{{__('Pilih Asal Produk')}}</label>
                                    <select name="productcompany" id="productcompany" class="form-control" required>
                                        <option value="" disabled> {{__('Pilih Asal Produk / Barang')}}</option>
                                        @foreach ($data['company'] as $key => $value)
                                            <option value="{{$value->id}}">{{$value->company_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="productname" class="form-label">{{__('Masukkan Nama Produk/Barang')}}</label>
                                <input type="text" class="form-control" name="productname" id="productname" placeholder="Masukkan Nama Produk/Barang" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="productvol" class="form-label">{{__('Satuan Produk / Barang')}}</label>
                                    <select name="productvol" id="productvol" class="form-control" required>
                                        <option value="">{{__('Pilih Satuan Produk / Barang')}}</option>
                                        <option value="PCS">{{__('Pcs')}}</option>
                                        <option value="KG">{{__('Kilogram')}}</option>
                                        <option value="PACKAGE">{{__('Paket')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="buyPrice" class="form-label">{{__('Harga Awal / Beli Produk / Barang')}}</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text">Rp. </span>
                                            <input type="text" class="form-control text-end numeric-input" name="buyPrice" id="buyPrice" required>
                                        </div>
                                    </div>
                                    @error('buyPrice')
                                        <div class="text-danger"><i id="error-text"></i></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="salePrice" class="form-label">{{__('Harga Jual Produk / Barang')}}</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text">Rp. </span>
                                            <input type="text" class="form-control text-end numeric-input" name="salePrice" id="salePrice" required>
                                        </div>
                                    </div>
                                    @error('salePrice')
                                        <div class="text-danger"><i id="error-text"></i></div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-danger btn-rounded" href="{{route('product')}}">
                            <i class="fas fa-ban"></i>
                            {{__('Keluar')}}
                        </a>
                        <button type="submit" class="btn btn-primary btn-rounded" style="float: right">
                            <i class="fas fa-save"></i>
                            {{__('Simpan')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('additional_js')
	<script src="{{ asset('larisin/js/larisin/product.js') }}"></script>
	@endsection  
</x-app-layout>