<?php
class Core {

    public function run() {
        $url = isset($_GET['url']) ? $_GET['url'] : '/';
        $params = array();
        if (!empty($url) && $url != '/') {
           $url = explode('/', $url);
           if(in_array('', $url)){
                array_pop($url);
            }
           $currentController = $url[0]."Controller";
           array_shift($url);
           if (!empty($url)) {
               $currentAction = $url[0];
               array_shift($url);
           }else{
               $currentAction = "index";
           }
           if(count($url) > 0){
               if(in_array('', $url)){
                   array_pop($url);
               }
               $params = $url;
            }
        }else{
            $currentController = "homeController";
            $currentAction = "index";
        }
        $c = new $currentController();
        call_user_func_array(array($c, $currentAction), $params);
    }
    
}