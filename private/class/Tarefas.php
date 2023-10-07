<?php

    class Tarefas {
        private $id;
        private $description;
        private $initDate;
        private $limitDate;
        private $workerId;
        private $admId;
        private $mensageDelay;



        public function getId(){
            return $this->id;
        }

        public function setId($n){
            $this->id = trim($n);
        }

        public function getDescription(){
            return $this->decription;
        }

        public function setDescription($n){
            $this->decription = trim($n);
        }

        public function getInitDate(){
            return $this->initDate;
        }

        public function setInitDate($n){
            $this->initDate = trim($n);
        }

        public function getLimitDate(){
            return $this->limitDate;
        }

        public function setLimitDate($n){
            $this->limitDate = trim($n);
        }

        public function getWorkerId(){
            return $this->workerId;
        }

        public function setWorkerId($n){
            $this->workerId = trim($n);
        }

        public function getMensageDelay(){
            return $this->mensageDelay;
        }

        public function setMensageDelay($n){
            $this->mensageDelay = trim($n);
        }



        
    }

    interface TarefasDAO {
        public function add(Tarefas $u);
        public function findAll();
        public function findById($id);
        public function update(Tarefas $u);
        public function delete($id);
    }