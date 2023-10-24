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
        private $tokenEmpresa; 
        private $tokenSetor;
        private $mensagemAtraso;  
       
      
      //FUNÇÃO QUE PEGA O VALOR DO ID
        public function getId(){
            return $this->id;
        }
        
        //FUNÇÃO QUE ALTERA O VALOR DO ID DA TAREFA
        public function setId($n){
            $this->id = trim($n);
        }

        //FUNÇÃO QUE PEGA O VALOR DO TITULO DA TAREFA
        public function getTituloTarefa(){
            return $this->tituloTarefa;
        }

        //FUNÇÃO QUE ALTERA O VALOR DO TITULO DA TAREFA
        public function setTituloTarefa($n){
            $this->tituloTarefa = trim($n);
        }

        //FUNÇÃO QUE PEGA O VALOR DO STATUS DA TAREFA
        public function getStatus(){
            return $this->status;
        }

        //FUNÇÃO QUE ALTERA O VALOR DO STATUS DA TAREFA
        public function setStatus($n){
            $this->status = trim($n);
        }

        //FUNÇÃO QUE PEGA O VALOR DA DESCRIÇÃO DA TAREFA
        public function getDescricao(){
            return $this->descricao;
        }

        //FUNÇÃO QUE ALTERA O VALOR DA DESCRIÇÃO DA TAREFA
        public function setDescricao($n){
            $this->descricao = trim($n);
        }

        //FUNÇÃO QUE PEGA O VALOR DA DATA DE INICIO DA TAREFA
        public function getDataInicial(){
            return $this->dataInicial;
        }

        //FUNÇÃO QUE ALTERA O VALOR DA DATA DE INCIO DA TAREFA
        public function setDataInicial($n){
            $this->dataInicial = trim($n);
        }

        //FUNÇÃO QUE PEGA O VALOR DA DATA LIMITE DA TAREFA
        public function getDataLimite(){
            return $this->dataLimite;
        }

        //FUNÇÃO QUE ALTERA O VALOR DA DATA LIMITE DA TAREFA
        public function setDataLimite($n){
            $this->dataLimite = trim($n);
        }

        //FUNÇÃO QUE PEGA O VALOR DO ID DO COLABORA
        public function getIdColabora(){
            return $this->idColabora;
        }

        //FUNÇÃO QUE ALTERA O VALOR DO ID DO COLABORA
        public function setIdColabora($n){
            $this->idColabora = trim($n);
        }

        //FUNÇÃO QUE PEGA O VALOR DO IDADM
        public function getIdAdm(){
            return $this->idAdm;
        }

        //FUNÇÃO QUE ALTERA O VALOR DO IDADM
        public function setIdAdm($n){
            $this->idAdm = $n;
        }

        //FUNÇÃO QUE PEGA O VALOR DO TOKEN DA EMPRESA
        public function getTokenEmpresa(){
            return $this->tokenEmpresa;
        }

        //FUNÇÃO QUE ALTERA O VALOR DO TOKEN DA EMPRESA
        public function setTokenEmpresa($n){
            $this->tokenEmpresa = $n;
        }

        //FUNÇÃO QUE PEGA O VALOR DO TOKEN DO SETOR
        public function getTokenSetor(){
            return $this->tokenEmpresa;
        }

        //FUNÇÃO QUE ALTERA O VALOR DO TOKEN DO SETOR
        public function setTokenSetor($n){
            $this->tokenEmpresa = $n;
        }


        //FUNÇÃO QUE PEGA O VALOR DA MENSAGEM DE ATRASO
        public function getMensagemAtraso(){
            return $this->mensagemAtraso;
        }

        //FUNÇÃO QUE ALTERA O VALOR DA MENSAGEM DE ATRASO
        public function setMensagemAtraso($n){
            $this->mensagemAtraso = trim($n);
        }

       



        
    }

    //MODELO DO DAO DAS TAREFAS 
    interface TarefasDAO {
        public function add(Tarefas $t);
        public function findAll($tokenEmpresa);
        public function findById($id);
        public function findBySetor($tokenSetor);
        public function update(Tarefas $t);
        public function delete($id);
    }