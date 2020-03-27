<?php
/**
 * Define aqui toda a sua regra da aplicação
 * @author - Bruno Nascimento
 * 
 */

//todo: route of example
Routes::set('/', function() {
    Routes::get('signin');
});

//todo: its required
Routes::notFound();