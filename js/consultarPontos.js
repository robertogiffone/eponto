$(function () {
	//Date range picker
	$('#periodo').daterangepicker({format: 'DD/MM/YYYY'});
	
	$('#pontos').dataTable({
		  "bPaginate": true,
		  "bLengthChange": false,
		  "bFilter": false,
		  "bSort": true,
		  "bInfo": true,
		  "bAutoWidth": false
	});
	
});

function validaConsultarPontos(){
	var periodo = $('#periodo').val();
	if( periodo == '' ){
		document.getElementById("msg").innerHTML = 'Favor preencha o período!';
        return false;
	}
	return true;
}



/*
function validaConsultarPontos(){
   var form = document.consultarPontos;
   var dataInicial = form.dataInicial.value;
   var dataFinal = form.dataFinal.value;
 
 
 
   if (dataInicial == ''){
        document.getElementById("msg").innerHTML = 'Preencha a data inicial';
        return false;
    }else if (dataFinal == ''){
        document.getElementById("msg").innerHTML = 'Preencha a data final';
        return false;
    }
    return true; //Caso não entre em nenhuma das condições
}
*/

