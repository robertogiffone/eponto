function validaLogin(){
    var form = document.login;
    var usuario = form.usuario.value;
    var senha = form.senha.value;
   
    if (usuario == '') {
        document.getElementById("msg").innerHTML = 'Preencha o usuário';
        return false;
    }else if (senha == ''){
        document.getElementById("msg").innerHTML = 'Preencha a senha';
        return false;
    }
    return true;
}