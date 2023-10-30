<?php
require '../models/Usuarios.php';
require '../dao/usuarioDao.php';
require_once '../../config/config.php';
//INCIANDO O DAO DE USUARIO
$uDao = new UsuarioDaoXml();

$email =ucwords(strtolower(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))); //RECEBENDO DADOS DE EMAIL DO LOGIN
$pass = filter_input(INPUT_POST, 'senha'); //RECEBENDO DADOS DA SENHA DO LOGIN

//VERIFICANDO SE AS SENHA E O EMAIL FORAM ENVIADOS 
if($email && $pass){
    
    //VERIFICANDO SE EMAIL EXISTE E ADICONANDO O USUARIO NA VARIAVEL $U  
    $u = $uDao->findByEmail($email);
    
    //VERIFICANDO SE USUARIO FOI RECEBIDO 
    if($u){
        $hash = $u->getPass(); //RECEBENDO SENHA CRIPTOGRAFADA
        
        //VERIFICANDO SE SENHA RECEBIDA É IGUAL A SENHA DIGITADA
        if(password_verify($pass, $hash)){
            $_SESSION['token'] = $u->getToken(); //SE LOGIN APROVADO CRIAR SESSAO COM TOKEN DO USUARIO  

            if($u->getIsAdm() == 1){
                header('Location: ../views/adm/control.php');//CASO LOGIN APROVADO REDIRECIONAR PARA TELA DE CONTROLE
                exit;
            }else{
                header('Location: ../views/worker/control_colabora.php');//CASO LOGIN APROVADO REDIRECIONAR PARA TELA DE CONTROLE
                exit; 
            }

        }else{
            $_SESSION['aviso'] = 'Email e/ou senha incorretos'; //SE LOGIN NÃO APROVADO CRIAR SESSAO COM AVISO 
            header('Location: ../views/geral/login.php'); //REDIRECIONAR PARA TELA DE LOGIN 
            exit;
        }

    }else{
        $_SESSION['aviso'] = 'Email e/ou senha incorretos'; //SE EMAIL NÃO EXISTE NO XML CRIAR SESSAO COM AVISO
        header('Location: ../views/geral/login.php'); //REDIRECIONAR PARA TELA DE LOGIN
        exit;
    }


}else{
    $_SESSION['aviso'] = 'Preencha todos os campos'; //SE EMAIL OU SENHA NÃO FOREM PREENCHIDOS CRIAR SESSAO COM AVISO 
    header('Location: ../views/geral/login.php'); //REDIRECIONAR PARA TELA DE LOGIN
    exit;
}


