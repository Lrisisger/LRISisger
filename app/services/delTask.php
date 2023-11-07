<<?php
//  FUNÇAO DE DELETR SETOR
require '../dao/tarefasDao.php'; 
require '../models/setores.php';
require '../dao/setoresDao.php'; 
require '../models/Auth.php';
require '../dao/usuarioDao.php';


$auth = new Auth();
$userInfo = $auth->checkToken();
// AUTENTICAÇÃO DE TOKEN DO USUARIO PARA CONFIRMAR O LOGIN

if ( $userInfo == false ) {
    header( 'Location: logOutAction.php' );
    exit;
}

$tDao = new TarefasDaoXml();

$idTarefa = filter_input(INPUT_GET, 'id');

$tarefa = $tDao->findById($idTarefa);

if(!$tarefa){
    header( 'Location: ../views/adm/control.php' );
    exit; 
}

if ($userInfo->getIsAdm()==1 && $userInfo->getTokenEmpresa() == $tarefa->getTokenEmpresa()){
    $tDao->delete($tarefa->getId());
}



header( 'Location: ../views/adm/control.php' );
exit;