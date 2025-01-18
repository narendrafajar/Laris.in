let { deleteRoute, deleteId } = "";
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

  $(document).ready(function () {
    window.pk = 0;
    $("#basic-datatables").DataTable({});

    $(".datatable-class").DataTable({
      pageLength: 5,
      initComplete: function () {
        this.api()
          .columns()
          .every(function () {
            var column = this;
            var select = $(
              '<select class="form-select"><option value=""></option></select>'
            )
              .appendTo($(column.footer()).empty())
              .on("change", function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                column
                  .search(val ? "^" + val + "$" : "", true, false)
                  .draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append(
                  '<option value="' + d + '">' + d + "</option>"
                );
              });
          });
      },
    });

    // Add Row
    $("#add-row").DataTable({
      pageLength: 5,
    });

    var action =
      '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

    $("#addRowButton").click(function () {
      $("#add-row")
        .dataTable()
        .fnAddData([
          $("#addName").val(),
          $("#addPosition").val(),
          $("#addOffice").val(),
          action,
        ]);
      $("#addRowModal").modal("hide");
    });

    // select2
    $('.select2').select2();
  });

// const myModal = document.getElementById('myModal')
// const myInput = document.getElementById('myInput')

  document.addEventListener('DOMContentLoaded', function () {
    const numericInputs = document.querySelectorAll('.numeric-input');

    numericInputs.forEach(function (input) {
        input.addEventListener('input', function () {
            // Hapus karakter non-numerik
            let rawValue = this.value.replace(/[^0-9]/g, '');

            // Format ke locale Indonesia
            let formattedValue = parseInt(rawValue || 0, 10).toLocaleString('id-ID');

            // Set kembali ke input
            this.value = formattedValue;
        });

        input.addEventListener('blur', function () {
            // Jika input kosong, reset ke nilai awal
            if (!this.value) {
                this.value = '';
            }
        });
    });
});

const callDestroyModal = (route) => {
  $.ajaxSetup({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
  });

  deleteId = route.split("/").pop();

  if (isNaN(deleteId)) {
      deleteRoute = "";
      deleteId = "";
      messageAlert("Terjadi kesalahan pada data yang akan dihapus", 1);
      return false;
  }

  deleteRoute = route;
};

$(document).on("click", ".call-delete-modal", function () {
  event.preventDefault();
  window.pk = $(this).data("id");
  $("#modal-delete").modal("show");
});

const confirmDestroy = () => {
  if (deleteRoute == "" || deleteId == "") {
      messageAlert("Terjadi kesalahan pada data yang akan dihapus", 1);
      return false;
  }

  $.ajaxSetup({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
  });
  deleteId = $('.call-delete-modal').data('id');
  deleteRoute =  window.location.pathname + "/delete-transaction"
  // console.log(deleteRoute,deleteId);

  $.ajax({
      url: deleteRoute,
      type: "delete",
      data: {
          id: deleteId,
      },
      success: function (response) {
          $("#modal-delete").modal("hide");
          messageAlert(response.message);
          setTimeout(function () {
              window.location.href = response.url;
          }, 1000);
      },
      error: function (data) {
          messageAlert(data.responseJSON.message, 1);
      },
  });
};