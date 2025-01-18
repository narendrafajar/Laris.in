@section('titlepage','Beranda')
@section('subtitlepage')
    <div id="clock"></div>
@endsection
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="mb-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                  <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                      <i class="fas fa-dollar-sign"></i>
                                    </div>
                                  </div>
                                  <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                      <p class="card-category">{{__('Pendapatan')}}</p>
                                      <h4 class="card-title">{{formatRupiah($totalPendapatan)}}</h4>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="mb-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                  <div class="col-icon">
                                    <div class="icon-big text-center icon-danger bubble-shadow-small">
                                      <i class="fas fa-hand-holding-usd"></i>
                                    </div>
                                  </div>
                                  <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                      <p class="card-category">{{__('Pengeluaran')}}</p>
                                      <h4 class="card-title">{{formatRupiah($cost)}}</h4>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('Table Rekomendasi Titip Jual')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-sub mb-3">
                            <i>{{__('Tabel ini menampilkan data yang memuat hasil analisis otomatis dari penjualan produk dari berbagai toko (Kontak). Tabel ini membantu Anda melihat performa produk yang dititipkan berdasarkan penjualan sebelumnya.')}}</i>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="mb-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">{{__('Toko')}}</th>
                                                <th class="text-center">{{__('Produk')}}</th>
                                                <th class="text-center">{{__('Terjual')}}</th>
                                                <th class="text-center">{{__('Avg (days)')}}</th>
                                                <th class="text-center">{{__('Rekomendasi')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $groupedData = $data->groupBy('Toko'); // Mengelompokkan data berdasarkan Toko
                                            @endphp
        
                                            @foreach ($groupedData as $toko => $rows)
                                                @php $rowCount = count($rows); @endphp
        
                                                @foreach ($rows as $index => $row)
                                                    <tr>
                                                        {{-- Hanya tampilkan Toko pada baris pertama dalam kelompok --}}
                                                        @if ($index === 0)
                                                            <td rowspan="{{ $rowCount }}">{{ $toko }}</td>
                                                        @endif
                                                        <td>{{ $row->Produk }}</td>
                                                        <td class="text-center">{{ $row->Terjual }}</td>
                                                        <td class="text-center">{{ number_format($row->AverageDays, 2) }}</td>
                                                        <td class="text-center">{{ $row->Rekomendasi }}</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5"><i class="text-danger">{{__('Catatan :')}}</i>
                                                    <br>
                                                    <small><i>{{__(' Rekomendasi adalah Perkiraan jumlah produk yang disarankan untuk dititipkan pada periode berikutnya, dihitung secara otomatis berdasarkan tren penjualan sebelumnya.')}}</i></small>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updateClock() {
            const clockElement = document.getElementById("clock");

            const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            const months = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            const now = new Date();
            const day = days[now.getDay()];
            const date = now.getDate();
            const month = months[now.getMonth()];
            const year = now.getFullYear();
            const hours = String(now.getHours()).padStart(2, "0");
            const minutes = String(now.getMinutes()).padStart(2, "0");
            const seconds = String(now.getSeconds()).padStart(2, "0");

            clockElement.textContent = `${day}, ${date} ${month} ${year} ${hours}:${minutes}:${seconds}`;
        }

        // Update clock every second
        setInterval(updateClock, 1000);

        // Initialize clock
        updateClock();
    </script>
</x-app-layout>
