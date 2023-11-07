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

$idTarefa = filter_input(INPUT_POST, 'idTask');
$senha = filter_input(INPUT_POST, 'senha');

$tarefa = $tDao->findById($idTarefa);

if(!$tarefa || !$senha){
    $_SESSION['aviso'] = 'Senha e/ou tarefa não invalida';
    header( 'Location: ../views/adm/control.php' );
    exit; 
}

if ($userInfo->getIsAdm()==1 && $userInfo->getTokenEmpresa() == $tarefa->getTokenEmpresa() && password_verify($senha, $userInfo->getPass())){
    $tDao->delete($tarefa->getId());
}else{
    $_SESSION['aviso'] = 'Senha incorreta';
}



header( 'Location: ../views/adm/control.php' );
exit;