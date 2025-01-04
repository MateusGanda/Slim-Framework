<?php

namespace app\traits;

trait Links{

    protected $maxLinks = 4; //número de links antes e depois a página (tipo se está na pag 7 vai aparecer o 3,4,5,6)

    private function pageRequest(){
        return(!busca()) ? "?page=" : "?s=" . busca() ."&page=";
    }
    private function previous() { //Página anterior
        if($this->page > 1) { //se a página atual for maior que 1
            $preview = ($this->page - 1);
			$links = '<li><a href="'. $this->pageRequest() . '1"> [1] </a></li>';
			$links .= '<li><a href="'. $this->pageRequest() . $preview . '" aria-label="Previous"> <span 
                aria-hidden="true">&laquo;</span></a></li>'; //&laquo é a setinha para a esquerda

			return $links;
        }
    }

    private function next() { //Página posterior
        if($this->page < $this->pages) { //se a pagina atual for menor que o total de páginas
            $next = ($this->page + 1);
			$links = '<li><a href="' . $this->pageRequest() . $next . '" aria-label="Next"> <span
                 aria-hidden="true">&raquo;</span></a></li>'; //&raquo seta para a esquerda
			$links .= '<li><a href="' . $this->pageRequest() . $this->pages . '"> [' . $this->pages . '] </a></li>';

			return $links;
        }
    }

    public function links(){

        if ($this->pages > 0) {

            $links = "<ul class='pagination'>";

            $links .= $this->previous();

            for ($i=$this->page - $this->maxLinks; $i <= $this->page + $this->maxLinks; $i++) { 

                $class = ($i == $this->page) ? 'actual' : '';

                if($i > 0 && $i<= $this->pages){ //se o i for maior que 0 e o i for menor ou igual que o numero total de páginas
                    $links .= "<li class='page-item'><a href='" . $this->pageRequest() . $i . "' class=" . $class . ">{$i}</a></li>|";
                }
            }

            $links .= $this->next();
            $links .= '</ul>';

            return $links;
        }
    }

}