<?php
require '../models/Tarefas.php';
require_once '../dao/tarefasDao.php';

$tDao = new TarefasDaoXml();

$idAdm = filter_input(INPUT_POST, 'idAdm');
$idColabora = filter_input(INPUT_POST, 'name');
$tituloTarefa = ucwords( strtolower(filter_input(INPUT_POST, 'task_title')));
$dataInicial = filter_input(INPUT_POST, 'begin_date');
$dataLimite = filter_input(INPUT_POST, 'last_date');
$descricao = filter_input(INPUT_POST, 'task_description');
$tokenEmpresa = filter_input(INPUT_POST, 'tokenEmpresa');
$status = 2;



if($idAdm && $idColabora && $tituloTarefa && $dataInicial && $dataLimite && $descricao && $status && $tokenEmpresa){
    $t = new Tarefas();
    $t->setTituloTarefa($tituloTarefa);
    $t->setStatus($status);
    $t->setDescricao($descricao);
    $t->setDataInicial($dataInicial);
    $t->setDataLimite($dataLimite);
    $t->setIdColabora($idColabora);    
    $t->setIdAdm($idAdm);
    $t->setTokenEmpresa($tokenEmpresa);

    $tDao->add($t);
}else{
    header('Location: ../views/adm/control.php');
    exit;
}


header('Location: ../views/adm/control.php');
exit;