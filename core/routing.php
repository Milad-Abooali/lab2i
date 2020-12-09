<?php
/**
 * Routing
 *
 * Mahan |  Router
 *
 * @package    App\Core
 * @author     Milad Abooali <m.abooali@hotmail.com>
 * @copyright  2012 - 2020 Codebox
 * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
 * @version    1.0.0
 */

    namespace App\Core;

    if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');

    /** @var array $page */
    switch ($page['vid']) {

        case "blog":
            $page['vid']    = 'blog Home';
            $page['upon']   = 'blog/home';
            $page['inc']    = 'home';
            $page['view']   = "blog/home";
            break;
        case "login":
            $page['vid']    = 'login';
            $page['view']   = "login";
            $page['cache']  = false;
            break;
        case "recoverPassword":
            $page['vid']    = 'recoverPassword';
            $page['view']   = "recover_password";
            $page['inc']    = "recover_password";

            $page['cache']  = false;
            break;
        case "register":
            $page['vid']    = 'register';
            $page['view']   = "register";
            $page['inc']    = "register";
            $page['cache']  = false;
            break;
        case null:
        case "home":    // Site Index/root
        case "":    // Site Index/root
            $page['vid']    = 'home';
            $page['view']   = 'home';
            $page['cache']  = false;
        break;

        default:    // Not Found
            $page['vid']        = false;        // Page View ID/Name
            $page['upon']       = null;         // Page Upon File
            $page['inc']        = null;         // Page Inc File
            $page['view']       = 'error/404';  // Page View File
            $page['cache']      = false;        // Page Cache Overwrite
    }