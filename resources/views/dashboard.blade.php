@section('titlepage','Beranda')
@section('subtitlepage')
    <div id="clock"></div>
@endsection
<x-app-layout>

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
