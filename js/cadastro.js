/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//"/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/"

function checkMail(mail){
    var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
    if(typeof(mail) == "string"){
        if(er.test(mail)){ 
            return true; 
        }else{
            return false;
        }
    }else if(typeof(mail) == "object"){
        if(er.test(mail.value)){ 
            return true; 
        }else{
            return false;
        }
    }else{
        return false;
    }
}


function validaCadastro(){
    var form = document.cadastro;
    var usuario = form.usuario.value;
    var senha = form.senha.value;
    var repitaSenha = form.repitasenha.value;
    var email = form.email.value;
    var validaEmail = checkMail(email);
    var empresa = form.empresa.value;
    if (usuario == '') {
        document.getElementById("msg").innerHTML = 'Preencha o usuário';
        return false;
    }else if (senha == ''){
        document.getElementById("msg").innerHTML = 'Preencha a senha';
        return false;
    }else if (senha != repitaSenha){
        document.getElementById("msg").innerHTML = 'Senhas não conferem';
        return false;
    }else if (email == ''){
        document.getElementById("msg").innerHTML = 'Preencha o e-mail';
        return false;
    }else if ( validaEmail == false ){
        document.getElementById("msg").innerHTML = 'Preencha um e-mail válido';
        return false;
    }else if (empresa == ''){
        document.getElementById("msg").innerHTML = 'Preencha a empresa';
        return false;
    }
    return true; //Caso não entre em nenhuma das condições
}

function somenteLetras(ei, fe) {
    var tecla;
    if (ei) {
        tecla = ei;
    }else {
        tecla = fe;
    }
    //Tecla 32 é o espaço. 8 é o backspace. 9 é o tab. 37 é o sta para esquerda. 39 é o seta para direita. 46 é o delete
	if ( (tecla >= 65 && tecla <= 90) || (tecla >= 97 && tecla <= 122) || (tecla == 8) || (tecla == 9) || (tecla==37) || (tecla==39) || (tecla==32) || (tecla==46) ){
		return true;
	}
	else{
		return false;
	}
}

function validaEdicao(){
    var form = document.editar;
    var usuario = form.usuario.value;
    var email = form.email.value;
    var validaEmail = checkMail(email);
    var empresa = form.empresa.value;
    
    if (usuario == '') {
        document.getElementById("msg").innerHTML = 'Preencha o usuário';
        return false;
    }else if (email == ''){
        document.getElementById("msg").innerHTML = 'Preencha o e-mail';
        return false;
    }else if ( validaEmail == false ){
        document.getElementById("msg").innerHTML = 'Preencha um e-mail válido';
        return false;
    }else if (empresa == ''){
        document.getElementById("msg").innerHTML = 'Preencha a empresa';
        return false;
    }
    return true; //Caso não entre em nehuma das condições
}
