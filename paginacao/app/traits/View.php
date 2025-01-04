<?php

namespace app\traits;

use app\src\Load; //Carrega o Load

trait View{
   
    protected $twig;

    protected function twig(){
        $loader = new \Twig\Loader\FilesystemLoader('../app/views');
        
        $this->twig = new \Twig\Environment($loader, [
            //'cache' => '',
            'debug' => true
        ]);
    }

    protected function functions(){
        $functions = Load::file('/app/functions/twig.php');

        foreach($functions as $function){
            $this->twig->addFunction($function); //addFunction é do próprio twig
        }
    }

    protected function load(){
        $this->twig();

        $this->functions();
    }

    protected function view($view,$data){
        $this->load(); //chama o twig e o fucntions

        $template = $this->twig->loadTemplate(str_replace('.','/',$view).'.html');

        return $template->display($data);
    }

}