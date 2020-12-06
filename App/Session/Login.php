<?php namespace App\Session;

use App\Entity\Usuario;

class Login {
    /**
     * Método responsável por iniciar a sessão
     */
    private static function init(){
        //VERIFICA O STATUS DA SESSÃO
        $sessionNotActive = (session_status() !== PHP_SESSION_ACTIVE);
        if($sessionNotActive){
            //INICIA A SESSÃO
            session_start();
        }
    }

    /**
     * Método responsável por retornar os dados do usuário logado
     * @return array
     */
    public static function getUsuarioLogado(){
        //INICIA A SESSÃO
        self::init();

        //RETORNA DADOS DO USUÁRIO
        return self::isLogged() ? $_SESSION['usuario'] : null;
    }

    /**
     * Método responsável por criar a sessão do usuário
     * @param Usuário $obUsuario
     */
    public static function login($obUsuario){
        //INICIA A SESSÃO
        self::init();

        $_SESSION['usuario'] = [
            'id'    => $obUsuario->id,
            'nome'  => $obUsuario->nome,
            'email' => $obUsuario->email,
        ];

        //REDIRECIONA USUÁRIO PARA INDEX
        header('location: index.php');
        exit;
    }

    /**
     * Método responsável por deslogar o usuário
     */
    public static function logout(){
        //INICIA A SESSÃO
        self::init();

        //REMOVE A SESSÃO DE USUÁRIO
        unset($_SESSION['usuario']);

        //REDIRECIONA USUÁRIO PARA INDEX
        header('location: login.php');
        exit;
    }

    /**
     * Método responsável por verificar se o usuário está logado
     * @return boolean
     */
    public static function isLogged(){
        //INICIA A SESSÃO
        self::init();

        //VALIDAÇÃO DA SESSÃO
        return isset($_SESSION['usuario']['id']);
    }

    /**
     * Método responsável por obrigar o usuário a estar logado para acessar
     */
    public static function requireLogin(){
        $IsNotLogged = !self::isLogged();

        if($IsNotLogged){
            header('location: login.php');
            exit;
        }
    }

    /**
     * Método responsável por obrigar o usuário a estar desconectado do sistema
     */
    public static function requireLogout(){
        $IsLogged = self::isLogged();

        if($IsLogged){
            header('location: index.php');
            exit;
        }
    }
}