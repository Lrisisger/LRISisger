<<?php

require '../dao/tarefasDao.php'; 
require '../models/setores.php';
require '../dao/setoresDao.php'; 

$sDao = new SetoresDaoXml();
$tDao = new TarefasDaoXml();

$token = filter_input(INPUT_GET, 'token');

$setor = $sDao->findByToken($token);
$tarefasSet = $tDao->findBySetor($token);


if($tarefasSet){
    foreach($tarefasSet as $tarefa){
        $tDao->delete($tarefa->getId());
    }
}
$sDao->delete($setor->getId());

header( 'Location: ../views/adm/setor.php' );
exit;