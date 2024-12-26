function messageAlert(message, isError = false) {
    if (!message && !isError) {
        var message = "Data berhasil di-update";
    } else if (!message && isError) {
        var message = "Data berhasil tidak dapat di-update";
    }

    if (isError) {
        var alertType = "danger";
        var icon =
            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';
    } else {
        var alertType = "success";
        var icon =
            '<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><desc>Download more icon variants from https://tabler-icons.io/i/check</desc><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>';
    }

    let messageAlert =
        '<div class="alert alert-important alert-' +
        alertType +
        ' alert-dismissible" style="display:none" role="alert">' +
        '<div class="d-flex">' +
        icon +
        "<div>" +
        message +
        "</div>" +
        "</div>" +
        "</div>";

    $("#message-alert").html(messageAlert);
    $("#message-alert .alert").fadeIn("slow");

    document.documentElement.scrollTop = 0;

    setTimeout(function () {
        $("#message-alert .alert").fadeOut("slow");
    }, 3000);
}

function refreshPage() {
    location.reload(true); // Menggunakan metode reload dengan menghapus cache (parameter true)
}

$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
  })