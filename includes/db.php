<?php

/*
  - Classes para acesso a bancos de dados
  - Saylor Gabriel Damasceno
 */

define("DB_HOSTI", "localhost"); // host de conexão com o MySQL
define("DB_USERNAMEI", "root"); // nome do usuário para conexão
define("DB_PASSWORDI", ""); // senha do usuário para conexão
define("DB_DATABASEI", "ordem"); // nome do bd

class db{

    var $dbi;
    var $query;
    var $erro;
    var $cont;
    var $buffer;    

    public function __construct() {
        return $this->open();
    }
    
    public function __destruct() {
        $this->close();
    }
    
    function open() {
        if(!$this->dbi = mysql_pconnect(DB_HOSTI, DB_USERNAMEI, DB_PASSWORDI))
            throw new Exception("Erro na conexão!");
        
        if(!mysql_select_db(DB_DATABASEI))
            throw new Exception("Erro na seleção do banco de dados!");
    }

    function close() {
        if($this->query) mysql_free_result($this->query);
        mysql_close($this->dbi);
    }

    function query($sql) {
        if(!$this->query = mysql_query($sql, $this->dbi)){
            throw new Exception(mysql_errno() . ': ' . mysql_error());
        }else{
            return 1;
        }
    }
    
    function proximo() {

        if (!$this->buffer = @mysql_fetch_array($this->query)) {
            $this->buffer = 'Nao tem MAIS nada!';
            return 0;
        }else{
            $this->cont++;
            return $this->buffer;
        }
    }    

    function linhas(){
        return mysql_num_rows($this->query);
    }

    function result($linha, $campo) {
        return mysql_result($this->query, $linha, $campo);
    }
    
    function ultimoId() {
        return mysql_insert_id($this->dbi);
    }    
    
    function afetados() {
        return mysql_affected_rows($this->dbi);
    }    

    function resultado($tipo=0){
        if($tipo==0)
            return mysql_fetch_assoc($this->query);
        else
            return mysql_fetch_array($this->query);
    }
    
}

?>