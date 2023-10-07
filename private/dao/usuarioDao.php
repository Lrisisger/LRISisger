<?php

require_once(realpath(dirname(__FILE__) . '/../config.php'));
require_once (realpath(dirname(__FILE__) . '/../class/Usuarios.php'));


class UsuarioDaoMysql implements UsuarioDAO{

    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }

    private function generateUser($data){
        $user = new Usuarios();
        $user->setId($data['id']);
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPass($data['senha']);
        $user->setCpf($data['cpf']);
        $user->set($data['isAdm']);
        $user->set($data['token']);

        return $user;
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
            $user = generateUser($db_u);
            return $user;
        }
        
        return false;
    }

    public function findByToken($token){
 
        if(!empty($token)){
            $sql = $this->pdo->prepare("SELECT * FROM usuarios where token = :token");
            $sql->bindValue(":token", $token);
            $sql->execute();
            
            if($sql->rowCount() > 0){
                $db_u = $sql->fetch(PDO::FETCH_ASSOC);
                $user = generateUser($db_u);
            }
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

