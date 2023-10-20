<?php

class Auth {   

    //FUNÇÃO QUE CHECA SE O USUARIO ESTÁ LOGADO OU NÃO
    public function checkToken() {
        if(!empty($_SESSION['token'])){
            $token = $_SESSION['token'];
            $uDao = new UsuarioDaoMysql();
            $user = $uDao->findByToken($token);
            
            if($user){
                return $user;                
            }       
        }   
    }
    
}