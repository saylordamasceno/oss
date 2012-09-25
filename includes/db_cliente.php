<?php
class db_cliente extends db{

    public function __construct() {
        parent::__construct();
        $this->query = "SELECT * FROM cliente";
    }
    
    function comId($id){
        $this->query .= " WHERE id = ".$id;
    }

    function comNome($nome){
        $this->query .= " WHERE nome LIKE ".$nome;
    }    
 
    function buscar(){
        return $this->query($this->query);
    }
}
?>