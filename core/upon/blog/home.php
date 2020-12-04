<?php
/**
 * Upon home
 *
 * Mahan | Process for test
 *
 * @package    App\Core
 * @author     Milad Abooali <m.abooali@hotmail.com>
 * @copyright  2012 - 2020 Codebox
 * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
 * @version    1.0.0
 */

    namespace App\Core;

    if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');


    $this->data['test'] = 'home_Inc';

    $users = new Counter($_SESSION['M']['users'] ?? 0);
    $_SESSION['M']['users'] = $users->countP();
    $this->data['count'] = $_SESSION['M']['users'];

    $db = new MySQL(DB_INFO);
    $db->ver();
    $db->setTable("test");

//    $array['name'] = session_name();
//    $array['sta5tus'] = $_SESSION['M']['users'];
//    $db->insert($array);

