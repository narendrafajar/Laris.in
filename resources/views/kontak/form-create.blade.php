@section('titlepage','Tambah Kontak')
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <form action="{{route('store_kontak')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">{{__('Form Tambah Kontak')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="kontakname" class="form-label">{{__('Nama')}}</label>
                                    <input type="text" class="form-control" name="kontakname" id="kontakname" placeholder="Masukkan nama kontak" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="kontakstore" class="form-label">{{__('Nama Toko / Alias')}}</label>
                                    <input type="text" class="form-control" name="kontakstore" id="kontakstore" placeholder="Contoh: Toko Bu Ani">
                                    <small><i class="text-danger">{{__('*jika toko tidak ada nama maka dituliskan NN')}}</i></small>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="kontakpic" class="form-label">{{__('Nama Pemilik')}}</label>
                                    <input type="text" class="form-control" name="kontakpic" id="kontakpic" placeholder="Contoh: Bu Ani" required>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="checkboxpic" id="checkboxpic" onchange="checkboxNameCheck()">
                                        <label for="checkboxpic" class="form-check-label"><i class="text-danger">{{__('Centang jika sama dengan Nama')}}</i></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="kontaknumber" class="form-label">{{__('No. Handphone (Whatsapp)')}}</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text">+62 </span>
                                            <input type="text" class="form-control" name="kontaknumber1" id="kontaknumber1" placeholder="8123456789" required>
                                        </div>
                                    </div>
                                    <small><i class="text-danger">{{__('*Format penulisan nomor whatsapp 8123456987')}}</i></small>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="checkboxothernumber" id="checkboxothernumber" onchange="checkboxOtherNumber()">
                                        <label for="checkboxothernumber" class="form-check-label"><i class="text-danger">{{__('Centang jika ada nomor lainnya')}}</i></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6" style="display: none" id="othernumber">
                                <div class="mb-3">
                                    <label for="kontaknumber2" class="form-label">{{__('No. Handphone (Lainnya)')}}</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text">+62 </span>
                                            <input type="text" class="form-control" name="kontaknumber2" id="kontaknumber2" placeholder="8123456789">
                                        </div>
                                    </div>
                                    <small><i class="text-danger">{{__('*Format penulisan nomor 21123456')}}</i></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <label for="kontakalamat" class="form-label">{{__('Alamat Kontak')}}</label>
                                    <textarea name="kontakalamat" id="kontakalamat" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="lattitude" class="form-label">{{__('Lattitude')}}</label>
                                    <input type="text" class="form-control" name="latitude" id="latitude" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="longitude" class="form-label">{{__('Longitude')}}</label>
                                    <input type="text" name="longitude" id="longitude" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <small><i class="text-danger">{{__('lattitude dan Longitude akan terisi otomatis, lakukan izin akses lokasi di perangkat anda')}}</i></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-danger btn-rounded" href="{{route('kontak')}}">
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
	<script src="{{ asset('larisin/js/larisin/kontak.js') }}"></script>
	@endsection  
</x-app-layout>