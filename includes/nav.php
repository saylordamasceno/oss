<?php 
class Navegacao{
    private $limitRows = 30;
    private $TotalRows = 0;
    private $pagina = 0;
    private $Total_Pages = 0;
    private $start_row = 1;

    private function contPaginas(){
        $this->Total_Pages = ceil($this->TotalRows/$this->limitRows);
    }  
          private function crialink($page,$img){
        $tmp_param = preg_replace('/&pagina=[0-9]{1,2}|pagina=[0-9]{1,2}/sx','', $_SERVER['QUERY_STRING']);
        $local = $_SERVER['PHP_SELF'].'?'.$tmp_param;
        $tmp_link = '<div><a href="'.$local;
        if(!empty($tmp_param)) $tmp_link.='&';
        $tmp_link.= 'pagina='.$page.'"><img src="../Imagens/';
        $tmp_link.= $img;
        $tmp_link.='" /></a></div>';
        return $tmp_link;      
    }
    
    private function primeira(){
        if ($this->pagina > 2)
            $tmp_linha = $this->crialink(1, 'First.gif');
        return $tmp_linha;        
            
    } 
    
    private function proxima(){
        if (empty($this->pagina)) $this->pagina = 1;
        if($this->pagina < $this->Total_Pages)
            $tmp_linha = $this->crialink(($this->pagina+1),'Next.gif');
        return $tmp_linha;
    } 
    
    private function anterior(){
        $tmp_linha = '';
        if ($this->pagina > 1)
            $tmp_linha = $this->crialink(($this->pagina-1),'Previous.gif');
        return $tmp_linha;
    }
    
    private function ultima(){
        $tmp_linha = '';
        if ($this->pagina < $this->Total_Pages-1)
            $tmp_linha = $this->crialink($this->Total_Pages,'Last.gif');
        return $tmp_linha;
    }
    
    function setPagina($page){
        if (empty($page) || $page == 0)
            $this->pagina = 1;
        else
            $this->pagina = $page;
    }  
    
    function setLimitRows($limit = 30){
        $this->limitRows = $limit;
    }
    
    function setTotalRows($rows = 0){
        $this->TotalRows = $rows;    
    }
    
    function getTotalRows(){
        return $this->TotalRows;
    }
    
   
    function getLimit(){
        if ($this->pagina > 1) 
            $tmp_pag = $this->pagina - 1;
        $this->start_row = (($tmp_pag*$this->limitRows));
        $tmp_linha = ' LIMIT '.$this->start_row.', '.$this->limitRows;
        return $tmp_linha;          
    }  
   
    function getPaginacao(){
        $this->contPaginas();
        $tmp_linha ='<div class="nav_tab">';
        $tmp_linha.=$this->primeira();
        $tmp_linha.=$this->anterior();
        $tmp_linha.='<div>'.$this->pagina.'</div>';
        $tmp_linha.=$this->proxima();
        $tmp_linha.=$this->ultima();
        $tmp_linha.='</div>';
        return $tmp_linha;
    }
}
 ?>