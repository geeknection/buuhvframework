<?php
/**
 * Define aqui toda a sua regra da aplicação
 * @author - Bruno Nascimento
 * @todo - Não apague este arquivo.
 * @todo - O arquivo é essencial para que sua aplicação funcione
 * 
 */

use Home\HomeView;

Routes::set('/', function() {
    HomeView::loadView();
});

/**
 * Sempre que uma url for acessada e não tiver sido definida com o Routes::set
 * a aplicação carregará a página 404
 */
Routes::notFound(array(
    'css404' => App::layout('/stylesheet/not-found.css'),
    'page_not_found' => Lang::translate('page_not_found')
));