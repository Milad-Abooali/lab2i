<?php
/**
 * Index
 *
 * Mahan | Application index.
 *
 * @package    App
 * @author     Milad Abooali <m.abooali@hotmail.com>
 * @copyright  2012 - 2020 Codebox
 * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
 * @version    1.0.0
 */

    namespace App;

    define("START", microtime(true));
    (file_exists('./core/core.php')) ? require_once('./core/core.php') : die("[0] Error: core");
