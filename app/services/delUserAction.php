<?php

require '../models/Usuarios.php';
require '../dao/usuarioDao.php';
require_once '../../config/config.php';
require '../models/Auth.php';


$uDao = new UsuarioDaoXml();
$auth = new Auth();

$userInfo = $auth->checkToken();
// AUTENTICAÇÃO DE TOKEN DO USUARIO PARA CONFIRMAR O LOGIN

if ( $userInfo == false ) {
    header( 'Location: logOutAction.php' );
    exit;
}

$id = filter_input( INPUT_GET, 'id' );

if ( $id ) {
    $uDao->delete( $id );
}

header( 'Location: ../views/adm/participantes.php' );
exit;