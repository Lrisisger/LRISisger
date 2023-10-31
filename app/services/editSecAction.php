<?php

require '../dao/usuarioDao.php'; 
require '../models/setores.php';
require '../dao/setoresDao.php';
require_once '../../config/config.php'; 
require '../models/Auth.php';

$uDao = new UsuarioDaoXml();
$sDao = new SetoresDaoXml();

$auth = new Auth();
$userInfo = $auth->checkToken();
// AUTENTICAÇÃO DE TOKEN DO USUARIO PARA CONFIRMAR O LOGIN

if ( $userInfo == false ) {
    header( 'Location: logOutAction.php' );
    exit;
}

$setorNome = ucwords( strtolower( filter_input( INPUT_POST, 'setor' ) ) );
$tokenSetor = filter_input( INPUT_POST, 'tokenSetor' );
$senha = filter_input(INPUT_POST, 'senha');
$usuario = $uDao->findByToken($_SESSION['token']);



if($setorNome && $senha){
    if(password_verify($senha, $usuario->getPass())){
       
        $setor = $sDao->findByToken($tokenSetor);

        $s = new Setores();
        $s->setId($setor->getId());
        $s->setName($setorNome);
        $s->setTokenSetor($tokenSetor);
        $s->setTokenEmpresa($setor->getTokenEmpresa());

        $sDao->update($s);
    }else{
        $_SESSION['avisoEdit'] = 'Senha incorreta';
    }
}else{
    $_SESSION['avisoEdit'] = 'Preencha todos os campos';
}

header( 'Location: ../views/adm/setor.php' );
exit;