<?php
namespace Home;

use App;
use Exception;
use View;

/**
 * Controla a página inicial
 */
class HomeView {
    function __construct() {}

    /**
     * Carrega os cards de informações importantes
     * @return string
     */
    private static function loadCards()
    {
        $cards = '';
        $labels = array('Members', 'Tickets', 'Produucts', 'Events');
        for ($i = 1; $i < 5; $i++) {
            $cards .= View::component('card',
            array(
                'total' => mt_rand(0, 999),
                'label' => $labels[$i-1],
                'position' => $i
            ));
        }

        return $cards;
    }
    /**
     * Array com os valores dos filtros que serão substituidos
     * @return array
     */
    private static function filterParams()
    {
        return array(
            'css_theme' => App::layout('/stylesheet/theme.css'),
            'jsChart' => App::layout('/javascript/chart.min.js'),
            'jsWow' => App::layout('/javascript/wow.min.js'),
            'jsPerfectScroll' => App::layout('/javascript/perfect-scroll.min.js'),
            'jsTanimation' => App::layout('/javascript/tanimation.min.js'),
            'jsMain' => App::layout('/javascript/main.min.js')
        );
    }
    /**
     * Carrega a view
     * @return void
     */
    public static function loadView()
    {
        try
        {
            $header = View::component('header', array(
                'domain' => DOMAIN,
                'logo' => App::layout('/images/logo.webp')
            ));
            $header_desktop = View::component('header.desktop', array(
                'user_avatar' => App::layout('/images/user-avatar.png')
            ));

            $sidebar = View::component('sidebar', array(
                'domain' => DOMAIN,
                'logo' => App::layout('/images/logo.webp')
            ));

            $params = self::filterParams();

            $params['cards'] = self::loadCards();
            $params['header_component'] = $header;
            $params['sidebar_component'] = $sidebar;
            $params['header.desktop_component'] = $header_desktop;
            
            View::build('home', $params);
        }
        catch(Exception $e)
        {
            throw new Exception($e);   
        }
    }
}