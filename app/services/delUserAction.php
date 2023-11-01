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

$id = filter_input( INPUT_GET, 'id' );

if ( $id ) {


    $tarefasUser = $tDao->findByWorker($id);

    foreach($tarefasUser as $tarefa){
        $tDao->delete($tarefa->getId());
    }


    $uDao->delete( $id );
}

header( 'Location: ../views/adm/participantes.php' );
exit;