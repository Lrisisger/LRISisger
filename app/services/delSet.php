<<?php
//  FUNÇAO DE DELETR SETOR
require '../dao/tarefasDao.php'; 
require '../models/setores.php';
require '../dao/setoresDao.php'; 
require '../models/Auth.php';


$auth = new Auth();
$userInfo = $auth->checkToken();
// AUTENTICAÇÃO DE TOKEN DO USUARIO PARA CONFIRMAR O LOGIN

if ( $userInfo == false ) {
    header( 'Location: logOutAction.php' );
    exit;
}

$sDao = new SetoresDaoXml();
$tDao = new TarefasDaoXml();

$token = filter_input(INPUT_GET, 'token');

$setor = $sDao->findByToken($token);
$tarefasSet = $tDao->findBySetor($token);


if($tarefasSet){
    foreach($tarefasSet as $tarefa){
        $tDao->delete($tarefa->getId());
    }
}
$sDao->delete($setor->getId());

header( 'Location: ../views/adm/setor.php' );
exit;