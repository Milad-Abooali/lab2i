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
         * i_sql - Object
         * @return i_sql
         */
        public static function DB() {
            return $db = new i_sql(DB_INFO);
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
        public static function status($input,$type='ico') {
            if ($type=='ico') {
                echo ($input) ? '<i class="fa fa-check-circle text-success"></i>' : '<i class="fa fa-exclamation-circle text-danger"></i>';
            } elseif($type=='yn') {
                echo ($input) ? '<span class="text-success">Yes</span>' : '<span class="text-danger">No</span>';
            } elseif($type=='oo') {
                echo ($input) ? '<span class="text-success">On</span>' : '<span class="text-danger">Off</span>';
            } else {
                echo ($input) ? '<span class="text-success">True</span>' : '<span class="text-danger">False</span>';
            }
        }
    }