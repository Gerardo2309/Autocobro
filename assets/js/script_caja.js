window.onload=function() {
  setInterval('inicial()',3000);
	getdiscount();
	navbar();


}

//-------------variables globales-----------------//

	/*const $productosc = document.querySelector("#rproducto");*/
	const Mcantcarr = document.querySelector("#cantcarr");
	var Namebank = document.querySelector('#scbank');
	var Typemoneda = document.querySelector('#scmoneda');
	const MostrarMxm = document.querySelector("#totalmxm");
	const MostrarUds = document.querySelector("#totalusd");
	var formSentventa = document.querySelector('#formSentventa');
	const modal = document.getElementById("modalSolicitudesa");
	var TituloArt = document.querySelector('#titart');
	var SppiCarga = document.getElementById('spincarga');
	var gafete = "";
	let nuevaData;
	var str = [];
	const product = [];
	var bank = [];
	var pagototal = [];
	var myModal = "";
	var numstep = 1;
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


function banco(){
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
		
		bankcodebar(data.codeResult.code);
		// Imprimimos todo el data para que puedas depurar
		console.log(data.codeResult.code);
	});	
}

function offbanco(){
	Quagga.stop();
}

function inicial(){
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Caja/getinicio';
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
			if (objData.status) {
					document.getElementById("btngfts").innerHTML="";

					findgft(objData.msg);

					objData = [];
			}
		}
	}
}

function getdiscount(){
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Caja/getDiscounts';
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

function findgft(arr) {
	const busqueda = arr.reduce((acc, producto) => {
	  acc[producto.gafete] = ++acc[producto.gafete] || 0;
	  if (acc[producto.gafete]==0) {
			agregarboton(producto.gafete);
		}
	  return acc;
	}, {});

	const duplicados = arr.filter( (producto) => {
		return busqueda[producto.gafete];
	});
}

function agregarboton(elemento){
	let col = document.createElement('div');
	col.className = 'col '+elemento.substr(4,8).toString();
	col.setAttribute("id", elemento);
	col.addEventListener("click", function(){checkgft(elemento)}, false);
	const card = '<div class="card"><div class="card-body"><h5 class="card-title titgft">'+elemento.substr(0,3).toString()+'</h5></div></div>';
	col.innerHTML = card
	document.getElementById("btngfts").appendChild(col);
}

function checkgft(gft){
	gafete = gft;
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Caja/getgfts';
	var formData = new FormData();
	formData.append("gafete", gafete);
	request.open("POST",ajaxUrl,true);
	request.send(formData);

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
			if (objData.status) {
				Limpiartabla("tablaproductos");
				for (var k in objData.msg) {
					agregarFila(objData.msg[k].codigobar,objData.msg[k].nombres, objData.msg[k].cantidad, objData.msg[k].preciousd,objData.msg[k].preciomxm, objData.msg[k].stock-1,objData.msg[k].vendedor)
				}
				objData = [];
			}
		}
	}
}

function agregarFila(id, nombre, cantidad, preciousd, preciomxm, stock, vendedor){
	var pdisusd = preciousd*discount;
	var pdismxn = preciomxm*discount;
	var tdid = '<td for="id">' + id + '</td>';
	var tdnombre = '<td>'+nombre+'</td>';
	var tdcantidad = '<td id="can'+id+'">'+cantidad+'</td>';
	var tdstock = '<td id="stk'+id+'">'+(stock)+'</td>';
	var tdaction = '<td><button type="button" class="btn icon btn-danger btnadd" onclick="eliminar(this)" id="'+id+'"></button><button type="button" class="btn icon btn-success btnadd" onclick="agregar(this)" id="'+id+'"></button></td>';
	
	if (discount<1) {
		var tdprecio = '<td id="usd'+id+'"><div class="row"><div class="col-sm-12 dispreciop"><del>$'+preciousd+'USD</del></div><div class="col-sm-12 dispreciop"><del>$'+preciomxm+'MXM</del></div><div class="col-sm-12">$'+pdisusd.toFixed(2)+'USD</div><div class="col-sm-12">$'+pdismxn.toFixed(2)+'MXM</div></div></td>';
	}else if (discount == 1){
		var tdprecio = '<td id="usd'+id+'"><div class="row"><div class="col-sm-12">$'+(pdisusd*cantidad).toFixed(2)+'USD</div><div class="col-sm-12">$'+(pdismxn*cantidad).toFixed(2)+'MXM</div></div></td>';
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
				var resultmxn = state[1]*str[state[0]].preciomxm;
				if (discount<1) {
					tdprecio = '<td id="usd'+id+'"><div class="row"><div class="col-sm-12 dispreciop"><del>$'+(resultusd*((1-discount)*100)).toFixed(2)+'USD</del></div><div class="col-sm-12 dispreciop"><del>$'+(resultmxn*((1-discount)*100)).toFixed(2)+'MXM</del></div><div class="col-sm-12">$'+resultusd.toFixed(2)+'USD</div><div class="col-sm-12">$'+resultmxn.toFixed(2)+'MXM</div></div></td>';
				}else if (discount == 1){
					tdprecio = '<td id="usd'+id+'"><div class="row"><div class="col-sm-12">$'+resultusd.toFixed(2)+'USD</div><div class="col-sm-12">$'+resultmxn.toFixed(2)+'MXM</div></div></td>';
				}
				document.getElementById("can"+id).innerHTML = state[1];
				document.getElementById("usd"+id).innerHTML = tdprecio;
				document.getElementById("stk"+id).innerHTML = state[2];
			}
		}
  }else{
  	nuevaData = str.push({"gafete":gafete, "id":id,"nombres":nombre,"preciousd":pdisusd,"preciomxm":pdismxn,"cantidad":cantidad,"stock":stock, "vendedor":vendedor});
 		
 		document.getElementById("tablaproductos").getElementsByTagName('tbody')[0].insertRow(-1).innerHTML = tdid+tdnombre+tdcantidad+tdprecio+tdstock+tdaction;
  }

 	caltotal(str);
	TituloArt.innerHTML = "Gafete "+gafete;
	MostrarMxm.innerHTML = "$"+pagototal[0]+" MXN";
	MostrarUds.innerHTML = "$"+pagototal[1]+" USD";
	Mcantcarr.innerHTML = str.length;
}

