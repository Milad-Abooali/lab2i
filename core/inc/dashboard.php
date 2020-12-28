<?php

/**
 * INC
 * Dashboard
 */

    USE App\Core\F;
    USE App\Core\M;

    if(is_user) {
        $this->data['account_type'] = 'User';
    } else if (is_vendor) {
        $this->data['account_type'] = 'Vendor';
    }
