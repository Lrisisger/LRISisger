<?php

require_once( realpath( dirname( __FILE__ ) . '/../../config/config.php' ) );
require_once ( realpath( dirname( __FILE__ ) . '/../models/Usuarios.php' ) );

class UsuarioDaoMysql implements UsuarioDAO {

    private $xmlFile;
    private $path;
    private $pathId;
    private $xmlIdFile;

    public function __construct() {
        $this->path = realpath( dirname( __FILE__ ) . '/../xml/usuarios.xml' );
        $this->pathId = realpath( dirname( __FILE__ ) . '/../xml/id.xml' );
        $this->xmlFile = simplexml_load_file( $this->path );
        $this->xmlIdFile = simplexml_load_file( $this->pathId );

    }

    //FUNÇÃO QUE LIDA COM A ADIÇÃO DE USUARIOS NO XML

    private function handleAdd( Usuarios $u, $newId ) {

        if ( $newId ) {
            $xmlId = $this->xmlIdFile;
            $idAtual = $xmlId->idUser;
            $idAtual = $idAtual + 1;

        }

        $novoRegistro = $this->xmlFile->addChild( 'usuario' );
        $novoRegistro->addChild( 'id', $newId ? $idAtual : $u->getId() );
        $novoRegistro->addChild( 'name', $u->getName() );
        $novoRegistro->addChild( 'email', $u->getEmail() );
        $novoRegistro->addChild( 'password', $u->getPass() );
        $novoRegistro->addChild( 'cpf', $u->getCpf() );
        $novoRegistro->addChild( 'isAdm', $u->getIsAdm() );
        $novoRegistro->addChild( 'token', $u->getToken() );

        $this->xmlFile->asXML( $this->path );

        if ( $newId ) {
            $dom = dom_import_simplexml( $this->xmlIdFile->idUser );
            $dom->parentNode->removeChild( $dom );
            $this->xmlIdFile->asXML( $this->pathId );

            $novoId = $this->xmlIdFile->addChild( 'idUser', $idAtual );
            $this->xmlIdFile->asXML( $this->pathId );
        }
    }

    //FUNÇÃO QUE DELETA USUARIOS DO XML

    private function handleDel( $id ) {
        foreach ( $this->xmlFile->usuario as $item ) {
            if ( $item->id == $id ) {
                $dom = dom_import_simplexml( $item );
                $dom->parentNode->removeChild( $dom );
                $this->xmlFile->asXML( $this->path );

            }

        }

    }

    public function add( Usuarios $u ) {

        $this->handleAdd( $u, true );

    }

    public function findAll( $handleSearch ) {

        $xml = $this->xmlFile;
        $array = [];
        if ( $handleSearch == 0 ) {

            if ( count( $xml->children() ) > 0 ) {
                foreach ( $xml as $item ) {

                    if ( $item->isAdm == '0' ) {
                        $u = new Usuarios();
                        $u->setId( $item->id );
                        $u->setName( $item->name );
                        $u->setEmail( $item->email );
                        $u->setPass( $item->password );
                        $u->setCpf( $item->cpf );
                        $u->setIsAdm( $item->isAdm );
                        $u->setToken( $item->token );

                        $array[] = $u;
                    }
                }
            }

        } else if ( $handleSearch == 1 ) {
            if ( count( $xml->children() ) > 0 ) {
                foreach ( $xml as $item ) {

                    if ( $item->isAdm == 1 ) {
                        $u = new Usuarios();
                        $u->setId( $item->id );
                        $u->setName( $item->name );
                        $u->setEmail( $item->email );
                        $u->setPass( $item->password );
                        $u->setCpf( $item->cpf );
                        $u->setIsAdm( $item->isAdm );
                        $u->setToken( $item->token );

                        $array[] = $u;
                    }
                }

            }

        } else {

            if ( count( $xml->children() ) > 0 ) {
                foreach ( $xml as $item ) {
                    $u = new Usuarios();
                    $u->setId( $item->id );
                    $u->setName( $item->name );
                    $u->setEmail( $item->email );
                    $u->setPass( $item->password );
                    $u->setCpf( $item->cpf );
                    $u->setIsAdm( $item->isAdm );
                    $u->setToken( $item->token );

                    $array[] = $u;
                }
            }

        }

        return $array;

    }

    public function findById( $id ) {

        $xml = $this->xmlFile;
        if ( count( $xml->children() ) > 0 ) {
            foreach ( $xml as $item ) {
                if ( $item->id == $id ) {
                    $u = new Usuarios();
                    $u->setId( $item->id );
                    $u->setName( $item->name );
                    $u->setEmail( $item->email );
                    $u->setPass( $item->password );
                    $u->setCpf( $item->cpf );
                    $u->setIsAdm( $item->isAdm );
                    $u->setToken( $item->token );

                    return $u;
                }
            }
        }

        return false;
    }

    public function findByToken( $token ) {

        $xml = $this->xmlFile;
        if ( count( $xml->children() ) > 0 ) {
            foreach ( $xml as $item ) {
                if ( $item->token == $token ) {
                    $u = new Usuarios();
                    $u->setId( $item->id );
                    $u->setName( $item->name );
                    $u->setEmail( $item->email );
                    $u->setPass( $item->password );
                    $u->setCpf( $item->cpf );
                    $u->setIsAdm( $item->isAdm );
                    $u->setToken( $item->token );

                    return $u;
                }
            }
        }
        return false;
    }

    public function findByEmail( $email ) {

        $xml = $this->xmlFile;
        if ( count( $xml->children() ) > 0 ) {
            foreach ( $xml as $item ) {
                if ( $item->email == $email ) {
                    $u = new Usuarios();
                    $u->setId( $item->id );
                    $u->setName( $item->name );
                    $u->setEmail( $item->email );
                    $u->setPass( $item->password );
                    $u->setCpf( $item->cpf );
                    $u->setIsAdm( $item->isAdm );
                    $u->setToken( $item->token );

                    return $u;
                }
            }
        }

        return false;
    }

    public function update( Usuarios $u ) {
        $this->handleDel( $u->getId() );
        $this->handleAdd( $u, false );
    }

    public function delete( $id ) {
        $this->handleDel( $id );
    }

}

?>

