<?php
/**
 * Define aqui toda a sua regra da aplicação
 * @author - Bruno Nascimento
 * @todo - Não apague este arquivo.
 * @todo - O arquivo é essencial para que sua aplicação funcione
 * 
 */

use Session\Session;

//todo: route of example
Routes::set('/', function() {
    if (Session::get('user_id'))
    {
        Routes::get('home');
    }
    else
    {
        Routes::get('signin');
    }
});

/**
 * Sempre que uma url for acessada e não tiver sido definida com o Routes::set
 * a aplicação carregará a página 404
 */
Routes::notFound();