<?php
require '../../private/class/usuarios.php';
require '../../private/dao/usuarioDao.php';
require_once '../../private/config.php';

$uDao = new UsuarioDaoMysql($pdo);

$email =ucwords(strtolower(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)));
$pass = filter_input(INPUT_POST, 'senha');

if($email && $pass){

    $u = $uDao->findByEmail($email);
    
    if($u){
        $hash = $u->getPass();
        if(password_verify($pass, $hash)){
            $_SESSION['token'] = $u->getToken();
        }else{
            $_SESSION['aviso'] = 'Email e/ou senha incorretos';
            header('Location: ../views/adm/pages/login.php');
            exit;
        }

    }else{
        $_SESSION['aviso'] = 'Email não encontrado';
        header('Location: ../views/adm/pages/login.php');
        exit;
    }


}else{
    $_SESSION['aviso'] = 'Preencha todos os campos';
    header('Location: ../views/adm/pages/login.php');
    exit;
}

header('Location: ../views/adm/pages/control.php');
exit;

