const checkboxNameCheck = () => {
    let checkboxName = $('#checkboxpic').prop('checked');

    if (checkboxName) {
        let contactName = $('#kontakname').val();
        $('#kontakpic').val(contactName);
        $('#kontakpic').prop('readonly',true);
    } else {
        $('#kontakpic').val("");
        $('#kontakpic').prop('readonly',false);
    }
}

const checkboxOtherNumber = () => {
    let checkboxNumber = $('#checkboxothernumber').prop('checked');
    
    if (checkboxNumber) {
        $('#othernumber').show('slow')
    } else {
        $('#othernumber').hide('slow')
    }
}

const apiKey = 'AIzaSyCeDkfTdbItauOG0J6KjXQGs8k_-EUoub8'; // Ganti dengan API Key Google Anda

$(document).ready(function () {
    if (navigator.geolocation) {
        
        // Minta lokasi
        navigator.geolocation.getCurrentPosition(
            function(position) {
                // Jika berhasil
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                $('#latitude').val(latitude);
                $('#longitude').val(longitude);

                getAddress(latitude, longitude);
            },
            function(error) {
                // Jika terjadi kesalahan
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        $('#status').text('Izin lokasi ditolak.');
                        break;
                    case error.POSITION_UNAVAILABLE:
                        $('#status').text('Informasi lokasi tidak tersedia.');
                        break;
                    case error.TIMEOUT:
                        $('#status').text('Permintaan lokasi melebihi waktu.');
                        break;
                    default:
                        $('#status').text('Terjadi kesalahan yang tidak diketahui.');
                }
            }
        );
    } else {
        $('#status').text('Geolocation tidak didukung oleh browser Anda.');
    }
});

const getAddress = (latitude, longitude) => {
    const url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${apiKey}`;
                
    $.getJSON(url, function(data) {
        // console.log(data);
        if (data.status === 'OK') {
            const address = data.results[0].formatted_address;
            $('#kontakalamat').val(address);
        } else {
            $('#kontakalamat').text('Tidak ditemukan.');
        }
    }).fail(function() {
        $('#status').text('Terjadi kesalahan saat mengambil data alamat.');
    });
}


