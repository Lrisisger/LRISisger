<?php

require(realpath(dirname(__FILE__) . '/../dao/usuarioDao.php'));

class Auth {

    private $pdo;
    private $base;

    public function __construct(PDO $driver, $base){

        $this->pdo = $driver;
        $this->base = $base;
        

    }

    public function checkToken() {
         if(!empty($_SESSION['token'])){

            $token = $_SESSION['token'];

            $uDao = new UsuarioDaoMysql($this->pdo);
            $user = $uDao->findByToken($token);
            
            if($user){
                return $user;
            }

         }
         
        header("Location: login.php");
        exit;

    }
    
}