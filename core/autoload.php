<?php
/**
 * Class Loader
 *
 * Mahan | Autoloader for Lib,Inc
 *
 * @package    App\Core
 * @author     Milad Abooali <m.abooali@hotmail.com>
 * @copyright  2012 - 2020 Codebox
 * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
 * @version    1.0.0
 */

    namespace App\Core;

    if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');

    class Loader
    {

        /**
         * Loader Lib
         * @param string $className
         * @return bool
         */
        public static function lib($className) {
            M::aLog('loader','Call "'.$className.'"',0,'lib');
            $file = str_replace('app\core', '', strtolower($className));
            $path = APP_ROOT.'core/lib'.str_replace('\\', '/', $file).'.php';
            if (file_exists($path)) {
                /** @noinspection PhpIncludeInspection */
                include $path;
                M::aLog('loader',"Load <b style='color: #003399'>$path</b>",0,'lib');
                return true;
            } else {
                M::aLog('loader',"Load <b style='color: #003399'>$path</b>",1,'lib');
                return false;
            }
        }

        /**
         * Loader Inc
         * @param $className
         * @return bool
         */
        public static function inc($className) {
            M::aLog('loader','Call "'.$className.'"',0,'inc');
            $file = str_replace('app\core\inc', '', strtolower($className));
            $path = APP_ROOT.'core/inc/core'.str_replace('\\', '/', $file).'.php';
            if (file_exists($path)) {
                /** @noinspection PhpIncludeInspection */
                include $path;
                M::aLog('loader',"Load <b style='color: #003399'>$path</b>",0,'inc');
                return true;
            } else {
                M::aLog('loader',"Load <b style='color: #003399'>$path</b>",1,'inc');
                return false;
            }
        }

    }