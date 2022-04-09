var atual = document.getElementById("senhaAtual");
var senha = document.getElementById("senhaFuncionario");
var rep_senha = document.getElementById("rep_senha");
var senhaLogin = document.getElementById("senha");

function validarSenha(){
    if(senha.value != rep_senha.value){
        document.getElementById("impSenha").innerHTML = "Senhas não são Iguais ";
    }else {
        document.getElementById("impSenha").innerHTML = "";
    }
}
function exibirSenha(){
    if(senhaLogin.type == "password"){
        senhaLogin.type = "text";
    }else{
        senhaLogin.type = "password";
    }
}
function mostrarSenha(){
    if(senha.type == "password"){
        senha.type = "text";
    }else{
        senha.type =  "password";
    }
    if(rep_senha.type == "password"){
        rep_senha.type = "text";
    }else{
        rep_senha.type =  "password";
    }
    if(atual.type == "password"){
        atual.type = "text";
    }else{
        atual.type =  "password";
    }
}

