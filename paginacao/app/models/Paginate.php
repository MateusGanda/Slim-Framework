<?php

namespace app\models;

use app\traits\Links;

class Paginate{

    use Links;

    private $page;
    private $perPage;
    private $offset;
    private $pages;
    private $records;

    private function current(){
        $this->page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1; //Se não existir a variável page na URL então retorna a primeira página
    }

    private function perPage($perPage){
        $this->perPage = $perPage ?? 30; //Se existir o perPage retorna ele, senão retorna 30(no caso aqui são os registros por página)
    }

    private function offset() {
                           
        $this->offset = $this->page * $this->perPage - $this->perPage; //1 * 2 = 2 - 2 = 0 (offset 0)
    }

    public function records($records){
        $this->records = $records;
    }

    private function pages(){
        $this->pages = ceil($this->records / $this->perPage);  //10 / 2 = 5 páginas
    }

    public function sqlPaginate(){
        return " limit {$this->perPage} offset {$this->offset}";
    }

    public function paginate($perPage) {
        $this->current();

        $this->perPage($perPage);

        $this->offset();

        $this->pages();
    }
}