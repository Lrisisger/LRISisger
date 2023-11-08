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

$sDao = new SetoresDaoXml();
$tDao = new TarefasDaoXml();

$token = filter_input(INPUT_POST, 'tokenSet');
$senha = filter_input(INPUT_POST, 'senha');


$setor = $sDao->findByToken($token);
$tarefasSet = $tDao->findBySetor($token);

if($senha && $token){
    if ($userInfo->getIsAdm()==1 && $userInfo->getTokenEmpresa()==$setor->getTokenEmpresa() && password_verify($senha, $userInfo->getPass())){
        if($tarefasSet){
            foreach($tarefasSet as $tarefa){
                $tDao->delete($tarefa->getId());
            }
        }
        $sDao->delete($setor->getId());
    }else{
        $_SESSION['aviso'] = 'senha incorreta';
    }
}else{
    $_SESSION['aviso'] = 'Campos incompletos';
}



header( 'Location: ../views/adm/setor.php' );
exit;