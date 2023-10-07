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

            $userDao - new UserDaoMySql($this->pdo);
            $user = $userDao->findBeToken($token);
            
            if($user){
                return $user;
            }

         }
         echo $this->base;
         header("Location: adm/pages/login.php");
         exit;

    }
    
}