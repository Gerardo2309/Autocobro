window.onload=function() {
    inicial();
}

//-------------variables globales-----------------//
/*const $productosc = document.querySelector("#rproducto");*/

const Totalsales = document.querySelector("#totsales");
const Salesmxn = document.querySelector("#salesmxn");
const SalesUsd = document.querySelector("#salesusd");
const Employees = document.querySelector("#employee");
var pagototal = [];
var objData = [];
let myChart;
let myChartBBSC;

//-----------------------------------------------//

function inicial(){
	const employee = new Employee();
	const articulos = new Articulos();
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url()+'/Dashboard/getVentas';
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			objData = JSON.parse(request.responseText);
			if (objData.status) {
				employee.getemployee();
				employee.topsaller(objData.msg);
				articulos.getarticulo();
				datosgraf(objData.msg,2);
				viewdash(objData.msg);
				viewsbc(objData.msg);

			}
		}
	}
}



function viewdash(arrdatos){
	caltotal(arrdatos);
	Salesmxn .innerHTML='$'+pagototal[0];
	SalesUsd.innerHTML='$'+pagototal[1];
	Totalsales.innerHTML='$'+pagototal[2];
}

function caltotal(canasta){
	pagototal = [];
	var sumamxm = 0;
	var sumausd = 0;
	for (var numero in canasta) {
		switch (canasta[numero].mxn_usd) {
  		case 'MXN':
    		sumamxm += parseFloat(canasta[numero].total);
    	break;
  		case 'USD':
    		sumausd += parseFloat(canasta[numero].total);
    	break;
		}
	}
	result = (sumamxm/25)+sumausd;


	pagototal.push(sumamxm.toFixed(2),sumausd.toFixed(2),result.toFixed(2));
}

function seletopt(){
	const tipograf = document.querySelector("#tipograf").value;
	datosgraf(objData.msg,tipograf);
}

function datosgraf(ventas, opcgraf){
	var datos = [];
    var totalxmes = [];
    var label = [];

    switch(parseInt(opcgraf)){
    	case 1:
    		label = ['2019', '2020', '2021', '2022'];
 		    for (var i = 1; i <= label.length; i++) {
		        for (var k in ventas) {
		            if(ventas[k].fecha.substr(0,4) == label[i-1]){
		                datos.push(ventas[k]);
		            }
		        }
		        totalxmes[i-1] = totalgraf(datos);
		        datos = [];

		    }

            var chartdata = {
                labels:label ,
                datasets: [{
                    label: "Yearly Sales",
                    data: totalxmes,
				    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
				    borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
				    borderWidth: 1,
                }]
            };
		    creargraf(chartdata,'myChart');
		    document.getElementById("tipograf").value = opcgraf ;
    	break;
    	case 2:
    		label = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
		    for (var i = 1; i <= label.length; i++) {
		        for (var k in ventas) {
		            if(ventas[k].fecha.substr(5,2) == i){
		                datos.push(ventas[k]);
		            }
		        }
		        totalxmes[i-1] = totalgraf(datos);
		        datos = [];

		    }
            var chartdata = {
                labels:label ,
                datasets: [{
                    label: "Monthly Sales",
                    data: totalxmes,
				    backgroundColor: 'rgba(255, 159, 64, 0.2)',// Color de fondo
				    borderColor: 'rgba(255, 159, 64, 1)',// Color del borde
				    borderWidth: 1,
                }]
            };
		    creargraf(chartdata,'myChart');
		    document.getElementById("tipograf").value = opcgraf ;
    	break;
    	case 3:
    		label = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
    		var ventas1 = [];
		    var ventas2 = [];
		    var ventas3 = [];
		    for (var k in ventas) {
		    	const nsemana = numeroDeSemana(new Date(ventas[k].fecha));
		    	const nsemAct = numeroDeSemana(new Date());

		    	switch(nsemana){
		           	case (nsemAct):
		           		ventas1.push(ventas[k]);
					
					break;
		           	
		           	case (nsemAct-1):
		           		ventas2.push(ventas[k]);



					break;
	           		case (nsemAct-2):
		           		ventas3.push(ventas[k]);


					break;
	           	}

    		}
    		var graf1 = calsem(ventas1,"Current Week",'rgba(255, 159, 64, 1)','rgba(255, 159, 64, 0.2)');
    		var graf2 = calsem(ventas2,"One Week Before",'rgba(54, 162, 235, 1)','rgba(54, 162, 235, 0.2)');
    		var graf3 = calsem(ventas3,"Two week before",'rgba(211,93,110, 1)','rgba(211,93,110, 0.2)');

            var chartdata = {
                labels:label ,
                datasets: [
                	graf1,
                	graf2,
                	graf3,
                ]
            };
		    creargraf(chartdata,'myChart');
		    document.getElementById("tipograf").value = opcgraf ;
    	break;
    }
}

