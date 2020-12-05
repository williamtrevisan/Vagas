<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Cadastrar vaga');

use \App\Entity\Vaga;
$obVaga = new Vaga;

//VALIDAÇÃO DO POST
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){

    $obVaga->titulo    = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo     = $_POST['ativo'];

    $obVaga->cadastrar();

    header('location: index.php?status=success');
    exit;
}

include __DIR__.'/Includes/header.php';
include __DIR__.'/Includes/formulario.php';
include __DIR__.'/Includes/footer.php';