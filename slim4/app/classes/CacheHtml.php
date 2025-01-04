<?php

namespace app\classes;

class CacheHtml{

    private static string $folderCacheViews = '../app/views/cache/';
    private static string $folderViews = '../app/views/';
    private static int $expirationInSeconds = 10;

    public static function set($html,$data){

        $file = static::$folderCacheViews . $html . '_cache.html';

        $view = static::$folderViews . $html . '.html';

        if(!file_exists($view)){
            die('View ' . $view . ' não existe');
        }
        if(!file_exists($file) || time() - filemtime($file) > static::$expirationInSeconds){
            file_put_contents($file, $data);
        } 
    }
    public static function get($html){
        $file = static::$folderCacheViews . $html . '_cache.html';

        if(!file_exists($file) || time() - filemtime($file) > static::$expirationInSeconds){
            //var_dump('cache venceu');
            return $html; //vai retornar a home
        }

        //var_dump('cache não venceu');
        return 'cache/' . $html . '_cache';
        //return $file;

    }
    
}