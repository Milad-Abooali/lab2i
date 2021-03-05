<?php

/**
 * INC
 * Dashboard
 */

use App\Core\iSQL;
use App\Core\M;

    // Database connection
    $db = new iSQL(DB_INFO);

    // Tags
    $this->data['tags'] = $db->selectAll('tags');

    // List forms
    $this->data['forms'] = scandir(APP_ROOT.'/core/inc/instances-forms');
    unset($this->data['forms'][0], $this->data['forms'][1]);

    // Categories
    $this->data['categories'] = $db->selectAll('categories');

    /**
     *  Add new category
     */
    if ($_POST ?? false){
        $insert['title'] = $_POST['title'];
        $insert['excerpt'] = $_POST['excerpt'];
        if($_POST['tags'] ?? false) $insert['tags'] = implode(',',$_POST['tags']);
        $insert['form'] = $_POST['form'];
        $insert['commission_type'] = $_POST['commission_type'];
        $insert['commission_fee'] = $_POST['commission_fee'];
        $insert['highlight'] = isset($_POST['highlight']);
        $insert['image'] = isset($_POST['image']);
        $insert['video'] = isset($_POST['video']);
        $insert['date_range'] = isset($_POST['date_range']);
        $insert['discount'] = isset($_POST['discount']);
        $insert['auto_offer'] = isset($_POST['auto_offer']);
        $this->data['insert_id'] = $db->insert('categories', $insert);
    }