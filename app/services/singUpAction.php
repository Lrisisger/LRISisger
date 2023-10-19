<?php
require '../models/usuarios.php';
require '../dao/usuarioDao.php';
require '../../config/config.php';

$uDao = new UsuarioDaoMysql();

$name = ucwords( strtolower( filter_input( INPUT_POST, 'nome' ) ) );
$email = strtolower( filter_input( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL ) );
$cpf = ucwords( strtolower( filter_input( INPUT_POST, 'cpfCnpj' ) ) );
$pass = filter_input( INPUT_POST, 'pass' );
$confirmPass = filter_input(INPUT_POST, 'confirmPass');
$isAdm = filter_input( INPUT_POST, 'isAdm' );

function token( $tamanho = 50 ) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$';
    $charactersLength = strlen( $characters );
    $randomString = '';
    for ( $i = 0; $i < $tamanho; $i++ ) {
        $randomString .= $characters[ rand( 0, $charactersLength - 1 ) ];
    }
    return $randomString;
}

if($pass != $confirmPass){
    if($isAdm == 1){
        $_SESSION['aviso'] = 'Senhas diferentes';
        header('Location: ../views/adm/singup.php');
        exit;
    }else{
        $_SESSION['aviso'] = 'Senhas diferentes';
        header('Location: ../views/adm/cadastroColabora.php');
        exit;
    }
}

if ( $name && $email && $cpf && $pass && $confirmPass && ($isAdm == 1 || $isAdm == 0) ) {
    $token = '';
    $tokenNovaEmpresa = '';
    do {
        $token = token();
        $tokenNovaEmpresa = token();
        $verify = $uDao->findByToken( $token ) && $uDao->findByToken( $tokenNovaEmpresa );

    }
    while( $verify );

    if($isAdm == 1){
        $tokenEmpresa = $tokenNovaEmpresa;  
    }else{        
        $tokenEmpresa = $uDao->findByToken($_SESSION['token'])->getTokenEmpresa();        
    }

    $hash = password_hash( $pass, PASSWORD_DEFAULT );

    $u = new Usuarios();
    $u->setName( $name );
    $u->setEmail( strtolower( $email ) );
    $u->setCpf( $cpf );
    $u->setPass( $hash );
    $u->setIsAdm( $isAdm );
    $u->setToken( $token );
    $u->setTokenEmpresa($tokenEmpresa);

    $uDao->add( $u );

} else {
  if($isAdm == 1){
    header( 'Location: ../views/adm/singup.php' );
    exit;
  }else{
    header( 'Location: ../views/adm/cadastroColabora.php' );
    exit;
  }
}

if($isAdm == 1){
    header( 'Location: ../views/adm/login.php' );
    exit;
}else{
    header( 'Location: ../views/adm/control.php' );
    exit;
}