<?php


/**
 * INC
 * Dashboard
 */
    namespace App\Core;

    $db = new iSQL(DB_INFO);

    // Categories.
    $categories_id = $_GET['category'];
    $this->data['categories'] = $db->selectid('categories', $categories_id);

    // Tags
    $tags = $db->selectAll('tags');
    foreach ($tags as $tag) $this->data['tags'][$tag['id']] = $tag;
