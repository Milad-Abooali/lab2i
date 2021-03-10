<?php

/**
 * INC
 * Dashboard
 */

use App\Core\iSQL;
use App\Core\M;

    // Database connection
    $db = new iSQL(DB_INFO);

    // shops
    $this->data['vendor_shop'] = $db->selectAll('vendor_shop');
