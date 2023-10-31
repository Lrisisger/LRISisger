<?php

require '../dao/usuarioDao.php'; 
require '../models/setores.php';
require '../dao/setoresDao.php'; 
require '../models/Auth.php';

$uDao = new UsuarioDaoXml();
$auth = new Auth();

$userInfo = $auth->checkToken();
// AUTENTICAÇÃO DE TOKEN DO USUARIO PARA CONFIRMAR O LOGIN

if ( $userInfo == false ) {
    header( 'Location: logOutAction.php' );
    exit;
}

$name = ucwords( strtolower( filter_input( INPUT_POST, 'nome' ) ) );
$email = filter_input( INPUT_POST, 'email' );
$cpfCnpj = filter_input(INPUT_POST, 'cpfCnpj');
$isAdm = filter_input(INPUT_POST, 'isAdm');
$token = filter_input(INPUT_POST, 'token');

if($name && $email && $cpfCnpj && ($isAdm == 0 || $isAdm == 1) && $token){
      
       $usuario = $uDao->findByToken($token);
               
        $u = new Usuarios();
        $u->setId($usuario->getId());
        $u->setName($name);
        $u->setEmail($email);
        $u->setCpf($cpfCnpj);
        $u->setPass($usuario->getPass());
        $u->setIsAdm($isAdm);
        $u->setToken($token);
        $u->setTokenEmpresa($usuario->getTokenEmpresa());
        $u->setMainAcc($usuario->getMainAcc());

       $uDao->update($u);
    
}else{
    $_SESSION['avisoAdd'] = 'Preencha todos os campos';
}

header( 'Location: ../views/adm/participantes.php' );
exit;