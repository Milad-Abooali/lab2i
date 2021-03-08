<?php
/**
 * Class Products
 *
 * Mahan | Ajax Class Products
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

// Modal Maker
function MakeForm() {
    $error = !(($_POST['cat']) ?? false);
    if(!$error) {


        // Load Form
        $db = new iSQL(DB_INFO);
        $category = $db->selectId('categories', $_POST['cat']);

        // Load Options
?>

    <div class="bs-stepper">
        <div class="bs-stepper-header" role="tablist">
            <!-- your steps here -->
            <div class="step" data-target="#logins-part">
                <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                    <span class="bs-stepper-circle">1</span>
                    <span class="bs-stepper-label">Logins</span>
                </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#information-part">
                <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label">Various information</span>
                </button>
            </div>
        </div>
        <div class="bs-stepper-content">
            <!-- your steps content here -->
            <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger"></div>
            <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger"></div>
        </div>
    </div>
    <script src="bs-stepper.min.js"></script>
    <script>
        $(document).ready(function () {
            var stepper = new Stepper($('.bs-stepper')[0])
        })
    </script>


<?php
    } else {
        echo $error;
    }

}
