<?php


/**
 * INC
 * Dashboard
 */
    namespace App\Core;

    $db = new iSQL(DB_INFO);

    $this->data['myShop'] = $db->selectId('vendor_shop', $_SESSION['M']['vendor']['id']);


    // Database connection
    $db = new iSQL(DB_INFO);

    // Products
    $this->data['products'] = $db->selectAll('products');

    // Categories
    $categories = $db->selectAll('categories');
    foreach ($categories as $category) $this->data['categories'][$category['id']] = $category;

    // Tags
    $tags = $db->selectAll('tags');
    foreach ($tags as $tag) $this->data['tags'][$tag['id']] = $tag;
