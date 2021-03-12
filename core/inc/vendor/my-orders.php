<?php


/**
 * INC
 * Dashboard
 */
    namespace App\Core;

    $db = new i_sql(DB_INFO);

    $this->data['myShop'] = $db->selectId('vendor_shop', $_SESSION['M']['vendor']['id']);

