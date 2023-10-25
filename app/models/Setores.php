<?php

    class Setores {
        private $id;
        private $name;
        private $tokenSetor;
        private $tokenEmpresa;
       


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

        public function getTokenSetor(){
            return $this->tokenSetor;
        }

        public function setTokenSetor($n){
            $this->tokenSetor = trim($n);
        }

        public function getTokenEmpresa(){
            return $this->tokenEmpresa;
        }

        public function SetTokenEmpresa($n){
            $this->tokenEmpresa = trim($n);
        }
    }
    interface SetoresDAO {
        public function add(Setores $s);
        public function findById($id);        
        public function findAll($tokenEmpresa);        
        public function findByToken($token);
        public function findByTokenEmpresa($tokenEmpresa);
        public function update(Setores $s);
        public function delete($id);
    }