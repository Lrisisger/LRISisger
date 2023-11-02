<?php

class Auth {   

    //FUNÇÃO QUE CHECA SE O USUARIO ESTÁ LOGADO OU NÃO
    public function checkToken() {
        if(!empty($_SESSION['token'])){
            $token = $_SESSION['token'];
            // $token = $_SESSION['isADM'];
            $uDao = new UsuarioDaoXml();
            $user = $uDao->findByToken($token);
            
            if($user){
                return $user;                
            }       
        }   
    }
    
}