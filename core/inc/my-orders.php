<?php


/**
 * INC
 * Dashboard
 */
    namespace App\Core;

    $db = new iSQL(DB_INFO);

    $this->data['myShop'] = $db->selectId('vendor_shop', $_SESSION['M']['vendor']['id']);

