<?php

require '../models/usuarios.php';
require '../dao/usuarioDao.php';
require '../../config/config.php';

$uDao = new UsuarioDaoMysql( $pdo );

$name = ucwords( strtolower( filter_input( INPUT_POST, 'name' ) ) );
$email = strtolower( filter_input( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL ) );
$cpf = ucwords( strtolower( filter_input( INPUT_POST, 'cpf' ) ) );
$pass = filter_input( INPUT_POST, 'pass' );
$isAdm = filter_input( INPUT_POST, 'adm' );

function token( $tamanho = 50 ) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$';
    $charactersLength = strlen( $characters );
    $randomString = '';
    for ( $i = 0; $i < $tamanho; $i++ ) {
        $randomString .= $characters[ rand( 0, $charactersLength - 1 ) ];
    }
    return $randomString;
}

if ( $name && $email && $cpf && $pass && $isAdm ) {
    $token = '';

    do {
        $token = token();

        $verify = $uDao->findByToken( $token );

    }
    while( $verify != False );

    $hash = password_hash( $pass, PASSWORD_DEFAULT );

    $u = new Usuarios();
    $u->setName( $name );
    $u->setEmail( strtolower( $email ) );
    $u->setCpf( $cpf );
    $u->setPass( $hash );
    $u->setIsAdm( $isAdm );
    $u->setToken( $token );

    $uDao->add( $u );

} else {
    header( 'Location: ../views/adm/singUp.php' );
    exit;
}

header( 'Location: ../views/adm/login.php' );
exit;