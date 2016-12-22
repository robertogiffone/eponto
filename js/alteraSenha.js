function validaAlteraSenha(){
    var form = document.alteraSenha;
    var senhaAtual = form.senhaatual.value;
    var novaSenha = form.novasenha.value;
    var repitaNovaSenha = form.repitanovasenha.value;
    
    if (senhaAtual == '') {
        document.getElementById("msg").innerHTML = 'Preencha a senha atual';
        return false;
    }else if (novaSenha == '') {
        document.getElementById("msg").innerHTML = 'Preencha a nova senha';
        return false;
    }else if (repitaNovaSenha == '') {
        document.getElementById("msg").innerHTML = 'Preencha o repita nova senha';
        return false;
    }else if (novaSenha != repitaNovaSenha) {
        document.getElementById("msg").innerHTML = 'Nova senha não conferem';
        return false;
    }
   return true;
}


