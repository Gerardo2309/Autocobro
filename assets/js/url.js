function base_url() {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin+'/'+pathparts[1].trim('/'); // http://localhost/myproject/
    }else{
        var url = location.origin+'/'+pathparts[1].trim('/'); // http://stackoverflow.com
    }
    return url;
}

function Cerrarsesion(comp){
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url()+'/home/Cerrarsesion/'+comp.id;
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                window.location.replace(objData.msg);
                
            }
        }
    }
}
