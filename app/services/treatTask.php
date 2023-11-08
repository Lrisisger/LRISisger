<?php

require '../models/Usuarios.php';
require '../dao/usuarioDao.php';
require '../dao/tarefasDao.php';
require_once '../../config/config.php';
require '../models/Auth.php';

$uDao = new UsuarioDaoXml();
$tDao = new TarefasDaoXml();
$auth = new Auth();

$userInfo = $auth->checkToken();
// AUTENTICAÇÃO DE TOKEN DO USUARIO PARA CONFIRMAR O LOGIN

if ( $userInfo == false ) {
    header( 'Location: logOutAction.php' );
    exit;
}

$action = filter_input(INPUT_GET, 'action');
$id = filter_input(INPUT_GET, 'id');
$mensagem = filter_input(INPUT_GET, "mensagem");

if($action && $id){
    $tarefa = $tDao->findById($id);
    $tarefa->setStatus($action);

    if($mensagem){
        $tarefa->setMensagem($mensagem);
    }
    
    if($tarefa->getIdColabora() == $userInfo->getId()){
        $tDao->update($tarefa);
    }
}

header('Location: ../views/worker/control_colabora.php');
exit;