<?php
    namespace App;
    use MF\Init\Bootstrap;

    class Route  extends Bootstrap{

        //Configurando quais minha aplicação possui
        protected function initRoutes(){
            $routes['home'] = array(
                'route' => '/',
                'controller' => 'indexController',
                'action' => 'index'
            );  

            $routes['registraProblemaSolucao'] = array(
                'route' => '/registraProblemaSolucao',
                'controller' => 'indexController',
                'action' => 'registraProblemaSolucao'
            );

            $this -> setRoutes($routes);
        }

    }
?>