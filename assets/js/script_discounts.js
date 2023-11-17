window.onload=function() {
    viewDiscount();
}

let Divupdate = document.querySelector("#divupdis");
let Strdiscount = document.querySelector("#txtDiscount");
let Idform = document.querySelector('#txtidform');
let User = document.querySelector('#txtuser');
let TitleDiscount = document.querySelector('#titledisconut');


function viewDiscount(){
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Discounts/getDiscounts';
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			objData = JSON.parse(request.responseText);
			if (objData.status) {
				TitleDiscount.innerHTML = objData.msg[0].nom_discount+"% Off In All Stores"
			}else{
				TitleDiscount.innerHTML = "No Discounts Available"
			}
		}
	}
}

function viewmodalupdis() {
	Divupdate.setAttribute("class", 'col-md-6 col-sm-12');
}

formSetDiscount.onsubmit = function(e){
	e.preventDefault();
	if (Strdiscount.value == ''){
		swal("Attention", "All fields are required", "error");
		return false;
	}
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Discounts/setUpDiscount';
	var formData = new FormData(formSetDiscount);
	request.open("POST",ajaxUrl,true);
	request.send(formData);
	request.onreadystatechange = function(){
	    if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
			if (objData.status) {
				Divupdate.setAttribute("class", 'col-md-6 col-sm-12 ocultarmodal');
				viewDiscount();
				swal("¡Correcto!", objData.msg, "success");
			}else{
				swal({
				  title: "Attention!",
				  text: objData.msg,
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
				  	insertDiscount();
				  }
				});
			}
		}
	}
} 

function insertDiscount(){
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Discounts/setDiscount';
	var formData = new FormData(formSetDiscount);
	request.open("POST",ajaxUrl,true);
	request.send(formData);
	request.onreadystatechange = function(){
	    if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
			if (objData.status) {
				Divupdate.setAttribute("class", 'col-md-6 col-sm-12 ocultarmodal');
				viewDiscount();
				swal("¡Correcto!", objData.msg, "success");
			}else{
				swal("Error", objData.msg, "error");
			}
		}
	}
}



