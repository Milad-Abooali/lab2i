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

        <div id="stepperForm" class="bs-stepper linear">
            <div class="bs-stepper-header" role="tablist">
                <div class="step active" data-target="#test-form-1">
                    <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger1" aria-controls="test-form-1" aria-selected="true">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Email</span>
                    </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-form-2">
                    <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger2" aria-controls="test-form-2" aria-selected="false" disabled="disabled">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Password</span>
                    </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-form-3">
                    <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger3" aria-controls="test-form-3" aria-selected="false" disabled="disabled">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Validate</span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <form class="needs-validation was-validated" onsubmit="return false" novalidate="">
                    <div id="test-form-1" role="tabpanel" class="bs-stepper-pane fade active dstepper-block" aria-labelledby="stepperFormTrigger1">
                        <div class="form-group">
                            <label for="inputMailForm">Email address <span class="text-danger font-weight-bold">*</span></label>
                            <input id="inputMailForm" type="email" class="form-control" placeholder="Enter email" required="">
                            <div class="invalid-feedback">Please fill the email field</div>
                        </div>
                        <button class="btn btn-primary btn-next-form">Next</button>
                    </div>
                    <div id="test-form-2" role="tabpanel" class="bs-stepper-pane fade dstepper-none" aria-labelledby="stepperFormTrigger2">
                        <div class="form-group">
                            <label for="inputPasswordForm">Password <span class="text-danger font-weight-bold">*</span></label>
                            <input id="inputPasswordForm" type="password" class="form-control" placeholder="Password" required="">
                            <div class="invalid-feedback">Please fill the password field</div>
                        </div>
                        <button class="btn btn-primary btn-next-form">Next</button>
                    </div>
                    <div id="test-form-3" role="tabpanel" class="bs-stepper-pane fade text-center dstepper-none" aria-labelledby="stepperFormTrigger3">
                        <button type="submit" class="btn btn-primary mt-5">Submit</button>
                    </div>
                </form>
            </div>
        </div>

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
