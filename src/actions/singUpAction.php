<?php
session_start();
require '../../private/class/usuarios.php';
require '../../private/dao/usuarioDao.php';
require '../../private/config.php';

$uDao = new UsuarioDaoMysql($pdo);

$name = ucwords(strtolower(filter_input(INPUT_POST, 'name')));
$email = strtolower(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
$cpf = ucwords(strtolower(filter_input(INPUT_POST, 'cpf')));
$pass = filter_input(INPUT_POST, 'pass');
$isAdm = filter_input(INPUT_POST, 'adm');


if($name && $email && $cpf && $pass && $isAdm){

    $u = new Usuarios();
    $u->setName($name);
    $u->setEmail(strtolower($email));
    $u->setCpf($cpf);
    $u->setPass($pass);
    $u->setIsAdm($isAdm);

    $uDao->add($u);

}else{
    header('Location: ../views/adm/pages/singUp.php');
    exit;
}

header('Location: ../views/adm/pages/login.php');
exit;