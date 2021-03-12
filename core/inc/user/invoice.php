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
    $id = $_GET['id'] ?? 0;
    $this->data['invoice'] = $db->selectId('invoices',$id);


    if ($this->data['invoice']['transaction_id']) {
        // Transaction
        $this->data['transaction'] = $db->selectId('transactions', $this->data['invoice']['transaction_id']);
    }