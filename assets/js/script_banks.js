/*-----------Variables---------*/
var tableBanks;
var formSetBanks = document.querySelector('#formSetBanks');
var myModal = "";

let bankcode = document.querySelector('#txtNBank');
let divisa = document.querySelector('#txtDivisa');
let namebank = document.querySelector('#txtNameB');
/*let StrFname = document.querySelector('#txtNames');
let StrLname = document.querySelector('#txtLNames');
let Pass = document.querySelector("#txtPass");
let Conpass = document.querySelector("#txtConPass");
const ConfirmDel = document.querySelector(".swal-button--confirm");*/
/*-----------------------------*/

document.addEventListener('DOMContentLoaded', function(){
	tableBanks = $('#tableBanks').DataTable({
		"aProcessing":true,
		"aServerSide":true,
		"language": {
			"url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/English.json"
		},
		"ajax":{
			"url":base_url()+"/Banks/getBanks",
			"dataSrc":""
		},
		"columns":[
			{"data":"cod_bank"},
			{"data":"nom_bank"},
			{"data":"mxn_usd" },
			{"data":"options"},
		],
		"responsive":true,
		"bDestroy":true,
		"iDisplayLength":10,
		"order":[[0,"desc"]]
	});
});

function openModalBanks(){
	myModal = new bootstrap.Modal(document.getElementById('modalSentBank'), {keyboard: false});	
	document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
	document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
	document.querySelector('#btnText').innerHTML = "Saved";
	document.querySelector('#titleModal').innerHTML = "Add New Bank";
	document.querySelector('#formSetBanks').reset();
	//Idform.value = 1;
	myModal.show();
}

formSetBanks.onsubmit = function(e){
	e.preventDefault();
	if (bankcode.value == '' || divisa.value == ''|| namebank.value == ''){
		swal("Attention", "All fields are required", "error");
		return false;
	}
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url()+'/Banks/setBank';
		var formData = new FormData(formSetBanks);
		request.open("POST",ajaxUrl,true);
		request.send(formData);
		request.onreadystatechange = function(){
		    if (request.readyState == 4 && request.status == 200) {
				var objData = JSON.parse(request.responseText);
				if (objData.status) {
					myModal.hide();
					swal("¡Correcto!", objData.msg, "success");
					$('#tableBanks').DataTable().ajax.reload();

				}else{
					swal("Error", objData.msg, "error");
			    }
			}
		}
	}      

/*function openModalEditE(comp){
	myModal = new bootstrap.Modal(document.getElementById('modalSentBank'), {keyboard: false});	
	document.querySelector('#formSetBanks').reset();
	document.querySelector('.modal-header').classList.replace("headerRegister","headerUpdate");
	document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-warning");
	document.querySelector('#btnText').innerHTML = "Update";
	document.querySelector('#titleModal').innerHTML = "Edit User";
	Pass.setAttribute("class", 'form-control');
	Conpass.setAttribute("class", 'form-control');
	Idform.value = 2;
	editemploy(comp.id);
	myModal.show();
}*/

function openMDelBank(comp){
	swal({
	  title: "Are you sure?",
	  text: "Once deleted, you will not be able to get this user back!",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	  	DeletBank(comp);
	  }
	});
}


function DeletBank(comp){
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Banks/setDelBank/'+comp.id;
		request.open("POST",ajaxUrl,true);
		request.send();

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
			if (objData.status) {
				swal("¡Correcto!", objData.msg, "success");
				$('#tableBanks').DataTable().ajax.reload();

			}else{
				swal("Error", objData.msg, "error");
			}
		}
	}
}

/*function editemploy(id){
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Employees/getEmploy/'+id;
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
			if (objData.status) {
				Olduser.value = objData.msg.id_usuario;
				StrUsername.value = objData.msg.id_usuario;
				StrRol.value = objData.msg.id_rol;
				StrFname.value = objData.msg.nom_user;
				StrLname.value = objData.msg.apellido;
			}
		}
	}
}*/