<?php

require '../dao/usuarioDao.php'; 
require '../models/setores.php';
require '../dao/setoresDao.php'; 

$uDao = new UsuarioDaoXml();
$sDao = new SetoresDaoXml();



$name = ucwords( strtolower( filter_input( INPUT_POST, 'nome' ) ) );
$email = filter_input( INPUT_POST, 'email' );
$cpfCnpj = filter_input(INPUT_POST, 'cpfCnpj');
$isAdm = filter_input(INPUT_POST, 'isAdm');
$token = filter_input(INPUT_POST, 'token');

$usuario = $uDao->findByToken($_SESSION['token']);



if($name && $email && $cpfCnpj && ($isAdm == 0 || $isAdm == 1) && $token){
       //CONTINUAR DAQUI
        $setor = $sDao->findByToken($tokenSetor);

        $s = new Setores();
        $s->setId($setor->getId());
        $s->setName($setorNome);
        $s->setTokenSetor($tokenSetor);
        $s->setTokenEmpresa($setor->getTokenEmpresa());

        $sDao->update($s);
    
}else{
    $_SESSION['avisoAdd'] = 'Preencha todos os campos';
}

header( 'Location: ../views/adm/setor.php' );
exit;