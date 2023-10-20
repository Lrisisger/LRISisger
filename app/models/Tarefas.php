<?php
    //MODELO DAS TAREFAS
    class Tarefas {
        private $id;        
        private $tituloTarefa;
        private $status;
        private $descricao;
        private $dataInicial;
        private $dataLimite;
        private $idColabora;
        private $idAdm;
        private $mensagemAtraso;


        //FUNÇÃO QUE PEGA O VALOR DO ID
        public function getId(){
            return $this->id;
        }
        
        //FUNÇÃO QUE ALTERA O VALOR DO ID
        public function setId($n){
            $this->id = trim($n);
        }

        public function getTituloTarefa(){
            return $this->tituloTarefa;
        }

        public function setTituloTarefa($n){
            $this->tituloTarefa = trim($n);
        }

        public function getStatus(){
            return $this->status;
        }

        public function setStatus($n){
            $this->status = trim($n);
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function setDescricao($n){
            $this->descricao = trim($n);
        }

        public function getDataInicial(){
            return $this->dataInicial;
        }

        public function setDataInicial($n){
            $this->dataInicial = trim($n);
        }

        public function getDataLimite(){
            return $this->dataLimite;
        }

        public function setDataLimite($n){
            $this->dataLimite = trim($n);
        }

        public function getIdColabora(){
            return $this->idColabora;
        }

        public function setIdColabora($n){
            $this->idColabora = trim($n);
        }

        public function getIdAdm(){
            return $this->idAdm;
        }

        public function setIdAdm($n){
            $this->idAdm = $n;
        }

        public function getMensagemAtraso(){
            return $this->mensagemAtraso;
        }

        public function setMensagemAtraso($n){
            $this->mensagemAtraso = trim($n);
        }

       



        
    }

    //MODELO DO DAO DAS TAREFAS 
    interface TarefasDAO {
        public function add(Tarefas $t);
        public function findAll();
        public function findById($id);
        public function findByDate($date);
        public function update(Tarefas $t);
        public function delete($id);
    }