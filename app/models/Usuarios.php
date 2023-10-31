<?php
    //MODELO DOS USUARIOS
    class Usuarios {
        private $id;
        private $name;
        private $email;
        private $cpf;
        private $pass;
        private $isAdm;
        private $token;
        private $tokenEmpresa;
        private $mainAcc;

        //FUNÇÃO QUE PEGA O VALOR DO ID DO USUARIO
        public function getId(){
            return $this->id;
        }

        //FUNÇÃO QUE ALTERA O VALOR DO ID DO USUARIO
        public function setId($n){
            $this->id = trim($n);
        }

        //FUNÇÃO QUE PEGA O VALOR DO NOME DO USUARIO
        public function getName(){
            return $this->name;
        }

        //FUNÇÃO QUE ALTERA O VALOR DO NOME DO USUARIO
        public function setName($n){
            $this->name = trim($n);
        }

        //FUNÇÃO QUE PEGA O VALOR DO EMAIL DO USUARIO
        public function getEmail(){
            return $this->email;
        }

        //FUNÇÃO QUE ALTERA O VALOR DO EMAIL DO USUARIO
        public function setEmail($n){
            $this->email = ucwords(strtolower(trim($n)));
        }

        //FUNÇÃO QUE PEGA O VALOR DO CPF DO USUARIO
        public function getCpf(){
            return $this->cpf;
        }

        //FUNÇÃO QUE ALTERA O VALOR DO CPF DO USUARIO
        public function setCpf($n){
            $this->cpf = trim($n);
        }

        //FUNÇÃO QUE PEGA O VALOR DA SENHA DO USUARIO
        public function getPass(){
            return $this->pass;
        }

        //FUNÇÃO QUE ALTERA O VALOR DA SENHA DO USUARIO
        public function setPass($n){
            $this->pass = trim($n);
        }

        //FUNÇÃO QUE PEGA O VALOR SE O USUARIO É UM ADM OU NÃO
        public function getIsAdm(){
            return $this->isAdm;
        }

        //FUNÇÃO QUE ALTERA O VALOR SE O USUARIO É UM ADM OU NÃO
        public function setIsAdm($n){
            $this->isAdm = trim($n);
        }

        //FUNÇÃO QUE PEGA O VALOR DO TOKEN DO USUARIO
        public function getToken(){
            return $this->token;
        }

        //FUNÇÃO QUE ALTERA O VALOR DO TOKEN DO USUARIO
        public function setToken($n){
            $this->token = trim($n);
        }

        //FUNÇÃO QUE PEGA O VALOR DO TOKEN DA EMPRESA DO USUARIO
        public function getTokenEmpresa(){
            return $this->tokenEmpresa;
        }

        //FUNÇÃO QUE ALTERA O VALOR DO TOKEN DA EMPRESA DO USUARIO
        public function setTokenEmpresa($n){
            $this->tokenEmpresa = trim($n);
        }

        public function setMainAcc($n){
            $this->mainAcc = trim($n);
        }

        public function getMainAcc(){
            return $this->mainAcc;
        }




        
    }

    //MODELO DO DAO DOS USUARIOS
    interface UsuarioDAO {
        public function add(Usuarios $u);
        public function findById($id);
        public function update(Usuarios $u);
        public function delete($id);
    }