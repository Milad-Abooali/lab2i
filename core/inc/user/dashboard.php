<?php

/**
 * INC
 * Dashboard
 */
    namespace App\Core;

    $db = new iSQL(DB_INFO);

    if(is_user) {
        $this->data['account_type'] = 'User';
    } else if (is_vendor) {
        $this->data['account_type'] = 'Vendor';
    }

    $this->data['interests'] = array();
    if ($_SESSION['M']['user']['interests'] ?? false) $this->data['interests'] = explode(',',$_SESSION['M']['user']['interests']);


    // Requests
    $where = 'user_id='.$_SESSION['M']['user']['id'];
    $this->data['requests_card'] = $db->select('requests',$where);