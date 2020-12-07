<?php
/**
 * Class user
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

    function register() {
        $output = new stdClass();

        $output->e = ( (($_POST['fname']) ?? false) && (strlen($_POST['fname']) > 2) ) ? false : 'First name';
        $output->e = ( (($_POST['lname']) ?? false) && (strlen($_POST['lname']) > 2) ) ? false : 'Last name';
        $output->e = ( (($_POST['phone']) ?? false) && (strlen($_POST['phone']) > 9) ) ? false : 'Phone Number';
        $output->e = ( (($_POST['email']) ?? false) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ) ? false : 'Email';

        $output->e = ( (($_POST['password']) ?? false) && (strlen($_POST['password']) > 5) ) ? false : 'Password';

        if ($output->e == false) {

            $uppercase      = preg_match('@[A-Z]@', $_POST['password']);
            $lowercase      = preg_match('@[a-z]@', $_POST['password']);
            $number         = preg_match('@[0-9]@', $_POST['password']);
            $specialChars   = preg_match('@[^\w]@', $_POST['password']);
            $output->e = ($uppercase ?? false) ? false : 'Password Uppercase';
            $output->e = ($lowercase ?? false) ? false : 'Password Lowercase';
            $output->e = ($number ?? false) ? false : 'Password Number';
            $output->e = ($specialChars ?? false) ? false : 'Password SpecialChars';
            if ($output->e == false) {
                $user = new SimpleUser();
                $output->res = $user->register($_POST['email'],$_POST['password'],$_POST['fname'],$_POST['lname'],$_POST['phone']);
            }
        }
        echo json_encode($output);
    }