<?php

    class Usuarios {
        private $id;
        private $name;
        private $email;
        private $cpf;
        private $pass;
        private $isAdm;
        private $token;



        public function getId(){
            return $this->id;
        }

        public function setId($n){
            $this->id = trim($n);
        }

        public function getName(){
            return $this->name;
        }

        public function setName($n){
            $this->name = trim($n);
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($n){
            $this->email = ucwords(strtolower(trim($n)));
        }

        public function getCpf(){
            return $this->cpf;
        }

        public function setCpf($n){
            $this->cpf = trim($n);
        }

        public function getPass(){
            return $this->senha;
        }

        public function setPass($n){
            $this->senha = trim($n);
        }

        public function getIsAdm(){
            return $this->isAdm;
        }

        public function setIsAdm($n){
            $this->isAdm = trim($n);
        }

        public function getToken(){
            return $this->token;
        }

        public function setToken($n){
            $this->token = trim($n);
        }



        
    }

    interface UsuarioDAO {
        public function add(Usuarios $u);
        public function findById($id);
        public function update(Usuarios $u);
        public function delete($id);
    }