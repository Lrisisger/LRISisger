<?php

require_once( realpath( dirname( __FILE__ ) . '/../../config/config.php' ) );
require_once ( realpath( dirname( __FILE__ ) . '/../models/Setores.php' ) );

class SetoresDaoXml implements SetoresDAO {

    private $xmlFile;
    private $path;
    private $pathId;
    private $xmlIdFile;

    public function __construct() {
        $this->path = realpath( dirname( __FILE__ ) . '/../xml/setores.xml' );
        $this->pathId = realpath( dirname( __FILE__ ) . '/../xml/id.xml' );
        $this->xmlFile = simplexml_load_file( $this->path );
        $this->xmlIdFile = simplexml_load_file( $this->pathId );
        

    }

    //FUNÇÃO QUE LIDA COM A ADIÇÃO DE USUARIOS NO XML

    private function handleAdd( Setores $s, $newId ) {

        if ( $newId ) {
            $xmlId = $this->xmlIdFile;
            $idAtual = $xmlId->idSetor;
            $idAtual = $idAtual + 1;
        }

        $novoRegistro = $this->xmlFile->addChild( 'setor' );
        $novoRegistro->addChild( 'id', $newId ? $idAtual : $s->getId() );
        $novoRegistro->addChild( 'name', $s->getName() );  
        $novoRegistro->addChild( 'tokenSetor', $s->getTokenSetor() );   
        $novoRegistro->addChild( 'tokenEmpresa', $s->getTokenEmpresa() );

        $this->xmlFile->asXML( $this->path );

        if ( $newId ) {
            $dom = dom_import_simplexml( $this->xmlIdFile->idSetor );
            $dom->parentNode->removeChild( $dom );
            $this->xmlIdFile->asXML( $this->pathId );

            $novoId = $this->xmlIdFile->addChild( 'idSetor', $idAtual );
            $this->xmlIdFile->asXML( $this->pathId );
        }
    }

    //FUNÇÃO QUE DELETA USUARIOS DO XML

    private function handleDel( $id ) {
        foreach ( $this->xmlFile->setor as $item ) {
            if ( $item->id == $id ) {
                $dom = dom_import_simplexml( $item );
                $dom->parentNode->removeChild( $dom );
                $this->xmlFile->asXML( $this->path );

            }
        }
    }


    // FUNÇÃO QUE CHAMA A ADIÇÃO DO USUARIO
    public function add( Setores $s ) {

        $this->handleAdd( $s, true );

    }

    // FUNÇÃO QUE FAZ A BUSCA DOS USUARIOS
    // HANDLESEARCH É A VARIAVEL QUE INDENTIFICA SE O USUARIO É ADM OU NÃO 
    // TOKENEMPRESA INDETIFICA A EMPRESA DO USUARIO
    public function findAll($tokenEmpresa) {

        $xml = $this->xmlFile;
        $array = [];

        if ( count( $xml->children() ) > 0 ) {
            foreach ( $xml as $item ) {
                if($item->tokenEmpresa == $tokenEmpresa){
                    $s = new Setores();
                    $s->setId( $item->id );
                    $s->setName( $item->name );                    
                    $s->setTokenSetor( $item->tokenSetor );
                    $s->setTokenEmpresa( $item->tokenEmpresa );

                    $array[] = $s;
                }
            }
        }      

        return $array;

    }
    
    //FUNÇÃO QUE BUSCA O USUARIO POR ID
    public function findById( $id ) {

        $xml = $this->xmlFile;
        if ( count( $xml->children() ) > 0 ) {
            foreach ( $xml as $item ) {
                if ( $item->id == $id ) {
                    $s = new Setores();
                    $s->setId( $item->id );
                    $s->setName( $item->name );                    
                    $s->setTokenSetor( $item->tokenSetor );
                    $s->setTokenEmpresa( $item->tokenEmpresa );

                    return $s;
                }
            }
        }

        return false;
    }
    
    //FUNÇÃO QUE BUSCA POR TOKEN DO USUARIO 
    public function findByToken( $token ) {

        $xml = $this->xmlFile;
        if ( count( $xml->children() ) > 0 ) {
            foreach ( $xml as $item ) {
                if ( $item->tokenSetor == $token ) {
                    $s = new Setores();
                    $s->setId( $item->id );
                    $s->setName( $item->name );                    
                    $s->setTokenSetor( $item->tokenSetor );
                    $s->setTokenEmpresa( $item->tokenEmpresa );

                    return $s;
                }
            }
        }
        return false;
    }

    
    public function findByTokenEmpresa($tokenEmpresa){
        $xml = $this->xmlFile;
        if ( count( $xml->children() ) > 0 ) {
            foreach ( $xml as $item ) {
                if ( $item->tokenEmpresa == $tokenEmpresa ) {
                    $s = new Setores();
                    $s->setId( $item->id );
                    $s->setName( $item->name );                    
                    $s->setTokenSetor( $item->tokenSetor );
                    $s->setTokenEmpresa( $item->tokenEmpresa );

                    return $s;
                }
            }
        }
        return false;
    }


    //FUNÇAO QUE EDITA O USUARIO
    //PRIMIRO ELE CHAMA A FUNÇÃO DE DELETAR O USUARIO 
    //DEPOIS ELE CHAMA A FUNÇÃO DE ADICIONAR O USUARIO COM OS NOVOS DADOS
    public function update( Setores $s ) {
        $this->handleDel($s->getId());
        $this->handleAdd( $s, false );
    }
    
    //CHAMA A FUNÇÃO DE DELETAR O USUARIO 
    public function delete( $id ) {
        $this->handleDel( $id );
    }

}

?>

