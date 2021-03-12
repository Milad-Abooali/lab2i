<?php
/**
 * Class Request
 *
 * Mahan | Ajax Class Request
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

    // Accept Offer
    function acceptOffer() {
        $output = new stdClass();
        $output->e = !(($_POST['id']) ?? false);
        if ($output->e == false) {
            $db = new iSQL(DB_INFO);
            $offer = $db->selectId('request_offers', $_POST['id']);
            // Update Request
            $update['status']=1;
            $update['offer_id']=$offer['id'];
            $update['vendor_id']=$offer['vendor_id'];
            $update_request = $db->updateId('requests', $offer['request_id'], $update);
            if ($update_request) {
                // Creat Invoice
                $rate = 0.2;
                $insert['user_id'] = $_SESSION['M']['user']['id'];
                $insert['request_id'] = $offer['request_id'];
                $insert['offer_id'] = $offer['id'];
                $insert['comission_rate'] = $rate;
                $insert['amount'] = $rate*$offer['price'];
                $insert_id = $db->insert('invoices', $insert);
                if ($insert_id) {
                    $update=array();
                    $update['invoice_id']=$insert_id;
                    $output->res = $db->updateId('requests', $offer['request_id'], $update);
                } else {
                    $output->e = "Error on creat invoice!";
                }
            } else {
                $output->e = "Error on request update!";
            }
        }
        echo json_encode($output);
    }


    // Buy
    function buy() {
        $output = new stdClass();
        $output->e = !(($_POST['id']) ?? false);
        if ($output->e == false) {
            $db = new iSQL(DB_INFO);
            $product = $db->selectId('products', $_POST['id']);

            // Add Order Request
            $order['user_id']= $_SESSION['M']['user']['id'];
            $order['vendor_id']= $product['shop_id'];
            $order['product_id']= $product['id'];
            $order['price']= $product['price'];
            $order_id = $db->insert('vendor_orders', $order);
            if ($order_id) {
                // Creat Invoice
                $rate = 0.2;
                $insert['user_id'] = $_SESSION['M']['user']['id'];
                $insert['request_id'] = $product['id'];
                $insert['offer_id'] = 0;
                $insert['comission_rate'] = $rate;
                $insert['amount'] = $rate*$product['price'];
                $invoice_id = $db->insert('invoices', $insert);
                if ($invoice_id) {
                    $update=array();
                    $update['invoice_id']=$invoice_id;
                    if ($db->updateId('vendor_orders', $order_id, $update)) {
                        $output->res = $invoice_id;
                    } else {
                        $output->e = "Error on add invoice!";
                    }
                } else {
                    $output->e = "Error on creat invoice!";
                }
            } else {
                $output->e = "Error on order!";
            }
        }
        echo json_encode($output);
    }