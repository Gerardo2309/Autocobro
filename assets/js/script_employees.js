/*-----------Variables---------*/
var tableEmployees;
var formSetEmployee = document.querySelector('#formSetEmployee');
var myModal = "";

let Idform = document.querySelector('#txtidform');
let Olduser = document.querySelector('#txtolduser');
let StrUsername = document.querySelector('#txtusername');
let StrRol = document.querySelector('#txtRol');
let StrFname = document.querySelector('#txtNames');
let StrLname = document.querySelector('#txtLNames');
let Pass = document.querySelector("#txtPass");
let Conpass = document.querySelector("#txtConPass");
const ConfirmDel = document.querySelector(".swal-button--confirm");
/*-----------------------------*/

document.addEventListener('DOMContentLoaded', function(){
	tableEmployees = $('#tableEmployees').DataTable({
		"aProcessing":true,
		"aServerSide":true,
		"language": {
			"url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/English.json"
		},
		"ajax":{
			"url":base_url()+"/Employees/getEmployees",
			"dataSrc":""
		},
		"columns":[
			{"data":"id_usuario"},
			{"data":"nom_user"},
			{"data":"apellido" },
			{"data":"id_rol"},
			{"data":"options"},
		],
		"responsive":true,
		"bDestroy":true,
		"iDisplayLength":10,
		"order":[[0,"desc"]]
	});
});

function openModalNE(){
	myModal = new bootstrap.Modal(document.getElementById('modalSentEmployee'), {keyboard: false});	
	document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
	document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
	document.querySelector('#btnText').innerHTML = "Saved";
	document.querySelector('#titleModal').innerHTML = "Add New User";
	Pass.setAttribute("class", 'form-control');
	Conpass.setAttribute("class", 'form-control');
	document.querySelector('#formSetEmployee').reset();
	Idform.value = 1;
	myModal.show();
}

formSetEmployee.onsubmit = function(e){
	e.preventDefault();
	if (StrUsername.value == '' || StrRol.value == ''|| StrFname.value == ''|| StrLname.value == ''|| Pass.value == ''|| Conpass.value == ''){
		swal("Attention", "All fields are required", "error");
		return false;
	}
	if (Pass.value != Conpass.value) {
		swal("Attention", "Password is incorrect", "error");
		return false;	
	}else{
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		if(Idform.value == 1){
			var ajaxUrl = base_url()+'/Employees/setEmployee';
		}else if (Idform.value == 2) {
			var ajaxUrl = base_url()+'/Employees/setUpEmploy';
		}
		var formData = new FormData(formSetEmployee);
		request.open("POST",ajaxUrl,true);
		request.send(formData);
		request.onreadystatechange = function(){
		    if (request.readyState == 4 && request.status == 200) {
				var objData = JSON.parse(request.responseText);
				if (objData.status) {
					myModal.hide();
					swal("¡Correcto!", objData.msg, "success");
					$('#tableEmployees').DataTable().ajax.reload();

				}else{
					swal("Error", objData.msg, "error");
			    }
			}
		}
	}
}       

function openModalEditE(comp){
	myModal = new bootstrap.Modal(document.getElementById('modalSentEmployee'), {keyboard: false});	
	document.querySelector('#formSetEmployee').reset();
	document.querySelector('.modal-header').classList.replace("headerRegister","headerUpdate");
	document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-warning");
	document.querySelector('#btnText').innerHTML = "Update";
	document.querySelector('#titleModal').innerHTML = "Edit User";
	Pass.setAttribute("class", 'form-control');
	Conpass.setAttribute("class", 'form-control');
	Idform.value = 2;
	editemploy(comp.id);
	myModal.show();
}

function openModalDelE(comp){
	swal({
	  title: "Are you sure?",
	  text: "Once deleted, you will not be able to get this user back!",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	  	DeletEmploy(comp);
	  }
	});
}


function DeletEmploy(comp){
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Employees/setDelEmploy/'+comp.id;
		request.open("POST",ajaxUrl,true);
		request.send();

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
			if (objData.status) {
				swal("¡Correcto!", objData.msg, "success");
				$('#tableEmployees').DataTable().ajax.reload();

			}else{
				swal("Error", objData.msg, "error");
			}
		}
	}
}

function editemploy(id){
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
}

function Confirmpass(e){
  if (Pass.value == e) {
	Pass.setAttribute("class", 'form-control is-valid');
	Conpass.setAttribute("class", 'form-control is-valid');
  }else{
	Pass.setAttribute("class", 'form-control is-invalid');
	Conpass.setAttribute("class", 'form-control is-invalid');
  }
}