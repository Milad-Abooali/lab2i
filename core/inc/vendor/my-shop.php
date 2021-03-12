<?php


/**
 * INC
 * Dashboard
 */
    namespace App\Core;

    $db = new i_sql(DB_INFO);

    $this->data['myShop'] = $db->selectId('vendor_shop', $_SESSION['M']['vendor']['id']);


    // Database connection
    $db = new i_sql(DB_INFO);

    // Products
    $where = 'shop_id='.$_SESSION['M']['vendor']['id'];
    $this->data['products'] = $db->select('products', $where);

    // Categories
    $categories = $db->selectAll('categories');
    foreach ($categories as $category) $this->data['categories'][$category['id']] = $category;

    // Tags
    $tags = $db->selectAll('tags');
    foreach ($tags as $tag) $this->data['tags'][$tag['id']] = $tag;
