@section('titlepage','Penjualan')
@section('page_actionbutton')
{{-- <button class="btn btn-primary btn-border btn-round" data-toggle="modal" data-target="#addProduct">
    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-book-upload"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 20h-8a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12v5" /><path d="M11 16h-5a2 2 0 0 0 -2 2" /><path d="M15 16l3 -3l3 3" /><path d="M18 13v9" /></svg>
    {{__('Tambah Produk / Barang')}}
</button> --}}
<a class="btn btn-primary btn-border btn-round" href="{{route('add_jual_titip')}}">
    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-book-upload"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 20h-8a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12v5" /><path d="M11 16h-5a2 2 0 0 0 -2 2" /><path d="M15 16l3 -3l3 3" /><path d="M18 13v9" /></svg>
    {{__('Tambah Titip Jual')}}
</a>
@endsection
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
                <div class="card-header"><h4>{{__('Daftar Titip Jual')}}</h4></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="{{ $data['tables'][0] }}" class="table table-bordered datatable-class">
                            <thead>
                                <tr>
                                    <th class="text-center">{{__('No. ')}}</th>
                                    <th class="text-center">{{__('Kode ')}}</th>
                                    <th class="text-center">{{__('Nama')}}</th>
                                    <th class="text-center">{{__('Tanggal Titip')}}</th>
                                    <th class="text-center">{{__('Tanggal Ambil')}}</th>
                                    <th class="text-center">{{__('Total Penjualan')}}</th>
                                    <th class="w-1 text-center">{{__(' Aksi ')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @if(isset($data['main']) && count($data['main']) > 0)
                                    @foreach ($data['main'] as $key => $value)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td class="text-center"><b>{{$value->consignor_code}}</b></td>
                                            <td>{{$value->kontak->contact_name}}</td>
                                            <td class="text-center">{{date('d M Y H:i:s',strtotime($value->consignor_date_store))}}</td>
                                            <td class="text-center">{{$value->consignor_date_pickup != NULL ? date('d M Y H:i:s',strtotime($value->consignor_date_pickup)):'Belum Diambil'}}</td>
                                            
                                            <td class="text-end">{{formatRupiah($value->totalPenjualan)}}</td>                                            
                                            <td class="text-center w-1">
                                                <div class="btn-group dropdown">
                                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown"
                                                    >
                                                      <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                      <li>
                                                        <a class="dropdown-item" href="https://www.google.com/maps?q={{ $value->kontak->lattitude }},{{ $value->kontak->longitude }}">
                                                            <i class="fas fa-paper-plane"></i>
                                                            {{__('Arahkan')}}
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        @if ($value->consignor_stats == 'CLEAR')
                                                            <a class="dropdown-item text-success" href="{{route('detail_jual_titip',$value->id)}}">
                                                                <i class="fas fa-check-circle"></i>
                                                                {{__('Selesai')}}
                                                            </a>
                                                        @else
                                                        <a class="dropdown-item text-primary" href="{{route('complete_jual_titip',$value->id)}}">
                                                            <i class="fas fa-check"></i>
                                                            {{__('Selesaikan')}}
                                                        </a>
                                                        <a class="dropdown-item call-delete-modal text-red" href="#" data-id="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#modal-delete">
                                                            <strong>{{__('Hapus')}}</strong>
                                                        </a>
                                                        @endif
                                                      </li>
                                                    </ul>
                                                  </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- @if(isset($data['main']) && count($data['main']) > 0)
                <div class="card-footer d-flex align-items-center">
                    {{ $data['main']->links('vendor.pagination.default')}}
                </div>
                @endif	 --}}
            </div>
        </div>
    </div>
</x-app-layout>