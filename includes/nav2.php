<?php 
class Navegacao{
    private $Max_Links = 5;
    private $limit_rows = 30;
    private $pagina = 0;
    private $TotalRows = 0;
    private $Total_Pages = 0;
    private $start_row = 1;
    private $cssClass = 'class = "divNav"';
    
    
    private function contPaginas(){
        $this->Total_Pages = ceil($this->TotalRows/$this->limit_rows);
    }

    private function crialink($page,$text='',$atual = false){
        if (empty($text)) $text = $page;
        $class = ($atual) ? '<div class="l_Atual"' : '';
        $tmp_param = preg_replace('/&pagina=[0-9]{1,2}|pagina=[0-9]{1,2}/sx','', $_SERVER['QUERY_STRING']);
        $local = $_SERVER['PHP_SELF'].'?'.$tmp_param;
        $tmp_link = '<a href="'.$local;
        if(!empty($tmp_param)) 
            $tmp_link.='&';
        $tmp_link.= 'pagina='.$page.'">';
        $tmp_link.='<div '.$class.'>';
        $tmp_link.=$text.'</div></a>';
        return $tmp_link;      
    }    

    function __construct($limitRows = 30, $maxLinks = 5){
        $this->limit_rows = $limitRows;
        $this->Max_Links = $maxLinks;
    }
    
    function setPagina($page){
        if (empty($page) || $page == 0)
            $this->pagina = 1;
        else
            $this->pagina = $page;
    }
    
    function setMaxLinks($maxLinks = 5){
        $this->Max_Links = $maxLinks;
    }
    
    function setClass($newClass = 'divNav'){
        $this->cssClass = 'class = "'.$newClass.'"';
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
        $this->start_row = (($tmp_pag*$this->limit_rows));
        $tmp_linha = ' LIMIT '.$this->start_row.', '.$this->limit_rows;
        return $tmp_linha;          
    }      

   function getPaginacao(){
        $this->contPaginas();
        if ($this->Total_Pages > 1){
            
            if(($this->Max_Links%2) == 0)               //  SETA O NUMERO MÁXIMO DE LINKS POR PAGINA PARA UM NUMERO IMPAR
                $this->Max_Links++;                     //  PARA QUE A PAGINA ATUAL SEJA SEMPRE A PAGINA DO MEIO DA LISTA
    
            $c_links = floor($this->Max_Links/2);
            
            $End = $this->Max_Links;
            $Start = 1;
            
            if ($this->pagina <= $c_links){         //  INICIA A DEFINIÇÃO DO INICIO E FIM DO LOOP FOR    
                $Start = 1; 
            } elseif ($this->pagina-($c_links) > 1){
                $Start = $this->pagina-($c_links);
                $End = $this->pagina+($c_links);
            }
    
            if (floor($this->Total_Pages/2)<$c_links)
                $End = $this->Total_Pages; 
                       
            if ($this->pagina+$c_links > $this->Total_Pages){
                if ($this->Total_Pages-($this->Max_Links-1) <= 1 || $this->pagina == $c_links+1)
                    $Start = 1;
                else 
                    $Start = $this->Total_Pages-($this->Max_Links-1);
                $End = $this->Total_Pages;
            }
            elseif ($End < $this->Max_Links){
                $End = $this->pagina+($c_links);
            }
                                                           //  INICIA A CONSTRUÇÃO DO DIV DE NAVEGAÇÃO                    
            $tmp_linha =sprintf('<div %s >',$this->cssClass);
    
            if (($this->pagina-$c_links) > 1 && $this->Total_Pages > $this->Max_Links)       //  CRIA O LINK PARA A PRIMEIRA PAGINA.   
                $tmp_linha.=$this->crialink(1, 'Primeira');
    
            for ($i=$Start; $i <= $End; $i++) {     //  LOOP DE CRIAÇÃO DOS LINKS DAS PAGINAS ATRAVÉS DA FUNÇÃO criaLink()    
                $atual = false;
                if ($i == $this->pagina) $atual = true; 
                $tmp_linha.=$this->crialink($i, '',$atual);
            }
            
            if ($this->pagina < ($this->Total_Pages-$c_links) && $this->Total_Pages > $this->Max_Links)  //  CRIA O LINK DE ULTIMA PAGINA    
                $tmp_linha.=$this->crialink($this->Total_Pages, 'Ultima');
            $tmp_linha.='</div>';
                                                    //  TERMINA A CONSTRUÇÃO DO DIV DE NAVEGAÇÃO        
            return $tmp_linha;
        }
    }
}
 ?>