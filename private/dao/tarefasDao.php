<?php

require_once '../class/Usuarios.php';
require_once '../config.php';

class TarefasDao implements TarefasDAO {

    private $pdo;

    function __construct(PDO $driver){
        $this->pdo = $driver;
    }

    public function add(Tarefas $u){
//INSERT INTO musicos (name, email) VALUES (:name, :email)
        $sql = $this->pdo->prepare("INSERT INTO task (descricao, dataInicio, dataLimite, idColaborador, idAdm, mensagemAtraso) VALUES (:descricao, :dataInicio, :dataLimite, :idColaborador, :idAdm, :mensagemAtraso)");
        $sql->bindValue(':descricao', $u->getDescription());
        $sql->bindValue(':dataInicio', $u->getInitDate());
        $sql->bindValue(':dataLimite', $u->getLimitDate());
        $sql->bindValue(':idColaborador', $u->getWorkerId());
        $sql->bindValue(':idAdm', $u->getAdmId());
        $sql->bindValue(':mensagemAtraso', $u->getMensageDelay());
        $sql->execute();

    }
    public function findAll(){

        $array = [];

        $sql = $this->pdo->prepare("SELECT * FROM task");

        if($sql->rowCount() > 0){
            $data = $sql->fetchAll();
            foreach($data as $item){
                $u = new Tarefas();
                $u->setDescription($item['descricao']);
                $u->setInitDate($item['dataInicio']);
                $u->setLimitDate($item['dataLimite']);
                $u->setWorkerId($item['idColaborador']);
                $u->setAdmId($item['idAdm']);
                $u->setMensageDelay($item['mensagemAtraso']);

                $array[] = $u;
            }


            return $array;
        }

    }
    public function findById($id){

        $sql = $this->pdo->prepare("SELECT * FROM task WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){

            $data = $sql->fetch();

            $u = new Tarefas();
            $u->setDescription($data['descricao']);
            $u->setInitDate($data['dataInicio']);
            $u->setLimitDate($data['dataLimite']);
            $u->setWorkerId($data['idColaborador']);
            $u->setAdmId($data['idAdm']);
            $u->setMensageDelay($data['mensagemAtraso']);
            
            return u;
        }

        return false;
    }
    public function update(Tarefas $u){

        $sql = $this->pdo->prepare("UPDATE task SET 
            descricao = :descricao, 
            dataInicio = :dataInicio, 
            dataLimite = :dataLimite, 
            idColaborador = :idColaborador, 
            idAdm = :idAdm, 
            mensagemAtraso = :mensagemAtraso 
            WHERE id = :id");

        $sql->bindValue(':descricao', $u->getDescription());
        $sql->bindValue(':dataInicio', $u->getInitDate());
        $sql->bindValue(':dataLimite', $u->getLimitDate());
        $sql->bindValue(':idColaborador', $u->getWorkerId());
        $sql->bindValue(':idAdm', $u->getAdmId());
        $sql->bindValue(':mensagemAtraso', $u->getMensageDelay());
        $sql->execute();

    }
    public function delete($id){

        //"DELETE FROM musicos WHERE `musicos`.`id` = :id"

        $sql = $this->pdo->prepare("DELETE FROM task WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

    }
}