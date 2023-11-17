window.onload=function() {
		getdiscount();
		navbar();
}

//-------------variables globales-----------------//
const Mcantcarr = document.querySelector("#cantcarr");

const MostrarMxm = document.querySelector("#totalmxm");
const MostrarUds = document.querySelector("#totalusd");
const $productosc = document.querySelector("#rproducto");
const $scanpremxm = document.querySelector("#preciomxm");
const $scanpreusd = document.querySelector("#preciousd");
const $dispreusd = document.querySelector("#dispreusd");
const $dispremxm = document.querySelector("#dispremxm");
const modal = document.getElementById("modalSolicitudesa");
let nuevaData;
var str = [];
var pagototal = [];
var cantarr;
var formSubirsScan = document.querySelector('#formSubirsScan');
var myModal = "";
var discount;
var contador = 1;


//-----------------------------------------------//

function navbar(){
	$('.menu_bar').click(function(){
		// $('nav').toggle(); 

		if(contador == 1){
			$('.tbproductos').animate({
				left: '0'
			});
			contador = 0;
		} else {
			contador = 1;
			$('.tbproductos').animate({
				left: '-100%'
			});
		}

	});
}


document.addEventListener("DOMContentLoaded", () => {
	Quagga.init({
		inputStream: {
			constraints: {
				width: 1920,
				height: 1080,
			},
			name: "Live",
			type: "LiveStream",
			target: document.querySelector('#contenedor'), // Pasar el elemento del DOM
		},
		frequency:1,
		decoder: {
			readers: ["code_128_reader",
                        "ean_reader",
                        "ean_8_reader",
                        "code_39_reader",
                        "code_39_vin_reader",
                        "codabar_reader",
                        "upc_reader",
                        "upc_e_reader",
                        "i2of5_reader"]
		}
	}, function (err) {
		if (err) {
			console.log(err);
			return
		}
		console.log("Iniciado correctamente");
		Quagga.start();
	});

	Quagga.onProcessed(function (result) {
		var drawingCtx = Quagga.canvas.ctx.overlay,
			drawingCanvas = Quagga.canvas.dom.overlay;

		if (result) {
			if (result.boxes) {
				drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
				result.boxes.filter(function (box) {
					return box !== result.box;
				}).forEach(function (box) {
					Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, { color: "green", lineWidth: 2 });
				});
			}

			if (result.box) {
				Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, { color: "#00F", lineWidth: 2 });
			}

			if (result.codeResult && result.codeResult.code) {
				Quagga.ImageDebug.drawPath(result.line, { x: 'x', y: 'y' }, drawingCtx, { color: 'red', lineWidth: 3 });
			}
		}
	});

	Quagga.onDetected((data) => {
		var audio = document.getElementById("audio");
		audio.play();
		checodebar(data.codeResult.code);
		// Imprimimos todo el data para que puedas depurar
		console.log(data);
	});
	
});

function checodebar(codigobarras){
	var codebar = codigobarras;
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Scanner/getcodebr';
	var formData = new FormData();
	formData.append("codebar", codebar);
	request.open("POST",ajaxUrl,true);
	request.send(formData);

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
			if (objData.status) {
				$productosc.textContent = objData.msg[0].nom_articulo;
				$dispremxm.textContent = "$" + (objData.msg[0].preciomxm*discount).toFixed(2) + " MXM";
				$dispreusd.textContent = "$" + (objData.msg[0].preciousd*discount).toFixed(2)  + " USD";

				if (discount>1) {
					$scanpremxm.innerHTML = "<del>$" + objData.msg[0].preciomxm + " MXM</del>";
					$scanpreusd.innerHTML = "<del>$" + objData.msg[0].preciousd  + " USD</del>";
				}

				if(objData.msg[0].stock >=1){
					agregarFila(objData.msg[0].cod_articulo,objData.msg[0].nom_articulo, 1, objData.msg[0].preciousd,objData.msg[0].preciomxm, objData.msg[0].stock-1)
				}else{
					swal("Atencion", "No hay stock", "error");
				}
				objData = [];
			}
		}
	}

}

function getdiscount(){
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Scanner/getDiscounts';
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			objData = JSON.parse(request.responseText);
			if (objData.status) {
				discount = 1-(objData.msg[0].nom_discount/100);
			}else{
				discount = 1-0;
			}
		}
	}
}


