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

$token = filter_input( INPUT_POST, 'tokenUser' );
$senhaAtual = filter_input( INPUT_POST, 'senhaAtual' );
$novaSenha = filter_input(INPUT_POST, 'novaSenha');
$confirmNovaSenha = filter_input(INPUT_POST, 'ConfirNovaSenha');

if($token && $senhaAtual && $novaSenha){
   $usuario = $uDao->findByToken($token);

   if($novaSenha != $confirmNovaSenha){
        $_SESSION['aviso'] = 'Senhas diferentes!';
        header( 'Location: ../views/geral/conta.php' );
        exit;
   }

   if(strlen($novaSenha) < 8){
     $_SESSION['aviso'] = 'Senha deve ter minimo 8 caracteres!';
     header( 'Location: ../views/geral/conta.php' );
     exit;
     }
   
   if(password_verify($senhaAtual, $usuario->getPass()) ){

        $newHash = password_hash( $novaSenha, PASSWORD_DEFAULT ); // CRIPTOGRAFANDO SENHA RECEBIDA

        $u = new Usuarios();
        $u->setId($usuario->getId());
        $u->setName($usuario->getName());
        $u->setEmail($usuario->getEmail());
        $u->setCpf($usuario->getCpf());
        $u->setPass($newHash);
        $u->setIsAdm($usuario->getIsAdm());
        $u->setToken($usuario->getToken());
        $u->setTokenEmpresa($usuario->getTokenEmpresa());
        $u->setMainAcc($usuario->getMainAcc());

        $uDao->update($u);
        $_SESSION['sucesso'] = 'Senha alterada com sucesso!';
   }else{
        $_SESSION['aviso'] = 'Senha incorreta!';
   }

    
}else{
    $_SESSION['aviso'] = 'Preencha todos os campos';
}

header( 'Location: ../views/geral/conta.php' );
exit;