<?php

/**
 * INC
 * Dashboard
 */

    if(is_user) {
        $this->data['account_type'] = 'User';
    } else if (is_vendor) {
        $this->data['account_type'] = 'Vendor';
    }

    $this->data['interests'] = array();
    if ($_SESSION['M']['user']['interests'] ?? false) $this->data['interests'] = explode(',',$_SESSION['M']['user']['interests']);