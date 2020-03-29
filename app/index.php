<?php
/**
 * Define aqui toda a sua regra da aplicação
 * @author - Bruno Nascimento
 * @todo - Não apague este arquivo.
 * @todo - O arquivo é essencial para que sua aplicação funcione
 * 
 */

Routes::set('/', function () {
    View::build('home', array(
        'welcome' => Lang::translate('welcome')
    ));
});

 
/**
 * Sempre que uma url for acessada e não tiver sido definida com o Routes::set
 * a aplicação carregará a página 404
 */
Routes::notFound(array(
    'css404' => App::layout('/stylesheet/not-found.css')
));