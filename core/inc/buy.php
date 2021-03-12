<?php

/**
 * INC
 * Dashboard
 */

use App\Core\iSQL;
use App\Core\M;

    // Database connection
    $db = new iSQL(DB_INFO);

    // Products
    $id = $_GET['id'] ?? 0;
    $this->data['product'] = $db->selectId('products',$id);

    // shops
    $this->data['vendor_shop'] = $db->selectId('vendor_shop',$this->data['product']['shop_id']);

    // Categories
    $this->data['category'] = $db->selectId('categories',$this->data['product']['category']);

    // Tags
    $where = 'id IN ('.$this->data['product']['tags'].')';
    $tags = $db->select('tags', $where);
    foreach ($tags as $tag) $this->data['tags'][$tag['id']] = $tag;

