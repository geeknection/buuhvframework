<?php
/**
 * BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */

use BuuhV\Lang;
use BuuhV\Routes;

/**
 * Fallback routes
 */
Routes::notFound(array(
    'css404' => App::layout('/stylesheet/not-found.css'),
    'page_not_found' => Lang::translate('page_not_found')
));