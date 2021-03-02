<?php
/**
 * Class vendor
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

    // Logout
    function signout() {
        $output = new stdClass();

        $output->e = false;

        $vendor = new SimpleVendor();
        $output->res = $vendor->signout();

        echo json_encode($output);
    }

    // Login
    function signin() {
        $output = new stdClass();

        $output->e = !(($_POST['email']) ?? false);
        $output->e = !(($_POST['password']) ?? false);

        if ($output->e == false) {
            $vendor = new SimpleVendor();
            $output->res = $vendor->signin($_POST['email'],$_POST['password']);
        }
        echo json_encode($output);
    }

    // Password Recovery
    function recoverPass() {
        $output = new stdClass();

        $output->e = !(($_POST['email']) ?? false);

        if ($output->e == false) {
            $vendor = new SimpleVendor();
            $output->res = $vendor->recoverPass($_POST['email']);
        }
        echo json_encode($output);
    }

    // Rest Password
    function restPass() {
        $output = new stdClass();

        $output->e = !(($_POST['i']) ?? false);

        if ($output->e == false) {
            $vendor = new SimpleVendor();
            $output->res = $vendor->changePass($_POST['i'],$_POST['password']);
        }
        echo json_encode($output);
    }

    // SignUp
    function signup() {
        $output = new stdClass();

        $output->e = ( (($_POST['fname']) ?? false) && (strlen($_POST['fname']) > 2) ) ? false : 'First name';
        $output->e = ( (($_POST['lname']) ?? false) && (strlen($_POST['lname']) > 2) ) ? false : 'Last name';
        $output->e = ( (($_POST['phone']) ?? false) && (strlen($_POST['phone']) > 9) ) ? false : 'Phone Number';
        $output->e = ( (($_POST['email']) ?? false) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ) ? false : 'Email';
        $output->e = ( (($_POST['password']) ?? false) && (strlen($_POST['password']) > 5) ) ? false : 'Password';
        $output->e = ( (($_POST['address']) ?? false) && (strlen($_POST['address']) > 9) ) ? false : 'Address';

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
                $vendor = new SimpleVendor();
                $map_data = $_POST['lat'].','.$_POST['lng'];
                $output->res = $vendor->signup($_POST['email'],$_POST['password'],$_POST['fname'],$_POST['lname'],$_POST['phone'],$map_data,$_POST['address'],$extra);
            }
        }
        echo json_encode($output);
    }

    // Update Account
    function update() {
        $output = new stdClass();

        $output->e = ( ($_POST['id']) ?? false ) ? false : 'ID';
        $output->e = ( (($_POST['fname']) ?? false) && (strlen($_POST['fname']) > 2) ) ? false : 'First name';
        $output->e = ( (($_POST['lname']) ?? false) && (strlen($_POST['lname']) > 2) ) ? false : 'Last name';
        $output->e = ( (($_POST['phone']) ?? false) && (strlen($_POST['phone']) > 9) ) ? false : 'Phone Number';
        $output->e = ( (($_POST['email']) ?? false) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ) ? false : 'Email';
        $output->e = ( (($_POST['address']) ?? false) && (strlen($_POST['address']) > 9) ) ? false : 'Address';

        if ($output->e == false) {
            if ($output->e == false) {
                $vendor = new SimpleVendor();
                $output->res = $vendor->update($_POST['id'], $_POST['email'], $_POST['fname'], $_POST['lname'], $_POST['phone'], $_POST['address']);
            }
        }
        echo json_encode($output);
    }

    // Shop Settings
    function settings (){
        $output = new stdClass();

        $db = new iSQL(DB_INFO);

        if($_POST['id'] ?? false) {
            $output->res = $db->updateId('vendor_shop', $_POST['id'], $_POST);
        } else {
            $_POST['id'] = $_SESSION['M']['vendor']['id'];
            $output->res = $db->insert('vendor_shop', $_POST);
        }

        echo json_encode($output);
    }