<?php
/**
 * Class tags
 *
 * Mahan | Ajax Class tags
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

// Add new tags
function add() {
    $output = new stdClass();
    $output->e = !(($_POST['tag']) ?? false);
    if ($output->e == false) {
        $tags = new tags();
        $output->res = $tags->add($_POST['tag']);
    }
    echo json_encode($output);
}

// Update Tags
function update() {
    $output = new stdClass();
    $output->e = !(($_POST['id']) ?? false);
    $output->e = !(($_POST['tag']) ?? false);
    if ($output->e == false) {
        $tags = new tags();
        $output->res = $tags->update($_POST['id'], $_POST['tag']);
    }
    echo json_encode($output);
}


// Delete Tags
function delete() {
    $output = new stdClass();
    $output->e = !(($_POST['id']) ?? false);
    if ($output->e == false) {
        $tags = new tags();
        $output->res = $tags->delete($_POST['id']);
    }
    echo json_encode($output);
}