<?php

require_once( realpath( dirname( __FILE__ ) . '/../models/Tarefas.php' ) );

class TarefasDaoXml implements TarefasDAO {

    private $xmlFile;
    private $path;
    private $pathId;
    private $xmlIdFile;

    public function __construct() {
        $this->path = realpath( dirname( __FILE__ ) . '/../xml/tarefas.xml' );
        $this->pathId = realpath( dirname( __FILE__ ) . '/../xml/id.xml' );
        $this->xmlFile = simplexml_load_file( $this->path );
        $this->xmlIdFile = simplexml_load_file( $this->pathId );
    }

    //FUNÇÃO QUE LIDA COM A ADIÇÃO DE USUARIOS NO XML

    private function handleAdd(Tarefas $t, $newId){

        if($newId){
            $xmlId = $this->xmlIdFile;
            $idAtual = $xmlId->idTarefa;
            $idAtual = $idAtual + 1;
        }

        $novoRegistro = $this->xmlFile->addChild( 'tarefa');
        $novoRegistro->addChild('id', $newId ? $idAtual : $t->getId());
        $novoRegistro->addChild('tituloTarefa', $t->getTituloTarefa());
        $novoRegistro->addChild('status', $t->getStatus());
        $novoRegistro->addChild('descricao', $t->getDescricao());
        $novoRegistro->addChild('dataInicial', $t->getDataInicial());
        $novoRegistro->addChild('dataLimite', $t->getDataLimite());
        $novoRegistro->addChild('idColabora', $t->getIdColabora());
        $novoRegistro->addChild('idAdm', $t->getIdAdm());
        $novoRegistro->addChild('mensagemAtraso', $t->getMensagemAtraso());
        $novoRegistro->addChild('tokenEmpresa', $t->getTokenEmpresa());

        $this->xmlFile->asXML($this->path);

        if($newId){
            $dom = dom_import_simplexml($this->xmlIdFile->idTarefa);
            $dom->parentNode->removeChild($dom);
            $this->xmlIdFile->asXML($this->pathId);

            $novoId = $this->xmlIdFile->addChild('idTarefa', $idAtual);
            $this->xmlIdFile->asXML($this->pathId);
        }
    }

    //FUNÇÃO QUE DELETA USUARIOS DO XML

    private function handleDel($id) {
        foreach ($this->xmlFile->tarefas as $item){
            if ($item->id == $id){
                $dom = dom_import_simplexml($item);
                $dom->parentNode->removeChild($dom);
                $this->xmlFile->asXML($this->path);

            }

        }

    }

    //FUNÇÃO QUE CHAMA A FUNÇÃO DE ADICIONA A TAREFA
    public function add( Tarefas $t ) {
        $this->handleAdd( $t, true );
    }

   
    //FUNÇÃO QUE BUSCA TODAS AS TAREFAS
    //TOKENEMPRESA IDENTIFICA A EMPRESA     
    public function findAll($tokenEmpresa) {


        $xml = $this->xmlFile;
        $array = [];

        if(count($xml->children()) > 0) {
            foreach($xml as $item){
                if($item->tokenEmpresa == $tokenEmpresa){
                    $t = new Tarefas();
                    $t->setId($item->id);
                    $t->setTituloTarefa($item->tituloTarefa);
                    $t->setStatus($item->status);
                    $t->setDescricao($item->descricao);
                    $t->setDataInicial($item->dataInicial);
                    $t->setDataLimite($item->dataLimite);
                    $t->setIdColabora($item->idColabora);
                    $t->setIdAdm($item->idAdm);
                    $t->setMensagemAtraso($item->mensagemAtraso);
                    $t->setTokenEmpresa($item->tokenEmpresa);

                    $array[] = $t;
                }

            }
        }

        return $array;

    }
    
    //FUNÇÃO QUE BUSCA A TAREFA POR ID
    public function findById($id){

        $xml = $this->xmlFile;
        if ( count($xml->children()) > 0) {
            foreach($xml as $item){
                if($item->id == $id){
                    $t = new Tarefas();
                    $t->setId($item->id);
                    $t->setTituloTarefa($item->tituloTarefa);
                    $t->setStatus($item->status);
                    $t->setDescricao($item->descricao);
                    $t->setDataInicial($item->dataIncial);
                    $t->setDataLimite($item->dataLimite);
                    $t->setIdColabora($item->idColabora);
                    $t->setIdAdm($item->idAdm);
                    $t->setMensagemAtraso($item->mensagemAtraso);
                    $t->setTokenEmpresa($item->tokenEmpresa);
                    

                    $array[] = $t;
                }
            }
            return $array;
        }

        return false;
    }


    



  //FUNÇÃO QUE BUSCA A TAREFA POR DATA
    public function findByDate($date, $tokenEmpresa) {
        $array = [];

        $xml = $this->xmlFile;
        if (count($xml->children()) > 0){
            foreach ($xml as $item) {
                if ($item->date == $date) {
                    if($item->tokenEmpresa == $tokenEmpresa){
                        $t = new Tarefas();
                        $t->setId($item->id);
                        $t->setTituloTarefa($item->tituloTarefa);
                        $t->setStatus($item->status);
                        $t->setDescricao($item->descricao);
                        $t->setDataInicial($item->dataIncial);
                        $t->setDataLimite($item->dataLimite);
                        $t->setIdColabora($item->idColabora);
                        $t->setIdAdm($item->idAdm);
                        $t->setMensagemAtraso($item->mensagemAtraso);
                        $t->setTokenEmpresa($item->tokenEmpresa);
    
                        $array[] = $t;
                    }
                }
            }
            return $array;
        }

        return false;
    }

    //FUNÇÃO QUE EDITA A TAREFA
    //PRIMIRO ELE CHAMA A FUNÇÃO DE DELETAR A TAREFA
    //DEPOIS ELE CHAMA A FUNÇÃO DE ADICIONAR A TAREFA COM OS NOVOS DADOS
    public function update(Tarefas $t) {
        $this->handleDel($t->getId());
        $this->handleAdd($t, false);
    }

    //CHAMA A FUNÇÃO DE DELETAR O USUARIO 
    public function delete($id) {
        $this->handleDel($id);
    }
}