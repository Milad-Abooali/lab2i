<?php

/**
 * INC
 * Dashboard
 */

use App\Core\i_sql;
use App\Core\M;

    // Database connection
    $db = new i_sql(DB_INFO);

    // Request
    $id = $_GET['id'] ?? 0;
    $this->data['request'] = $db->selectID('requests', $id);

    if($this->data['request']['invoice_id']){
        $this->data['invoice'] = $db->selectID('invoices', $this->data['request']['invoice_id']);
    }

    // Offers
    $where = 'request_id='.$id;
    $offers = $db->select('request_offers',$where);
    if($offers) foreach ($offers as $offer) $this->data['offers'][$offer['id']] = $offer;

    // Tags
    $tags = $db->selectAll('tags');
    if($tags) foreach ($tags as $tag) $this->data['tags'][$tag['id']] = $tag;

    // shops
    $vendor_shop = $db->selectAll('vendor_shop');
    if($vendor_shop) foreach ($vendor_shop as $shop) $this->data['vendor_shop'][$shop['id']] = $shop;