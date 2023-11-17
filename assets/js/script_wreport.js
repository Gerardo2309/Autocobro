/*document.addEventListener('DOMContentLoaded', function(){
	tableEmployees = $('#tableWreport').DataTable({
		"aProcessing":true,
		"aServerSide":true,
		"language": {
			"url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/English.json"
		},
		"ajax":{
			"url":base_url()+"/Wreport/getWreports",
			"dataSrc":""
		},
		"columns":[
			{"data":"idventa"},
			{"data":"gafete"},
			{"data":"cajero"},
			{"data":"total" },
			{"data":"options"},
		],
		"responsive":true,
		"bDestroy":true,
		"iDisplayLength":10,
		"order":[[0,"desc"]]
	});
});*/

/* Formatting function for row details - modify as you need */
function format(d) {
    // `d` is the original data object for the row
    return (
        '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
		'<thead><tr><th><h6>ID</h6></th><th><h6>GAFETE</h6></th><th><h6>SELLER</h6></th><th><h6>TOTAL</h6></th><th><h6>ACTION</h6></th></tr></thead>'+
		'<tbody>'+
        '<tr>' +
        '<td>' +
        d.idventa +
        '</td>' +
        '</tr>' +
		'</tbody>'+
        '</table>'
    );
}
 
document.addEventListener('DOMContentLoaded', function(){
    // Add event listener for opening and closing details
    $('#tableWreport').on('click', 'tbody td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
 
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
        } else {
            // Open this row
            row.child(format(row.data())).show();
        }
    });
 
    $('#tableWreport').on('requestChild.dt', function (e, row) {
        row.child(format(row.data())).show();
    });
 
    var table = $('#tableWreport').DataTable({
        ajax:{
			"url":base_url()+"/Wreport/getWreports",
			"dataSrc":""
		},
        rowId: 'id',
        stateSave: true,
        columns: [
            {
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: '',
            },
            { data: 'idventa' },
            { data: 'gafete' },
            { data: 'vendedor' },
            { data: 'total' },
        ],
        order: [[1, 'asc']],
    });
});