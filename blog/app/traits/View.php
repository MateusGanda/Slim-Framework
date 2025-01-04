<?php

namespace app\traits;

use app\src\Load;
use Twig\Extra\String\StringExtension;

trait View{
   
    protected $twig;

    protected function twig(){
        $loader = new \Twig\Loader\FilesystemLoader('../app/views');
        
        $this->twig = new \Twig\Environment($loader, array(
            // 'cache' => '',
            'debug' => true 
        ));

        $this->twig->addExtension(new StringExtension());
    }

    protected function functions(){
        $functions = Load::file('/app/functions/twig.php');

        foreach($functions as $function){
            $this->twig->addFunction($function);
        }
    }

    protected function load(){
        $this->twig();

        $this->functions();
    }

    protected function view($view,$data){
        $this->load();

        $template = $this->twig->loadTemplate(str_replace('.','/',$view).'.html');

        return $template->display($data);
    }

}