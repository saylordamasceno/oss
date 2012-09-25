<?php
class db_usuario extends db{

    public function __construct() {
        parent::__construct();
        $this->query = "SELECT * FROM usuarios";
    }
    
    function comId($id){
        $this->query .= " WHERE id = ".$id;
    }

    function comNome($login){
        $this->query .= " WHERE nome LIKE ".$login;
    }

    function comEmail($email){
        $this->query .= " WHERE email LIKE ".$email;
    }    
    
    function buscar(){
        return $this->query($this->query);
    }
}
?>