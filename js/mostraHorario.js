function carregaHorario(){
	var xmlhttp;
	if ( window.XMLHttpRequest ){
		xmlhttp = new XMLHttpRequest();
	}else{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("horario").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open('GET','mostraHorario.php',true);
	xmlhttp.send();
}

carregaHorario(); //Carrega somente a hora que o usuário fez login

//setInterval(function() { carregaHorario(); }, 1000); //Chama a função especificada a cada 1 segundo
