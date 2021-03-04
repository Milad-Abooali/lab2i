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

// Admin
        case "admin":
            if (!isset($_SESSION['M']['vendor']['admin'])) header("Location: ".APP_URL."403&y=Admin permission needed!");
            $page['vid']  = 'admin/'.array_shift($page['data']);
            switch ($page['vid']) {
                case "admin/settings":
                    $page['vid']    = 'admin/settings';
                    $page['view']   = 'admin/settings';
                    $page['inc']    = 'admin/settings';
                    $page['cache']  = false;
                    break;
                case "admin/categories":
                    $page['vid']    = 'admin/categories';
                    $page['view']   = 'admin/categories';
                    $page['inc']    = 'admin/categories';
                    $page['cache']  = false;
                    break;
                case "admin/products":
                    $page['vid']    = 'admin/products';
                    $page['view']   = 'admin/products';
                    $page['inc']    = 'admin/products';
                    $page['cache']  = false;
                    break;
                case "admin/list-vendors":
                    $page['vid']    = 'admin/list-vendors';
                    $page['view']   = "admin/list-vendors";
                    $page['inc']    = "admin/list-vendors";
                    $page['cache']  = false;
                    break;
                case "admin/verification":
                    $page['vid']    = 'admin/verification';
                    $page['view']   = 'admin/verification';
                    $page['inc']    = 'admin/verification';
                    $page['cache']  = false;
                    break;
                case "admin/users":
                    $page['vid']    = 'admin/users';
                    $page['view']   = 'admin/users';
                    $page['inc']    = 'admin/users';
                    $page['cache']  = false;
                    break;
                case "admin/active-tenders":
                    $page['vid']    = 'admin/active-tenders';
                    $page['view']   = 'admin/active-tenders';
                    $page['inc']    = 'admin/active-tenders';
                    $page['cache']  = false;
                    break;
                case "admin/tenders-archive":
                    $page['vid']    = 'admin/tenders-archive';
                    $page['view']   = 'admin/tenders-archive';
                    $page['inc']    = 'admin/tenders-archive';
                    $page['cache']  = false;
                    break;
                case "admin/invoices":
                    $page['vid']    = 'admin/invoices';
                    $page['view']   = 'admin/invoices';
                    $page['inc']    = 'admin/invoices';
                    $page['cache']  = false;
                    break;
                case "admin/transactions":
                    $page['vid']    = 'admin/transactions';
                    $page['view']   = 'admin/transactions';
                    $page['inc']    = 'admin/transactions';
                    $page['cache']  = false;
                    break;
                case "admin/pages":
                    $page['vid']    = 'admin/pages';
                    $page['view']   = 'admin/pages';
                    $page['inc']    = 'admin/pages';
                    $page['cache']  = false;
                    break;
                case "admin/":
                default:
                    $page['vid']    = 'admin/dashboard';
                    $page['view']   = "admin/dashboard";
                    $page['inc']    = "admin/dashboard";
                    $page['cache']  = false;
            }
            break;


// Vendor
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
        case "account":
            if (!isset($_SESSION['M']['vendor'])) header("Location: ".APP_URL."403&y=Vendor permission needed!");
            $page['vid']    = 'account';
            $page['view']   = "account";
            $page['inc']    = "account";
            $page['cache']  = false;
            break;
        case "my-shop":
            if (!isset($_SESSION['M']['vendor'])) header("Location: ".APP_URL."403&y=Vendor permission needed!");
            $page['vid']    = 'my-shop';
            $page['view']   = "my-shop";
            $page['inc']    = "my-shop";
            $page['cache']  = false;
            break;
        case "my-offers":
            if (!isset($_SESSION['M']['vendor'])) header("Location: ".APP_URL."403&y=Vendor permission needed!");
            $page['vid']    = 'my-offers';
            $page['view']   = "my-offers";
            $page['inc']    = "my-offers";
            $page['cache']  = false;
            break;
        case "my-orders":
            if (!isset($_SESSION['M']['vendor'])) header("Location: ".APP_URL."403&y=Vendor permission needed!");
            $page['vid']    = 'my-orders';
            $page['view']   = "my-orders";
            $page['inc']    = "my-orders";
            $page['cache']  = false;
            break;
        case "reviews":
            if (!isset($_SESSION['M']['vendor'])) header("Location: ".APP_URL."403&y=Vendor permission needed!");
            $page['vid']    = 'reviews';
            $page['view']   = "reviews";
            $page['inc']    = "reviews";
            $page['cache']  = false;
            break;



// Client
        case "register":
            $page['vid']    = 'register';
            $page['view']   = "register";
            $page['inc']    = "register";
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
        case "reset-password":
            $page['vid']    = 'reset-assword';
            $page['view']   = "reset-password";
            $page['inc']    = "recover_password";
            $page['cache']  = false;
            break;
        case "email-history":
            if (!isset($_SESSION['M']['user'])) header("Location: ".APP_URL."403&y=User permission needed!");
            $page['vid']    = 'email-history';
            $page['view']   = "email-history";
            $page['inc']    = "email-history";
            $page['cache']  = false;
            break;
        case "privacy":
            if (!isset($_SESSION['M']['user'])) header("Location: ".APP_URL."403&y=User permission needed!");
            $page['vid']    = 'privacy';
            $page['view']   = "privacy";
            $page['inc']   = "privacy";
            $page['cache']  = false;
            break;
        case "my-invoices":
            if (!isset($_SESSION['M']['user'])) header("Location: ".APP_URL."403&y=User permission needed!");
            $page['vid']    = 'my-invoices';
            $page['view']   = "my-invoices";
            $page['inc']    = "my-invoices";
            $page['cache']  = false;
            break;
        case "my-transactions":
            if (!isset($_SESSION['M']['user'])) header("Location: ".APP_URL."403&y=User permission needed!");
            $page['vid']    = 'my-transactions';
            $page['view']   = "my-transactions";
            $page['inc']    = "my-transactions";
            $page['cache']  = false;
            break;
        case "my-requests":
            if (!isset($_SESSION['M']['user'])) header("Location: ".APP_URL."403&y=User permission needed!");
            $page['vid']    = 'my-requests';
            $page['view']   = "my-requests";
            $page['inc']    = "my-requests";
            $page['cache']  = false;
            break;

// Shared
        case "dashboard":
            $page['vid']    = 'dashboard';
            $page['view']   = "dashboard";
            $page['inc']    = "dashboard";
            $page['cache']  = false;
            break;
        case null:
        case "403":
            $page['vid']        = false;
            $page['upon']       = null;
            $page['inc']        = null;
            $page['view']       = 'error/403';
            $page['cache']      = false;
            break;
        case null:
        case "home":    // Site Index/root
        case "":        // Site Index/root
            $page['vid']    = 'home';
            $page['view']   = 'home';
            $page['cache']  = false;
        break;

        default:        // Not Found
            $page['vid']        = false;        // Page View ID/Name
            $page['upon']       = null;         // Page Upon File
            $page['inc']        = null;         // Page Inc File
            $page['view']       = 'error/404';  // Page View File
            $page['cache']      = false;        // Page Cache Overwrite
    }