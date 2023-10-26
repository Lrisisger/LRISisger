<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISGER</title>
</head>
<body>
<?php
        require realpath( dirname( __FILE__ ) . '/../../../config/config.php' );
        require realpath( dirname( __FILE__ ) . '/../../models/Auth.php');
        require realpath( dirname( __FILE__ ) . '/../../dao/usuarioDao.php');
        require realpath( dirname( __FILE__ ) . '/../../scripts-php/adm/control.php');
        require realpath( dirname( __FILE__ ) . '/../../dao/tarefasDao.php');
        require realpath( dirname( __FILE__ ) . '/../../dao/setoresDao.php');

        $auth = new Auth();
        $userInfo = $auth->checkToken(); // AUTENTICAÇÃO DE TOKEN DO USUARIO PARA CONFIRMAR O LOGIN

        if($userInfo == false){
            header("Location: ../../services/logOutAction.php");
            exit;
        }
    ?>
</body>
</html>