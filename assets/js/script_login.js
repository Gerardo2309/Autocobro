var formLogin = document.querySelector('#formLogin');
formLogin.onsubmit = function(e){
	e.preventDefault();
	var strUser = document.querySelector('#txtuser').value;
	var strPassword = document.querySelector('#txtpassword').value;
	if (strUser == '' || strPassword == ''){
		swal("Atencion", "Todos los campos son obligatorios", "error");
		return false;
	} 
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Home/getlogin';
	var formData = new FormData(formLogin);
	request.open("POST",ajaxUrl,true);
	request.send(formData);
	request.onreadystatechange = function(){
	    if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
			if (objData.status) {
                window.location.replace(objData.msg);
			}else{
				swal("Error", objData.msg, "error");
		    }
		}
	}
}