function agregarFila(id,nombre, cantidad, preciousd, preciomxm,stock){
	var pdisusd = preciousd*discount;
	var pdismxn = preciomxm*discount;
	var tdid = '<td for="id">' + id + '</td>';
	var tdnombre = '<td>'+nombre+'</td>';
	var tdcantidad = '<td id="can'+id+'">'+cantidad+'</td>';
	var tdstock = '<td id="stk'+id+'">'+(stock)+'</td>';
	var tdaction = '<td><button type="button" class="btn icon btn-danger btnadd" onclick="eliminar(this)" id="'+id+'"></button><button type="button" class="btn icon btn-success btnadd" onclick="agregar(this)" id="'+id+'"></button></td>';
	
	if (discount>1) {
		var tdprecio = '<td id="usd'+id+'"><div class="row"><div class="col-sm-12 dispreciop"><del>$'+preciousd+'USD</del></div><div class="col-sm-12 dispreciop"><del>$'+preciomxm+'MXM</del></div><div class="col-sm-12">$'+pdisusd.toFixed(2)+'USD</div><div class="col-sm-12">$'+pdismxn.toFixed(2)+'MXM</div></div></td>';
	}else{
		var tdprecio = '<td id="usd'+id+'"><div class="row"><div class="col-sm-12">$'+pdisusd.toFixed(2)+'USD</div><div class="col-sm-12">$'+pdismxn.toFixed(2)+'MXM</div></div></td>';

	}

	if (checkId(id)) {
		var state = findState(str, id, cantidad);
		if (state[1] == 0) {
			str.splice(state[0],1);
		}else if(state[1] > 0){
			if (state[2] == 0) {
				swal("Atencion", "No hay stock", "error");

			}
			if(state[2] >= 0){
				str[state[0]].cantidad = state[1];
				str[state[0]].stock = state[2];
				var resultusd = state[1]*str[state[0]].preciousd;
				var resultmxn = state[1]*str[state[0]].preciomx;
				if (discount>1) {
					tdprecio = '<td id="usd'+id+'"><div class="row"><div class="col-sm-12 dispreciop"><del>$'+(resultusd*((1-discount)*100)).toFixed(2)+'USD</del></div><div class="col-sm-12 dispreciop"><del>$'+(resultmxn*((1-discount)*100)).toFixed(2)+'MXM</del></div><div class="col-sm-12">$'+resultusd.toFixed(2)+'USD</div><div class="col-sm-12">$'+resultmxn.toFixed(2)+'MXM</div></div></td>';
				}else{
					tdprecio = '<td id="usd'+id+'"><div class="row"><div class="col-sm-12">$'+resultusd.toFixed(2)+'USD</div><div class="col-sm-12">$'+resultmxn.toFixed(2)+'MXM</div></div></td>';
				}
				document.getElementById("can"+id).innerHTML = state[1];
				document.getElementById("usd"+id).innerHTML = tdprecio;
				document.getElementById("stk"+id).innerHTML = state[2];
			}
		}
  }else{
  	nuevaData = str.push({"id":id,"nombres":nombre,"preciousd":pdisusd,"preciomx":pdismxn,"cantidad":cantidad,"stock":stock});
 		document.getElementById("tablaproductos").getElementsByTagName('tbody')[0].insertRow(-1).innerHTML = tdid+tdnombre+tdcantidad+tdprecio+tdstock+tdaction;
  }
  caltotal(str)
	MostrarMxm.innerHTML = "$"+pagototal[0]+" MXN";
	MostrarUds.innerHTML = "$"+pagototal[1]+" USD";

	Mcantcarr.innerHTML = str.length;

}

function caltotal(canasta){
	pagototal = [];
	var sumamxm = 0;
	var sumausd = 0;
	for (var numero in canasta) {
   sumamxm += parseFloat(canasta[numero].preciomx*canasta[numero].cantidad);
   sumausd += parseFloat(canasta[numero].preciousd*canasta[numero].cantidad);
	}
	pagototal.push(sumamxm.toFixed(2),sumausd.toFixed(2));
}

