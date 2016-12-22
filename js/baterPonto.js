function baterPonto(pagina){
	var xmlhttp;
	if ( window.XMLHttpRequest ){
		xmlhttp = new XMLHttpRequest();
	}else{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			location.reload();
			//document.getElementById("msg").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open('GET', pagina, true);
	xmlhttp.send();
}