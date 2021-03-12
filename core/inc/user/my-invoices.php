<?php

/**
 * INC
 * Dashboard
 */
    use App\Core\i_sql;
    use App\Core\M;

    // Database connection
    $db = new i_sql(DB_INFO);

    if(is_user) {
        $this->data['account_type'] = 'User';
    } else if (is_vendor) {
        $this->data['account_type'] = 'Vendor';
    }

    // Invoices
    $this->data['invoices'] = $db->selectAll('invoices');