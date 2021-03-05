<?php
/**
 * Class F
 *
 * Mahan | Static Functions
 *
 * @package    App\Core
 * @author     Milad Abooali <m.abooali@hotmail.com>
 * @copyright  2012 - 2020 Codebox
 * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
 * @version    1.0.0
 */

    namespace App\Core;

    if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');

    class F
    {

        /**
         * iSQL - Object
         * @return iSQL
         */
        public static function DB() {
            return $db = new iSQL(DB_INFO);
        }


        /**
         * simpleUser - Get User
         * @param $id
         * @return bool
         */
        public static function getUserByID($id) {
            $user = new simpleUser();
            return $user->getId($id);
        }

        /**
         * Status Checker
         * @return void
         */
        public static function status($input) {
            echo ($input) ? '<i class="fa fa-check-circle text-success"></i>' : '<i class="fa fa-exclamation-circle text-danger"></i>';
        }
    }