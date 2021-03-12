<?php

/**
 * INC
 * Dashboard
 */
    use App\Core\iSQL;
    use App\Core\M;

    // Database connection
    $db = new iSQL(DB_INFO);

    if(is_user) {
        $this->data['account_type'] = 'User';
    } else if (is_vendor) {
        $this->data['account_type'] = 'Vendor';
    }

    // Invoices
    $this->data['invoices'] = $db->selectAll('invoices');