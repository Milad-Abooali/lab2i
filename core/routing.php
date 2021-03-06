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
                case "admin/list-users":
                    $page['vid']    = 'admin/list-users';
                    $page['view']   = 'admin/list-users';
                    $page['inc']    = 'admin/list-users';
                    $page['cache']  = false;
                    break;
                case "admin/reviews":
                    $page['vid']    = 'admin/reviews';
                    $page['view']   = 'admin/reviews';
                    $page['inc']    = 'admin/reviews';
                    $page['cache']  = false;
                    break;
                case "admin/list-vendors":
                    $page['vid']    = 'admin/list-vendors';
                    $page['view']   = 'admin/list-vendors';
                    $page['inc']    = 'admin/list-vendors';
                    $page['cache']  = false;
                    break;
                case "admin/settings":
                    $page['vid']    = 'admin/settings';
                    $page['view']   = 'admin/settings';
                    $page['inc']    = 'admin/settings';
                    $page['cache']  = false;
                    break;
                case "admin/tags":
                    $page['vid']    = 'admin/tags';
                    $page['view']   = 'admin/tags';
                    $page['inc']    = 'admin/tags';
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
            $page['vid']    = 'vendor/v-signin';
            $page['view']   = "vendor/v-signin";
            $page['cache']  = false;
            break;
        case "v-recoverPassword":
            $page['vid']    = 'vendor/v-recoverPassword';
            $page['view']   = "vendor/v-recover_password";
            $page['inc']    = "vendor/v-recover_password";
            $page['cache']  = false;
            break;
        case "v-signup":
            $page['vid']    = 'vendor/v-signup';
            $page['view']   = "vendor/v-signup";
            $page['inc']    = "vendor/v-signup";
            $page['cache']  = false;
            break;
        case "account":
            if (!isset($_SESSION['M']['vendor'])) header("Location: ".APP_URL."403&y=Vendor permission needed!");
            $page['vid']    = 'vendor/account';
            $page['view']   = "vendor/account";
            $page['inc']    = null;
            $page['cache']  = false;
            break;
        case "my-shop":
            if (!isset($_SESSION['M']['vendor'])) header("Location: ".APP_URL."403&y=Vendor permission needed!");
            $page['vid']    = 'vendor/my-shop';
            $page['view']   = "vendor/my-shop";
            $page['inc']    = "vendor/my-shop";
            $page['cache']  = false;
            break;
        case "my-offers":
            if (!isset($_SESSION['M']['vendor'])) header("Location: ".APP_URL."403&y=Vendor permission needed!");
            $page['vid']    = 'vendor/my-offers';
            $page['view']   = "vendor/my-offers";
            $page['inc']    = "vendor/my-offers";
            $page['cache']  = false;
            break;
        case "my-orders":
            if (!isset($_SESSION['M']['vendor'])) header("Location: ".APP_URL."403&y=Vendor permission needed!");
            $page['vid']    = 'vendor/my-orders';
            $page['view']   = "vendor/my-orders";
            $page['inc']    = "vendor/my-orders";
            $page['cache']  = false;
            break;
        case "reviews":
            if (!isset($_SESSION['M']['vendor'])) header("Location: ".APP_URL."403&y=Vendor permission needed!");
            $page['vid']    = 'vendor/reviews';
            $page['view']   = "vendor/reviews";
            $page['inc']    = "vendor/reviews";
            $page['cache']  = false;
            break;
        case "new-product":
            if (!isset($_SESSION['M']['vendor'])) header("Location: ".APP_URL."403&y=Vendor permission needed!");
            $page['vid']    = 'vendor/new-product';
            $page['view']   = "vendor/new-product";
            $page['inc']    = "vendor/new-product";
            $page['cache']  = false;
            break;
        case "new-offer":
            if (!isset($_SESSION['M']['vendor'])) header("Location: ".APP_URL."403&y=Vendor permission needed!");
            $page['vid']    = 'vendor/new-offer';
            $page['view']   = "vendor/new-offer";
            $page['inc']    = "vendor/new-offer";
            $page['cache']  = false;
            break;

