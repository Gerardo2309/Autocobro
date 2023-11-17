/*-----------Variables---------*/
var tableProducts;
var formSetProducts = document.querySelector('#formSetProducts');
var myModal = "";

let Idform = document.querySelector('#txtidform');
let Codebar = document.querySelector('#txtBarcode');
let NameProd = document.querySelector('#txtNPProd');
let Stock = document.querySelector('#txtStock');
let Mxn = document.querySelector('#txtMxn');
let Usd = document.querySelector('#txtUsd');
let Categoty = document.querySelector("#txtCategory");
let formExcel = document.querySelector('#formExcel');
let divExcel = document.querySelector('#divExcel');
let idExcel = document.querySelector('#txtidExcel');
formExcel.style.display = 'flex';
divExcel.style.display = 'none';

/*-----------------------------*/


function getCategory(cat){
	removeOptions('txtCategory');

    $.ajax({
      type: "GET",
      dataType: "json",
      url:base_url()+"/Products/getCategorys",
      data: { get_param: 'value' },
      success: function(data){
          for (var i = 0; i < data.length; i++) {
          	if(data[i].id_categoria == cat){
          		$('#txtCategory').append("<option selected value = '"+data[i].id_categoria+"'>"+data[i].nom_categoria+"</option>");

          	}else{
          		$('#txtCategory').append("<option value = '"+data[i].id_categoria+"'>"+data[i].nom_categoria+"</option>");
          	}
          }
          $('#txtCategory').select2({placeholder: "Seleccionar",
          	allowClear: true,
			dropdownParent: "#modalSentProducts",
		});
      }
    });
}

function removeOptions(selectElement) { 
	document.getElementById(selectElement).innerHTML = ""
	$('#'+selectElement).append("<option selected value = ''>Choose...</option>");
}



document.addEventListener('DOMContentLoaded', function(){
	tableProducts = $('#tableProducts').DataTable({
		"aProcessing":true,
		"aServerSide":true,
		"language": {
			"url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/English.json"
		},
		"ajax":{
			"url":base_url()+"/Products/getProducts",
			"dataSrc":""
		},
		"columns":[
			{"data":"cod_articulo"},
			{"data":"nom_articulo"},
			{"data":"id_categoria" },
			{"data":"price"},
			{"data":"stock"},
			{"data":"options"},
		],
		"responsive":true,
		"bDestroy":true,
		"iDisplayLength":10,
		"order":[[0,"desc"]]
	});
});


function openModalPdts(){
	myModal = new bootstrap.Modal(document.getElementById('modalSentProducts'), {keyboard: false});
	getCategory("");
	document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
	document.querySelector('#btnActionForm').classList.replace("btn-warning","btn-primary");
	document.querySelector('#btnText').innerHTML = "Saved";
	document.querySelector('#titleModal').innerHTML = "Add New Product";
	document.querySelector('#formSetProducts').reset();
	Idform.value = 1;
	myModal.show();
}

function buttonExcel(){
	if(formExcel.style.display === 'flex'){
		formExcel.style.display = 'none';
		divExcel.style.display = 'block'
	}else{
		formExcel.style.display = 'flex';
		divExcel.style.display = 'none';

	}
}

formSetProducts.onsubmit = function(e){
	e.preventDefault();
	/*if(idExcel.value == 3){

	}else*/ if (Codebar.value == '' || NameProd.value == ''|| Stock.value == ''|| Mxn.value == ''|| Usd.value == ''|| Categoty.value == ''){
		swal("Attention", "All fields are required", "error");
		return false;
	}else{
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		if(Idform.value == 1){
			var ajaxUrl = base_url()+'/Products/setProducts';
		}else if (Idform.value == 2) {
			var ajaxUrl = base_url()+'/Products/setUpProduct';
		}
		var formData = new FormData(formSetProducts);
		request.open("POST",ajaxUrl,true);
		request.send(formData);
		request.onreadystatechange = function(){
		    if (request.readyState == 4 && request.status == 200) {
				var objData = JSON.parse(request.responseText);
				if (objData.status) {
					myModal.hide();
					swal("¡Correcto!", objData.msg, "success");
					$('#tableProducts').DataTable().ajax.reload();

				}else{
					swal("Error", objData.msg, "error");
			    }
			}
		}
	}
}  

function openModalEditP(comp){
	myModal = new bootstrap.Modal(document.getElementById('modalSentProducts'), {keyboard: false});	
	formSetProducts.reset();
	document.querySelector('.modal-header').classList.replace("headerRegister","headerUpdate");
	document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-warning");
	document.querySelector('#btnText').innerHTML = "Update";
	document.querySelector('#titleModal').innerHTML = "Edit User";
	Idform.value = 2;
	editProduct(comp.id);
	myModal.show();
}


function editProduct(id){
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Products/getProduct/'+id;
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
			if (objData.status) {
				Codebar.value = objData.msg.cod_articulo;
				Codebar.readOnly = true;
				NameProd.value = objData.msg.nom_articulo;
				Stock.value = objData.msg.stock;
				Mxn.value = objData.msg.preciomxm;
				Usd.value = objData.msg.preciousd;
				getCategory(objData.msg.id_categoria);
				//$("#txtCategory").select2('data', { id:objData.msg.id_categoria, text: "Hello!"});
          		//Categoty.value = objData.msg.id_categoria;
			}
		}
	}
}

function openModalDelP(comp){
	swal({
	  title: "Are you sure?",
	  text: "Once deleted, you will not be able to get this user back!",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	  	DeletPdts(comp);
	  }
	});
}

function DeletPdts(comp){
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Products/setDelProducts/'+comp.id;
	request.open("POST",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
			if (objData.status) {
				swal("¡Correcto!", objData.msg, "success");
				$('#tableProducts').DataTable().ajax.reload();

			}else{
				swal("Error", objData.msg, "error");
			}
		}
	}
}