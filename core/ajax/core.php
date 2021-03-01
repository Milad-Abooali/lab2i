<?php
/**
 * Class Core
 *
 * Mahan | Ajax Class Core
 *
 * @package    App\Core
 * @author     Milad Abooali <m.abooali@hotmail.com>
 * @copyright  2012 - 2020 Codebox
 * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
 * @version    1.0.0
 */

    namespace App\Core;

    if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');

    use stdClass;

    function def () {
        $output = new stdClass();
        $output->e = false;
        $output->res = true;
        echo json_encode($output);
    }

    // Email History
    function emailLog() {
        $output = new stdClass();
        $output->e = !(($_POST['id']) ?? false);
        $db = new iSQL(DB_INFO);
        $res = $db->selectId('log_email',$_POST['id'],'subject, content');
        $output->res['subject'] = $res['subject'];
        $content = str_replace("\r",'',$res['content']);
        $output->res['content'] = htmlspecialchars_decode(stripslashes($content));
        echo json_encode($output);
    }