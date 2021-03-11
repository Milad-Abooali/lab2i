<?php

/**
 * INC
 * Dashboard
 */

use App\Core\iSQL;
use App\Core\M;

    // Database connection
    $db = new iSQL(DB_INFO);

    // Requests
    $this->data['Requests'] = $db->selectAll('requests');

    // Tags
    $tags = $db->selectAll('tags');
    foreach ($tags as $tag) $this->data['tags'][$tag['id']] = $tag;

    // shops
    $vendor_shop = $db->selectAll('vendor_shop');
    foreach ($vendor_shop as $shop) $this->data['vendor_shop'][$shop['id']] = $shop;