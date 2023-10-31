<?php

require '../dao/usuarioDao.php'; 
require '../models/setores.php';
require '../dao/setoresDao.php'; 

$uDao = new UsuarioDaoXml();
$sDao = new SetoresDaoXml();



$setorNome = ucwords( strtolower( filter_input( INPUT_POST, 'setor' ) ) );
$senha = filter_input(INPUT_POST, 'senha');
$usuario = $uDao->findByToken($_SESSION['token']);

//FUNÇÃO QUE CRIA UM TOKEN ALEATÓRIO DE 50 CARACTERES
function token( $tamanho = 50 ) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charactersLength = strlen( $characters );
    $randomString = '';
    for ( $i = 0; $i < $tamanho; $i++ ) {
        $randomString .= $characters[ rand( 0, $charactersLength - 1 ) ];
    }
    return $randomString;
}

if($setorNome && $senha){
    if(password_verify($senha, $usuario->getPass())){
        $token = '';
        
        //LOOPING QUE IMPOSSIBILITA A CRIAÇÃO DE SETORES COM TOKEN IGUAL       
        do {
            $token = token(); //CRIANDO TOKEN PARA O SETOR
            $verify = $sDao->findByToken( $token ); //VERIFICAÇÃO DE TOKENS 

        }while( $verify );

        $s = new Setores();
        $s->setName($setorNome);
        $s->setTokenSetor($token);
        $s->setTokenEmpresa($usuario->getTokenEmpresa());

        $sDao->add($s);
    }else{
        $_SESSION['avisoAdd'] = 'Senha incorreta';
    }
}else{
    $_SESSION['avisoAdd'] = 'Preencha todos os campos';
}

header( 'Location: ../views/adm/setor.php' );
exit;