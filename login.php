<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Usuario;
use \App\Session\Login;

//OBRIGA O USUÁRIO A ESTAR LOGADO;
Login::requireLogout();

//MENSAGENS DE ALERTA DOS FORMULÁRIOS
$alertaLogin    = '';
$alertaCadastro = '';

//VALIDACAO DO POST
if(isset($_POST['acao'])){
    switch ($_POST['acao']){
        case 'logar':
            //BUSCA USUÁRIO POR E-MAIL
            $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);

            //VALIDA A INSTÂNCIA E A SENHA
            $UsuarioDontExists = !$obUsuario instanceof Usuario;
            $IncorrectPassword = !password_verify($_POST['senha'], $obUsuario->senha);
            if($UsuarioDontExists || $IncorrectPassword){
                $alertaLogin = 'E-mail ou senha inválidos';
                break;
            }

            //LOGA O USUÁRIO
            Login::login($obUsuario);

            break;

        case 'cadastrar':
            if(isset($_POST['nome'], $_POST['email'], $_POST['senha'])){
                //BUSCA USUÁRIO POR E-MAIL
                $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
                $UsuarioExists = $obUsuario instanceof Usuario;
                if($UsuarioExists){
                    $alertaCadastro = 'O e-mail digitado já está em uso.';
                    break;
                }

                //NOVO USUÁRIO
                $obUsuario = new Usuario;
                $obUsuario->nome  = $_POST['nome'];
                $obUsuario->email = $_POST['email'];
                $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

                $obUsuario->cadastrar();

                //LOGA O USUÁRIO
                Login::login($obUsuario);
            }
            break;
    }
}

include __DIR__.'/Includes/header.php';
include __DIR__.'/Includes/formulario-login.php';
include __DIR__.'/Includes/footer.php';