function caltotal(canasta){
	pagototal = [];
	var sumamxm = 0;
	var sumausd = 0;
	for (var numero in canasta) {
   sumamxm += parseFloat(canasta[numero].preciomxm*canasta[numero].cantidad);
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



function Limpiartabla (nomtrab) {
	var fa=document.getElementById(nomtrab);
  var son=fa.getElementsByTagName("tbody")[0];
	var new_tbody = document.createElement('tbody');
	son.parentNode.replaceChild(new_tbody, son)
}

function bankcodebar(codigobarras){
	bank = [];
	var codebar = codigobarras;
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Caja/getBankcode';
	var formData = new FormData();
	formData.append("codebar", codebar);
	request.open("POST",ajaxUrl,true);
	request.send(formData);

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
			if (objData.status) {
				bank.push(objData.msg[0]);
				mostarfactura(bank);
				Namebank.innerHTML = bank[0].nom_bank;
				Typemoneda.innerHTML = bank[0].mxn_usd;
				objData = [];
			}
		}
	}
}

function mostarfactura(banko){
	var productos = [];
	productos = str;

	let date = new Date().toDateString();

	document.querySelector('#fngft').innerHTML = productos[0].gafete;
	document.querySelector('#ffech').innerHTML =date;
	document.querySelector('#nufa').innerHTML =banko[0].nfactura;

	Limpiartabla ("tablafactura");
	if (banko[0].mxn_usd == "USD") {
		document.querySelector('#totfact').innerHTML ="$"+pagototal[1]+" USD";
		document.querySelector('#fban').innerHTML =banko[0].nom_bank;
		document.querySelector('#fmon').innerHTML ="Moneda: "+banko[0].mxn_usd;
	 	for (var k in productos) {
			var tdcantidad = '<td id="can'+productos[k].codigobar+'">'+productos[k].cantidad+'</td>';
			var tdnombre = '<td>'+productos[k].nombres+'</td>';
			var tdprecio = '<td id="usd'+productos[k].codigobar+'"><div class="row"><div class="col-sm-12">$'+productos[k].preciousd+'USD</div></div></td>';
			var tdimporte = '<td id="imp'+productos[k].codigobar+'"><div class="row"><div class="col-sm-12">$'+(productos[k].preciousd*productos[k].cantidad)+' USD</div></div></td>';
		 	document.getElementById("tablafactura").getElementsByTagName('tbody')[0].insertRow(-1).innerHTML = tdcantidad+tdnombre+tdprecio+tdimporte;
	 	}
 	}else if(banko[0].mxn_usd == "MXN"){
 		document.querySelector('#totfact').innerHTML = "$"+pagototal[0]+" MXN"
 		document.querySelector('#fban').innerHTML =banko[0].nom_bank;
		document.querySelector('#fmon').innerHTML = "Moneda: "+banko[0].mxn_usd;
	 	for (var k in productos) {
			var tdcantidad = '<td id="can'+productos[k].codigobar+'">'+productos[k].cantidad+'</td>';
			var tdnombre = '<td>'+productos[k].nombres+'</td>';
			var tdprecio = '<td id="usd'+productos[k].codigobar+'"><div class="row"><div class="col-sm-12">$'+productos[k].preciomxm+' MXN</div></div></td>';
			var tdimporte = '<td id="imp'+productos[k].codigobar+'"><div class="row"><div class="col-sm-12">$'+(productos[k].preciomxm*productos[k].cantidad)+' MXN</div></div></td>';
		 	document.getElementById("tablafactura").getElementsByTagName('tbody')[0].insertRow(-1).innerHTML = tdcantidad+tdnombre+tdprecio+tdimporte;
	 	}	
 	}
}

