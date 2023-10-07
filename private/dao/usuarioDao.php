<?php

require_once(realpath(dirname(__FILE__) . '/../config.php'));
require_once (realpath(dirname(__FILE__) . '/../class/Usuarios.php'));


class UsuarioDaoMysql implements UsuarioDAO{

    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }

    public function add(Usuarios $u){

        $sql = $this->pdo->prepare("INSERT INTO usuarios (name, email, senha, cpf, isAdm) VALUES (:name, :email, :senha, :cpf, :isAdm)"); 
        $sql->bindValue(':name', $u->getName());
        $sql->bindValue(':email', $u->getEmail());
        $sql->bindValue(':senha', $u->getPass());
        $sql->bindValue(':cpf', $u->getCpf());
        $sql->bindValue(':isAdm', $u->getIsAdm());
        $sql->execute();

    }

    public function findById($id){
 
        $sql = $this->pdo->prepare("SELECT * FROM usuarios where id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $db_u = $sql->fetch();

            $user = new Usuarios();
            $user->setId($db_u['id']);
            $user->setName($db_u['name']);
            $user->setEmail($db_u['email']);
            $user->setPass($db_u['senha']);
            $user->setCpf($db_u['cpf']);
            $user->set($db_u['isAdm']);

            return $user;
        }
        
        return false;
    }
    public function update(Usuarios $u){
        $sql = $this->pdo->prepare("UPDATE usuarios SET name = :name, email = :email, senha = :senha, cpf = :cpf, isAdm = :isAdm WHERE id = :id");
        $sql -> bindValue(':id', $u->getId());
        $sql->bindValue(':name', $u->getName());
        $sql->bindValue(':email', $u->getEmail());
        $sql->bindValue(':senha', $u->getPass());
        $sql->bindValue(':cpf', $u->getCpf());
        $sql->bindValue(':isAdm', $u->getIsAdm());
        $sql -> execute();
    }
    public function delete($id){
        
        $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE `usuarios`.`id` = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

}

 ?>

