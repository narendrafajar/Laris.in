const addListCost = [];
let {
    tempIdCost,
    costType,
    costProduct,
    costQty,
    costVol,
    costPrice,
    totalCost
} = 0;

const getUrl = window.location.href.split('/');

const randomId = () => {
	return '_' + Math.random().toString(36).substr(2, 9);
}

const setInitialCost = () => {
	tempIdCost = randomId();
}

const resetFormCost = () => {
    tempIdCost = randomId();
    $('#costType').val("");
    $('#costProduct').val("");
    $('#costQty').val(0);
    $('#costPrice').val(0);
    $('#costVol').val("");
}

const addToListCost = () => {
    tempIdCost = randomId();
    let qtyString = $('#costQty').val();
    let priceString = $('#costPrice').val();
    costProduct = $('#costProduct').val();
    costType = $('#costType option:selected').val();
    costVol = $('#costVol option:selected').val();
    costQty = parseFloat(qtyString.replaceAll('.',''));
    costPrice = parseFloat(priceString.replaceAll('.',''));

    if (tempIdCost == 0) {
		messageAlert('Terjadi kesalahan saat mendapatkan id Pembelian sementara', 1);
		return false;
	}

    const newDataListCost = {
        tempIdCost,
        costType,
        costProduct,
        costQty,
        costVol,
        costPrice,
        totalCost
    };

    addListCost.push(newDataListCost);
    const isSuccess = addListCost.filter((w) => w.tempIdCost === tempIdCost).length > 0;
    if (isSuccess) {
        resetFormCost();
    } else {
        messageAlert('Data Pembelian tidak dapat ditambahkan', 1);
    }
    loadListCost();

}

const loadListCost = () => {
    $('#costBody').html("");
    if(addListCost.length > 0) {
        $('#costFooter').show('fast');
        let totalAmountCost = 0;
        // let subtotalCost = 0;
        let unitPrice = 0;
        for (const element of addListCost) {
            unitPrice = element.costPrice / element.costQty;
            subtotalCost = unitPrice*element.costQty;
            totalAmountCost += element.costPrice;
            $('#costBody').append(`<tr>`
                +`<td class="text-center">${element.costType}</td>`
                +`<td>${element.costProduct}</td>`
                +`<td class="text-center">${element.costVol}</td>`
                +`<td class="text-center">${element.costQty}</td>`
                +`<td class="text-end">${"Rp. "+unitPrice.toLocaleString('id-ID',{
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                })}</td>`
                +`<td class="text-end">${"Rp. "+subtotalCost.toLocaleString('id-ID',{
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                })}</td>`
                +`<td class="text-center">`
                + `<a href="#" onclick="removeFromListCost('${element.tempIdCost}')" class="btn btn-icon btn-red btn-sm w-100">`
				+ `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">`
				+ `<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>`
				+ `<path d="M4 7h16"></path>`
				+ `<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>`
				+ `<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>`
				+ `<path d="M10 12l4 4m0 -4l-4 4"></path>`
				+ `</svg>`
				+ `</a>`
                +`</td>`
                +`</tr>`)
        }
        // subtotalCost = 0;
        $('#totalPembelianText').text(totalAmountCost.toLocaleString('id-ID',{
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        }));
        resetFormCost();
        $('#btnSubmitCost').prop("disabled",false);
    } else {
        $('#totalPembelianText').text(0);
        $('#btnSubmitCost').prop("disabled",true);
        $('#costFooter').hide('fast');
    }
}

const removeFromListCost = (tempIdCost) => {
    const index = addListCost.findIndex((q) => q.tempIdCost === tempIdCost);
    if (index !== -1) {
		addListCost.splice(index, 1);
	} else {
		messageAlert('Data Pembelian tidak dapat dihapus', 1);
	}
    loadListCost();
}

function submitCost(){
    if (addListCost.length == 0) {
        messageAlert('Tidak dapat menyimpan. Daftar Produk Dititipkan masih kosong!', 1);
		event.preventDefault();
		return false;
    }

    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : jQuery('meta[name="csrf-token"]').attr('content')
		}
	});

    $.ajax({
        url         : '/add-cost/store-cost',
        type        : 'post',
        dataType    : 'json',
        data        : {
            daftarCost  : addListCost,
            dateCost    : $('#costDate').val(),
            vendorName  : $('#costVendor').val()
        },
        success : function(response){
            messageAlert(response.message);
            setTimeout(function()
			{
				window.addListProduct = [];
				window.location.href = "/add-cost";
			}, 1000);
        },
        error : function(data){
            messageAlert(response.message);
            return false;
        }
    });
}

if (getUrl[3] == 'add-cost') {
	window.addEventListener("load", setInitialCost);
}