function eliminarFila (id) {
	var elem = document.getElementById(id);
	elem.closest('tr').remove();
}

function checkId (id) {
	let ids = document.querySelectorAll('#tablaproductos td[for="id"]');

  return [].filter.call(ids, td => td.textContent === id).length === 1;
}

// Verifica todas las condiciones para el elemento dado
function findState(data, id, cantidad) {
  var id = id.toString()
  for (var k in data) {
    var ids = data[k].id;
    if (ids == id){
			var stockgen = data[k].stock;
    	var cant = data[k].cantidad+cantidad;
    	if (cant<1) {
   			cantarr = [];
	     	cantarr = [k,cant,stockgen];
				eliminarFila(id);
    	}else if (stockgen == 0 && cantidad == -1) {
    		stockgen = data[k].stock-cantidad;
    		cantarr = [];
	     	cantarr = [k,cant,stockgen];
    	}else if(stockgen > 0){
    		stockgen = data[k].stock-cantidad;
    		cantarr = [];
	     	cantarr = [k,cant,stockgen];
	    }else if (stockgen == 0 && data[k].cantidad == 1) {
	    	cantarr = [];
	     	cantarr = [k,cant-1,stockgen];
	    }else if (stockgen==0) {
	    	cantarr = [];
	    	cantarr = [k,data[k].cantidad,stockgen];
	    }

	    return cantarr;

    }
  }
}

function eliminar(comp){
	agregarFila(comp.id,"", -1, 0, 0, 0);
}

function agregar(comp){
	agregarFila(comp.id,"", 1, 0, 0, 0);
}


function modalinfo(){
	myModal = new bootstrap.Modal(document.getElementById('modalSentdatos'), {keyboard: false});
	document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
	document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-info");
	document.querySelector('#btnText').innerHTML = "Guardar";
	document.querySelector('#titleModal').innerHTML = "Completa la informacion";
	document.querySelector('#formSubirsScan').reset();
	myModal.show();
}



formSubirsScan.onsubmit = function(e){
	e.preventDefault();
	var strNumero = document.querySelector('#intNumero').value;
	var strColor = document.querySelector('#txtColores').value;
	var strVendedor = document.querySelector('#txtVendedor').value;
	if (strNumero == '' || strColor == '' || strVendedor == ''){
		if (str.length == 0) {
			swal("Atencion", "Favor De Agregar Productos", "error");
			return false;
		}else{
			swal("Atencion", "Todos los campos son obligatorios", "error");
			return false;
		}
	} 
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Scanner/setProducts/'+JSON.stringify(str);
	var formData =  new FormData(formSubirsScan);
	request.open("POST",ajaxUrl,true);
	request.send(formData);
	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
			if (objData.status) {
				myModal.hide();
				limpventa();
				swal("¡Correcto!", objData.msg ,"success");
			}else{
				swal({
				  title: "¡Atencion!",
				  text: objData.msg,
				  icon: "error",
				  buttons: true,
				  dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
				  	var gft = strNumero+" "+strColor;
				  	AddDetCaja(gft,str);
				  }
				});
			}
		}
	}
}

function AddDetCaja(gaft,arr){
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Scanner/setDetProd/'+JSON.stringify(str)+'/'+JSON.stringify(gaft);
	request.open("POST",ajaxUrl,true);
	request.send();
	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
			if (objData.status) {
				myModal.hide();
				limpventa();
				swal("¡Correcto!", objData.msg ,"success");
			}else{
				swal("Error", objData.msg, "error");
			}
		}
	}
}



function limpventa(){
	str = [];
	contador = 1;
	$('.tbproductos').animate({
		left: '-100%'
	});
	Mcantcarr.innerHTML = "0";
	MostrarMxm.innerHTML = "$0.00 MXN";
	MostrarUds.innerHTML = "$0.00 USD";
	$productosc.textContent = "";
	$scanpremxm.textContent = "";
	$scanpreusd.textContent = "";
	$dispremxm.textContent = "";
	$dispreusd.textContent = "";
	var table = document.getElementById('tablaproductos');
	var tableHeaderRowCount = 1;
	var rowCount = table.rows.length;
	for (var i = tableHeaderRowCount; i < rowCount; i++) {
	    table.deleteRow(tableHeaderRowCount);
	}
}