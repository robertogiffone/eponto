//Reponsável por colocar calendário nos campos com a calasse data
$(document).ready(function(){
	if ( $('.data') ){
            $(".data").datepicker({
                    dateFormat: 'dd/mm/yy',
                    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
                    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
                    nextText: 'Próximo',
                    prevText: 'Anterior'
            });
        }
});

//Responsável por fazer paginação
$(document).ready(function() {
	if ( $('#idLista') ){
		oTable = $('#idLista').dataTable({
			"bPaginate": true, //Ativa a paginação
			"bJQueryUI": true, //Ativa utilizar o layout do arquivo css do jQueryUI
			"sPaginationType": "full_numbers", //Tem dois métodos two_button e full_numbers
			"aaSorting": [[ 0, "desc" ]], //Ordena a primeira coluna em ordem descendente
			"aoColumnDefs": [{ "bSortable": false, "aTargets": [ 0,1,2,3,4,5,6,7,8,9 ] }] //Desativa a ordenação quando clica na coluna
		});
	}
});

//Responsável por fazer paginação na página usuários, pois não tem até a coluna 8
$(document).ready(function() {
	if ( $('#usuariosLista') ){
		oTable = $('#usuariosLista').dataTable({
			"bPaginate": true, //Ativa a paginação
			"bJQueryUI": true, //Ativa utilizar o layout do arquivo css do jQueryUI
			"sPaginationType": "full_numbers", //Tem dois métodos two_button e full_numbers
			"aoColumnDefs": [{ "bSortable": false, "aTargets": [ 0,1,2,3,4,5,6,7,8 ] }] //Desativa a ordenação quando clica na coluna
		});
	}
});
