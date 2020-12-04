<?php
/**
* Core
*
* Mahan | Core handler
*
* @package    App\Core
* @author     Milad Abooali <m.abooali@hotmail.com>
* @copyright  2012 - 2020 Codebox
* @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
* @version    1.0.0
*/

    namespace App\Core;

    if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');

    use stdClass;

    mb_internal_encoding('utf-8');
    mb_http_output('utf-8');
    mb_http_input('utf-8');
    mb_language('uni');
    mb_regex_encoding('utf-8');

    include_once ('config.php');
    include_once ('./core/lib/m.php');

    session_save_path('core/sessions');
    ini_set('session.gc_probability', 1);
    session_start();
    $time = $_SERVER['REQUEST_TIME'];
    if (isset($_SESSION['M']['LAST_ACTIVITY']) && ($time - $_SESSION['M']['LAST_ACTIVITY']) > SESSION_TIMEOUT) {
        session_unset();
        session_destroy();
        M::aLog('core','Session Destroyed.');
        session_start();
    }
    $_SESSION['M']['LAST_ACTIVITY'] = $time;
    M::aLog('core','Session Timeout: <b style="color: darkred">'.SESSION_TIMEOUT.'</b> Seconds');
    if (!isset($_SESSION['M']['TOKEN'])) $_SESSION['M']['TOKEN'] = bin2hex(M::getClientIP());
    M::aLog('core','Session Token: <b style="color: darkred">'.$_SESSION['M']['TOKEN'].'</b>');

    include_once ('autoload.php');
    spl_autoload_register('App\Core\Loader::lib');

    //    $LANG = new Language('EN');
    //    define("_L", parse_ini_file($LANG->PATH.'core.ini',true));

    $page = array();
    $page['data'] = explode("/", $_GET["rout"]??null) ;
    $page['vid']  = array_shift($page['data']);
    M::aLog('core','Call "<b style="color: blue">'.($_GET["rout"]??'index').'</b>"');
    if ($page['vid']=='ajax') {
        $token = ($_POST['token'] ?? $_GET['token']) ?? false;
        if ($_SESSION['M']['TOKEN']!=$token) exit('T0');

        $class  = array_shift($page['data']) ?? 'core';
        $act  = "App\Core\\". (array_shift($page['data']) ?? 'def');
        $id  = array_shift($page['data']) ?? false;
        $class_path = 'core/ajax/'.$class.'.php';
        M::aLog('core',"Class <b style='color:green'>$class</b> is called.",null,'ajax');
        if (file_exists($class_path)) {
            /** @noinspection PhpIncludeInspection */
            include_once $class_path;
            M::aLog('core',"Class <b style='color:green'>$class_path</b> is loaded.",null,'ajax');
        } else {
            M::aLog('core',"Class <b style='color:red'>$class_path</b> is not exists!",1,'ajax');
        }
        M::aLog('core',"Action <b style='color:green'>$act</b> is called.",null,'ajax');
        if (function_exists($act)) {
            M::aLog('core',"Run Function <b style='color:green'>$act</b>",null,'ajax');
            $act($id);
        } else {
            M::aLog('core',"Run Function <b style='color:green'>$act</b>",1,'ajax');
            http_response_code(404);
            $output = new stdClass();
            $output->e = 'Called action not found!';
            $output->res = 404;
            echo json_encode($output);
        }
    } else {
        include_once ('routing.php');
        $VIEW = new View($page);
        $VIEW->loadPage();
    }
    M::aLog('core','End');
    if (LOGGER) M::log();
    exit();
