<?php

/**
 * INC
 * Dashboard
 */

use App\Core\iSQL;

if(is_user) {
        $this->data['account_type'] = 'user';
    } else if (is_vendor) {
        $this->data['account_type'] = 'vendor';
    }

    // Requests
    $db = new iSQL(DB_INFO);
    $where = 'user_id='.$_SESSION['M'][$this->data['account_type']]['id'];
    $this->data['transactions'] = $db->select('log_email',$where,'id,subject,send_date');