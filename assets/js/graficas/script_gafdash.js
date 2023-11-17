window.onload=function() {
    grafdatos();
}
function grafdatos(){
    var datos = [];
    var totalxmes = [];
    var label = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url()+'/Dashboard/getVentas';
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                for (var i = 1; i <= label.length; i++) {
                    for (var k in objData.msg) {
                        if(objData.msg[k].fecha.substr(5,2) == i){
                            datos.push(objData.msg[k]);
                        }
                    }
                    totalxmes[i-1] = caltotal(datos);
                    datos = [];

                }
                creargraf(label, totalxmes);
                objData = [];
            }
        }
    }
}

function caltotal(canasta){
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

function creargraf( labels, data){
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Sales',
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

}





