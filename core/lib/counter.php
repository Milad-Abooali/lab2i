<?php
/**
 * Class Counter
 *
 * Mahan | Core counter
 *
 * @package    App\Core
 * @author     Milad Abooali <m.abooali@hotmail.com>
 * @copyright  2012 - 2020 Codebox
 * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
 * @version    1.0.0
 */

    namespace App\Core;

    if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');

    class Counter
    {

        protected $count;

        /**
         * Counter constructor.
         */
        function __construct($start=0) {
            $this->count = $start;
        }

        /**
         * Counter start point
         * @param int $input
         * @return int
         */
        public function startFrom ($input) {
            $this->count = $input;
            return $this->count;
        }

        /**
         * Count plus
         * @param int $count
         * @return int
         */
        public function countP ($count=1) {
            $this->count = $this->count + $count;
            return $this->count;
        }

        /**
         * Count minus
         * @param int $count
         * @return int
         */
        public function countM ($count=1) {
            $this->count = $this->count - $count;
            return $this->count;
        }

    }