// Client
        case "register":
            $page['vid']    = 'user/register';
            $page['view']   = "user/register";
            $page['inc']    = "user/register";
            $page['cache']  = false;
            break;
        case "login":
            $page['vid']    = 'user/login';
            $page['view']   = "user/login";
            $page['cache']  = false;
            break;
        case "recoverPassword":
            $page['vid']    = 'user/recoverPassword';
            $page['view']   = "user/recover_password";
            $page['inc']    = "user/recover_password";
            $page['cache']  = false;
            break;
        case "reset-password":
            $page['vid']    = 'user/reset-assword';
            $page['view']   = "user/reset-password";
            $page['inc']    = null;
            $page['cache']  = false;
            break;
        case "email-history":
            if (!isset($_SESSION['M']['user'])) header("Location: ".APP_URL."403&y=User permission needed!");
            $page['vid']    = 'user/email-history';
            $page['view']   = "user/email-history";
            $page['inc']    = "user/email-history";
            $page['cache']  = false;
            break;
        case "privacy":
            if (!isset($_SESSION['M']['user'])) header("Location: ".APP_URL."403&y=User permission needed!");
            $page['vid']    = 'user/privacy';
            $page['view']   = "user/privacy";
            $page['inc']   = "user/privacy";
            $page['cache']  = false;
            break;
        case "my-invoices":
            if (!isset($_SESSION['M']['user'])) header("Location: ".APP_URL."403&y=User permission needed!");
            $page['vid']    = 'user/my-invoices';
            $page['view']   = "user/my-invoices";
            $page['inc']    = "user/my-invoices";
            $page['cache']  = false;
            break;
        case "my-transactions":
            if (!isset($_SESSION['M']['user'])) header("Location: ".APP_URL."403&y=User permission needed!");
            $page['vid']    = 'user/my-transactions';
            $page['view']   = "user/my-transactions";
            $page['inc']    = "user/my-transactions";
            $page['cache']  = false;
            break;
        case "my-requests":
            if (!isset($_SESSION['M']['user'])) header("Location: ".APP_URL."403&y=User permission needed!");
            $page['vid']    = 'user/my-requests';
            $page['view']   = "user/my-requests";
            $page['inc']    = "user/my-requests";
            $page['cache']  = false;
            break;
        case "add-request":
            if (!isset($_SESSION['M']['user'])) header("Location: ".APP_URL."403&y=User permission needed!");
            $page['vid']    = 'user/add-request';
            $page['view']   = "user/add-request";
            $page['inc']    = "user/add-request";
            $page['cache']  = false;
            break;
        case "invoice":
            if (!isset($_SESSION['M']['user'])) header("Location: ".APP_URL."403&y=User permission needed!");
            $page['vid']    = 'user/invoice';
            $page['view']   = "user/invoice";
            $page['inc']    = "user/invoice";
            $page['cache']  = false;
            break;



// Shared
        case "request":
            $page['vid']    = 'request';
            $page['view']   = "request";
            $page['inc']    = "request";
            $page['cache']  = false;
            break;
        case "buy":
            $page['vid']    = 'buy';
            $page['view']   = "buy";
            $page['inc']    = "buy";
            $page['cache']  = false;
            break;
        case "dashboard":
            if (is_user) {
                $page['vid']    = 'user/dashboard';
                $page['view']   = "user/dashboard";
                $page['inc']    = "user/dashboard";
                $page['cache']  = false;
            } else if(is_vendor) {
                $page['vid']    = 'vendor/dashboard';
                $page['view']   = "vendor/dashboard";
                $page['inc']    = "vendor/dashboard";
                $page['cache']  = false;
            } else {
                if (!isset($_SESSION['M']['vendor']['admin'])) header("Location: ".APP_URL."403&y=Please Login!");
            }
            break;
        case "403":
            $page['vid']        = false;
            $page['upon']       = null;
            $page['inc']        = null;
            $page['view']       = 'error/403';
            $page['cache']      = false;
            break;
        case "home":    // Site Index/root
        case null:
        case "":
            $page['vid']    = 'home';
            $page['view']   = 'home';
            $page['cache']  = false;
        break;
        default:        // Not Found
            $page['vid']        = false;        // Page view ID/Name
            $page['upon']       = null;         // Page Upon File
            $page['inc']        = null;         // Page Inc File
            $page['view']       = 'error/404';  // Page view File
            $page['cache']      = false;        // Page Cache Overwrite
    }