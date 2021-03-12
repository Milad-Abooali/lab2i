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

    // Requests
    $where = 'user_id='.$_SESSION['M']['user']['id'];
    $this->data['requests'] = $db->select('requests',$where);
    $this->data['requests_count']        = count($this->data['requests']);
