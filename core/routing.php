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

    // Check user login
    define('is_user',($_SESSION['M']['user']['id']) ?? false);
    define('is_vendor',($_SESSION['M']['vendor']['id']) ?? false);
    define('is_login',(is_user || is_vendor) ?? false);

    /** @var array $page */
    switch ($page['vid']) {



        case "reset-password":
            if (!is_login) $page['vid']='login';
//            if (!is_login) continue 2;

            $page['vid']    = 'reset-assword';
            $page['view']   = "reset-password";
            $page['inc']    = "recover_password";
            $page['cache']  = false;
            break;
        case "email-history":
            $page['vid']    = 'email-history';
            $page['view']   = "email-history";
            $page['inc']    = "email-history";
            $page['cache']  = false;
            break;
        case "privacy":
            $page['vid']    = 'privacy';
            $page['view']   = "privacy";
            $page['inc']   = "privacy";
            $page['cache']  = false;
            break;
        case "my-invoices":
            $page['vid']    = 'my-invoices';
            $page['view']   = "my-invoices";
            $page['inc']    = "my-invoices";
            $page['cache']  = false;
            break;
        case "my-transactions":
            $page['vid']    = 'my-transactions';
            $page['view']   = "my-transactions";
            $page['inc']    = "my-transactions";
            $page['cache']  = false;
            break;
        case "my-requests":
            $page['vid']    = 'my-requests';
            $page['view']   = "my-requests";
            $page['inc']    = "my-requests";
            $page['cache']  = false;
            break;
        case "dashboard":
            $page['vid']    = 'dashboard';
            $page['view']   = "dashboard";
            $page['inc']    = "dashboard";
            $page['cache']  = false;
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
        case "v-signin":
            $page['vid']    = 'v-signin';
            $page['view']   = "v-signin";
            $page['cache']  = false;
            break;
        case "v-recoverPassword":
            $page['vid']    = 'v-recoverPassword';
            $page['view']   = "v-recover_password";
            $page['inc']    = "v-recover_password";
            $page['cache']  = false;
            break;
        case "v-signup":
            $page['vid']    = 'v-signup';
            $page['view']   = "v-signup";
            $page['inc']    = "v-signup";
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