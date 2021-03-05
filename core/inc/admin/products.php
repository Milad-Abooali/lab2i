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
    $this->data['products'] = $db->selectAll('products');

    // Categories
    $this->data['categories'] = $db->selectAll('categories');

    // Tags
    $tags = $db->selectAll('tags');
    foreach ($tags as $tag) $this->data['tags'][$tag['id']] = $tag;

    /**
     *  Add new product
     */
    if ($_POST ?? false){

        $insert['title'] = $_POST['title'];
        $insert['category'] = $_POST['category'];
        $this->data['insert_id'] = $db->insert('products', $insert);

    }