// const { data } = require("alpinejs");

const addListProduct = [];
let {
    tempIdProduct,
    productName,
    idProduct,
    productPrice,
    productQty,
    totalProductPrice,
    totalProductQty
} = 0;
$('#consignercompany').on('change', function(){
    let idCompany = $(this).val();
    if(idCompany){
        $('#cancelButton').show('fast');
        $('#productdisplay').show('fast');
        $('#tableList').show('fast');
        $(this).prop('disabled',true)
        $.ajax({
            url : '/add-consignor-sale/getProduct/'+idCompany,
            type : "GET",
            data : {
                "_token"    : "{{csrf_token()}}",
                "id"        : idCompany
            },
            dataType : "json",
            success : function(data){
                // console.log(data);
                $('#product').html('');
                $('#product').prop('disabled',false);
                $('#product').append('<option val=""> Pilih Produk / Barang </option>');
                $.each(data.product, function(key,item){
                    $('#product').append('<option value="' + item.id + '">' + item.product_name + '</option>')
                });
            }
        });
    } else {
        $('#cancelButton').hide('fast');
        $('#productdisplay').hide('fast');
    }
})

$('#btnCancel').on('click', function(){
    $('#cancelButton').hide('fast');
    $('#productdisplay').hide('fast');
    $('#product').html('');
    $('#productdisplay').hide('fast');
    $('#consignercompany').prop('disabled',false);
    $('#tableList').hide('fast');
    $('#listProduct').html('');
    addListProduct = [];
    $('#totalTitipan').text(0);
    $('#btnSubmitConsigner').prop('disabled',true);
})


const getUrl = window.location.href.split('/');

const randomId = () => {
	return '_' + Math.random().toString(36).substr(2, 9);
}

const setInititalListProduct = () => {
	tempIdProduct = randomId();
}

const resetFormProduct = () => {
    tempIdProduct = randomId();
    $('#product').select2().val("");
    $('#productqty').val(0);
    $('#productprice').val(0);
}

const addToListProduct = () => {
    tempIdProduct = randomId();
    let qtyString = $('#productqty').val();
    let priceString = $('#productprice').val();
    idProduct = $('#product option:selected').select2().val();
    productName = $('#product option:selected').select2().text();
    productQty = parseFloat(qtyString.replaceAll('.',''));
    productPrice = parseFloat(priceString.replaceAll('.',''));

    if (tempIdProduct == 0) {
		messageAlert('Terjadi kesalahan saat mendapatkan id produk sementara', 1);
		return false;
	}

    const batchExist = addListProduct.filter((q) => q.idProduct === idProduct).length > 0;
    if (batchExist) {
        messageAlert('Data Produk sudah ada', 1);
        resetFormProduct();
        return false;
    }

    const newDataListProduct = {
        tempIdProduct,
        productName,
        idProduct,
        productPrice,
        productQty,
        totalProductPrice,
        totalProductQty
    };
    // console.log(newDataListProduct);
    addListProduct.push(newDataListProduct);
    const isSuccess = addListProduct.filter((w) => w.tempIdProduct === tempIdProduct).length > 0;
    if (isSuccess) {
        resetFormProduct();
    } else {
        messageAlert('Data Pembelian tidak dapat ditambahkan', 1);
    }
    loadListDaftarTitip();
}

const loadListDaftarTitip = () => {
    $('#listProduct').html('');
    if (addListProduct.length > 0) {
        let totalConsigner = parseFloat(0);
        let totalQtyConsigner = parseFloat(0);
        for (const element of addListProduct) {
            totalConsigner += element.productPrice * element.productQty;
            totalQtyConsigner += element.productQty;
            $('#listProduct').append(`<tr id="${element.tempIdProduct}">`
                +`<td>${element.productName}</td>`
                +`<td class="text-center">${element.productQty}</td>`
                +`<td class="text-end">${element.productPrice}</td>`            
                +`<td class="text-end">${element.productPrice * element.productQty}</td>`
                + `<td class"text-center">`
				+ `<a href="#" onclick="removeFromListProduk('${element.tempIdProduct}')" class="btn btn-icon btn-red btn-sm w-100">`
				+ `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">`
				+ `<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>`
				+ `<path d="M4 7h16"></path>`
				+ `<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>`
				+ `<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>`
				+ `<path d="M10 12l4 4m0 -4l-4 4"></path>`
				+ `</svg>`
				+ `</a>`
				+ `</td>`  
            +`</tr>`)

        }
        $('#totalTitipan').text(totalConsigner.toLocaleString('id-ID'));
        resetFormProduct();
        $('#btnSubmitConsigner').prop('disabled',false);
    } else {
        $('#totalTitipan').text(0);
        $('#btnSubmitConsigner').prop('disabled',true);
    }
}

const removeFromListProduk = (tempIdProduct) => {
    const index = addListProduct.findIndex((q) => q.tempIdProduct === tempIdProduct);
    if (index !== -1) {
		addListProduct.splice(index, 1);
	} else {
		messageAlert('Data Produk tidak dapat dihapus', 1);
	}

    loadListDaftarTitip();
}

function submitConsignor() {
    if (addListProduct == 0) {
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
        url         : '/add-consignor-sale/store-consigner',
        type        : 'post',
        dataType    : 'json',
        data        : {
            daftarProduk : addListProduct,
            companyId    : $('#consignercompany option:selected').select2().val(),
            vendorId     : $('#consignercontact option:selected').select2().val()
        },
        success : function(response){
            messageAlert(response.message);
			setTimeout(function()
			{
				window.addListProduct = [];
				window.location.href = "/consignor-sale";
			}, 1000);
        },
        error : function(data){

        }
    });
}

if (getUrl[3] == 'add-consignor-sale') {
	window.addEventListener("load", setInititalListProduct);
}

// complete-consigner 

function calculatingRemaining(totalQty,id) {
    let soldQty = $('#soldQty_'+id).val() || 0;

    $('#footerCard').show('fast');
    $('#btnSubmitComplete').prop('disabled',false);

    let remainingQty = parseFloat(totalQty - soldQty);

    if(soldQty > totalQty){
        messageAlert('Nilai terjual lebih besar dari jumlah dititip!',1);
        $('#soldQty_'+id).val(0)
        $('#sisaProduk_'+id).text(remainingQty)
        return false;
    }

    $('#sisaProduk_'+id).text(remainingQty)

    // console.log(remainingQty);
}