function modalventa(){ 
	resetstep();
	myModal = new bootstrap.Modal(document.getElementById('modalSentventa'), {keyboard: false});	
	document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
	document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-info");
	document.querySelector('#btnText').innerHTML = "Guardar";
	document.querySelector('#titleModal').innerHTML = "Completar datos";
	document.querySelector('#formSentventa').reset();
	document.querySelector('#intNumero').value = str[0].gafete.substr(0,3);
	document.querySelector('#txtColores').value = str[0].gafete.substr(4,8).toString();
	document.querySelector('#txtVendedor').value = str[0].vendedor;
	myModal.show();

	//$('.spincarga').css("display", "block");

}

function updateText(e){
  let parrafo = document.querySelector("#fntran");
  parrafo.innerHTML ="Transaccion: "+e;
}

formSentventa.onsubmit = function(e){
	e.preventDefault();
	var strNumero = document.querySelector('#intNumero').value;
	var strColor = document.querySelector('#txtColores').value;
	var strVendedor = document.querySelector('#txtVendedor').value;
	var strCajero = document.querySelector('#txtCajero').value;
	if (bank.length == 0 ){
		swal("Atencion", "Favor De Agregar Un Banco", "error");
		return false;
	}
	console.log(str);
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Caja/setVenta/'+JSON.stringify(str)+'/'+JSON.stringify(bank)+'/'+JSON.stringify(pagototal);
	var formData =  new FormData(formSentventa);
	request.open("POST",ajaxUrl,true);
	request.send(formData);
	SppiCarga.className = 'spincarga';
	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
			if (objData.status) {
 				fntUpdateGft((strNumero+" "+strColor));
				limpventa();
				SppiCarga.className = 'menu_bar';
				myModal.hide();
				swal("¡Correcto!", objData.msg ,"success");
			}else{
				swal("Error", objData.msg, "error");
			}
		}
	}
}

function fntUpdateGft(gfete){
			var request =(window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			var ajaxUrl = base_url()+'/Caja/getUpdateGft/'+JSON.stringify(str);
			request.open("GET",ajaxUrl,true);
			request.send();

			request.onreadystatechange = function(){
				if (request.readyState == 4 && request.status == 200) {
					var objData = JSON.parse(request.responseText); 
					if (objData.status) {
						fntDropGft(gfete);
					}else{
						swal("Error", objData.msg, "error");
					}
				}
			}
}

function fntDropGft(gfete){
			var request =(window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			var ajaxUrl = base_url()+'/Caja/getDropGft/'+gfete;
			request.open("GET",ajaxUrl,true);
			request.send();

			request.onreadystatechange = function(){
				if (request.readyState == 4 && request.status == 200) {
					var objData = JSON.parse(request.responseText); 
					if (objData.status) {
						inicial();
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
	document.getElementById("btngfts").innerHTML="";
	Namebank.innerHTML = "";
	Typemoneda.innerHTML = "";
	Mcantcarr.innerHTML = "0";
	MostrarMxm.innerHTML = "$0.00 MXN";
	MostrarUds.innerHTML = "$0.00 USD";
	TituloArt.innerHTML = "Articulos"
	var table = document.getElementById('tablaproductos');
	var tableHeaderRowCount = 1;
	var rowCount = table.rows.length;
	for (var i = tableHeaderRowCount; i < rowCount; i++) {
	    table.deleteRow(tableHeaderRowCount);
	}
}







/*******************avanzar modal*********************/
	function prev(id){
	    if (numstep <= 3) {
	        document.getElementById(id+numstep).style.display = 'none'; 
	        numstep--;
	        document.getElementById(id+numstep).style.display = 'block';    
	    }else{
	        console.log("error");
	    }
	}

	function next(id){
	    console.log(id+numstep);
	    if (numstep <= 3) {
	        if (numstep == 3) {
	            document.getElementById(id+numstep).style.display = 'block';
	        }else{
	            document.getElementById(id+numstep).style.display = 'none'; 
	            numstep++;
	            document.getElementById(id+numstep).style.display = 'block';
	        }
	    }else{
	        console.log("error");
	    }
	}

	function resetstep(){
		numstep = 1;
	  document.getElementById("fiel"+numstep).style.display = 'block';
		for (var i = 2; i <= 3; i++) {
		document.getElementById("fiel"+i).style.display = 'none'; 

		}
	}

/*****************************************************/