function totalgraf(canasta){
    var pagototal = [];
    var sumamxm = 0;
    var sumausd = 0;
   for (var numero in canasta) {
        switch(canasta[numero].mxn_usd){
            case "MXN":
            sumamxm += parseFloat(canasta[numero].total);
            break;
            case "USD":
            sumausd += parseFloat(canasta[numero].total);
            break;
        }
    }
    pagototal = (sumamxm/25)+sumausd;
    return pagototal.toFixed(2);
}

function creargraf(chartdata,nombre){
    const ctx = document.getElementById(nombre).getContext('2d');
    if (myChart) {
    	myChart.destroy();
    }
    myChart = new Chart(ctx, {
        type: 'line',
		data: chartdata,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function calsem(venta,frase, borde, fondo){
	var datos = [];
    var totalxmes = [];
    for (var i=0; i < 7; i++) {
		for(var k in venta){
			const numeroDia = new Date(venta[k].fecha).getDay();

			if(numeroDia == i){
				datos.push(venta[k]);
			}
		}
		totalxmes[i] = totalgraf(datos);
		datos = [];
	}
	const graf = {
	    label: frase,
	    data: totalxmes, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
	    backgroundColor: fondo,// Color de fondo
	    borderColor: borde,// Color del borde
	    borderWidth: 1,// Ancho del borde
	};
	return graf;
}

function viewsbc(ventas){
	var colors = [0,0,0,0];
	for (k in ventas) {
		switch(ventas[k].gafete.substr(4,8)){
			case "Amarillo":
				colors[1] += 1;
			break;
			case "Rojo":
				colors[0] += 1;
			break;
			case "Verde":
				colors[2] += 1;
			break;
			case "Negro":
				colors[3] += 1;
			break;
		}
	}
	const data = {
	  labels: ['Red','Yellow','Green','Black'],
	  datasets: [{
	    data: colors,
	    backgroundColor: [
	      'rgb(255, 0, 0)',
	      'rgb(255, 255, 0)',
	      'rgb(0, 128, 0)',
	      'rgb(0, 0, 0)',
	    ],
	    hoverOffset: 4
	  }]
	};
	const ctx = document.getElementById('chart-SBBC').getContext('2d');
    if (myChartBBSC) {
    	myChartBBSC.destroy();
    }
    myChartBBSC = new Chart(ctx, {
	  type: 'doughnut',
	  data: data,
    });
}



const numeroDeSemana = fecha => {
    const DIA_EN_MILISEGUNDOS = 1000 * 60 * 60 * 24,
        DIAS_QUE_TIENE_UNA_SEMANA = 7,
        JUEVES = 4;
    fecha = new Date(Date.UTC(fecha.getFullYear(), fecha.getMonth(), fecha.getDate()));
    let diaDeLaSemana = fecha.getUTCDay(); // Domingo es 0, sábado es 6
    if (diaDeLaSemana === 0) {
        diaDeLaSemana = 7;
    }
    fecha.setUTCDate(fecha.getUTCDate() - diaDeLaSemana + JUEVES);
    const inicioDelAño = new Date(Date.UTC(fecha.getUTCFullYear(), 0, 1));
    const diferenciaDeFechasEnMilisegundos = fecha - inicioDelAño;
    return Math.ceil(((diferenciaDeFechasEnMilisegundos / DIA_EN_MILISEGUNDOS) + 1) / DIAS_QUE_TIENE_UNA_SEMANA);
};

class Employee{

	getemployee(){
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url()+'/Dashboard/getEmployee';
		request.open("GET",ajaxUrl,true);
		request.send();

		request.onreadystatechange = function(){
			if (request.readyState == 4 && request.status == 200) {
				 var objDataEmploy = JSON.parse(request.responseText);
				if (objDataEmploy.status) {
						Employees.innerHTML = objDataEmploy.msg.length;
						const employee = new Employee();
						employee.viewconnect(objDataEmploy.msg);
				}
			}
		}
	}

	viewconnect(empleados){
		const emploconn = new Employee();
		for(var k in empleados){
			if (empleados[k].status == 1) {
				emploconn.desingconn(empleados[k],'success');
			}else{
				emploconn.desingconn(empleados[k],'danger');
			}
		}
	}

	desingconn(user,status){
		var divParent = document.getElementById("conemploy");
		let col = document.createElement('div');
		var divbody = '';
		var divimg = '';
		var divtext = '';

		divimg ='<div class="avatar avatar-lg"><img src="assets/images/faces/4.jpg"><span class="avatar-status bg-'+status+'"></span></div>';

		divtext = '<div class="name ms-4"><h5 class="mb-1">'+user.nom_user+'</h5><h6 class="text-muted mb-0">@'+user.id_usuario+'</h6></div>';

		col.className = 'recent-message d-flex px-4 py-3';
		col.setAttribute("id", user.id_usuario);
		const card = divimg+divtext;
		col.innerHTML = card;
		divParent.appendChild(col);		
	}

	topsaller(venta){
		const employee = new Employee();

		var venarr = [];
		for (var k in venta) {
			venarr.push(venta[k].vendedor);
		}
		var repetidos = [];

		venarr.forEach(function(id){
		  repetidos[id] = (repetidos[id] || 0) + 1;
		});
		employee.viewtopsaller(repetidos);
	}

	viewtopsaller(arr){
		var label = [];
		var datnum = [];
		let myCharttps;
    	const ctx = document.getElementById('canvas-tps').getContext('2d');

		for (var key in arr) {
    		if (label.length<3&&datnum.length<3) {
				label.push(key);
				datnum.push(arr[key]);
			}
		}

		var chartdata = {
            labels:label ,
            datasets: [{
                label: "Top Saller",
                data: datnum,
			    backgroundColor: [
			      'rgba(75, 192, 192, 0.2)',
			      'rgba(54, 162, 235, 0.2)',
			      'rgba(255, 205, 86, 0.2)',
			    ],
			    borderColor: [
			      'rgb(75, 192, 192)',
			      'rgb(54, 162, 235)',
			      'rgb(255, 205, 86)',
			    ],
				borderWidth: 1,
            }]
        };

	    if (myCharttps) {
	    	myCharttps.destroy();
	    }
	    myCharttps = new Chart(ctx, {
		  type: 'bar',
		  data: chartdata,
		  options: {
		    scales: {
		      y: {
		        beginAtZero: true
		      }
		    }
		  }
	    });
	}

}


class Articulos{
	getarticulo(){
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url()+'/Dashboard/getArticulos';
		request.open("GET",ajaxUrl,true);
		request.send();

		request.onreadystatechange = function(){
			if (request.readyState == 4 && request.status == 200) {
				 var objDataEmploy = JSON.parse(request.responseText);
				if (objDataEmploy.status) {
						const articulos = new Articulos();
						articulos.agregarFila(objDataEmploy.msg);
				}
			}
		}
	}


	agregarFila(productos){
	  for (var k in productos) {
	  		var tdcodebar = '<td class="col-2"><p class="font-bold mb-0">'+productos[k].cod_articulo+'</p></td>';
			var tdnombre = '<td class="col-auto"><p class="font-bold ms-3 mb-0">'+productos[k].nom_articulo+'</p></td>';
			var tdstock = '<td class="col-3"><p class="mb-0">'+productos[k].stock+'</p></td>';
		 	document.getElementById("tablasinstock").getElementsByTagName('tbody')[0].insertRow(-1).innerHTML = tdcodebar+tdnombre+tdstock;
	  }	
}


}



