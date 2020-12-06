<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Editar vaga');

use \App\Entity\Vaga;
use \App\Session\Login;

//OBRIGA O USUÁRIO A ESTAR LOGADO;
Login::requireLogin();

//VALIDAÇÃO DO ID
$undefinedId = !isset($_GET['id']);
$Idnotnumeric = !is_numeric($_GET['id']);

if($undefinedId or $Idnotnumeric){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA A VAGA
$obVaga = Vaga::getVaga($_GET['id']);

//VALIDAÇÃO DA VAGA
$VagaDontExists = !$obVaga instanceof Vaga;

if($VagaDontExists){
    header('location: index.php?status=error');
    exit;
}

//VALIDAÇÃO DO POST
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){

    $obVaga->titulo    = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo     = $_POST['ativo'];

    $obVaga->atualizar();

    header('location: index.php?status=success');
    exit;
}

include __DIR__.'/Includes/header.php';
include __DIR__.'/Includes/formulario.php';
include __DIR__.'/Includes/footer.php';