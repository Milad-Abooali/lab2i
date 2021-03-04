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

    // Requests
    $this->data['invoices'] = array(
        array(
            'id' => 112,
            'amount' => 12,
            'request' => 4564,
            'transaction' => 4564234324,
            'date_created' => '2020/12/29',
            'date_paid' => '2020/12/29',
        ),
        array(
            'id' => 112,
            'amount' => 12,
            'request' => 4564,
            'transaction' => null,
            'date_created' => '2020/12/29',
            'date_paid' => null,
        ),
        array(
            'id' => 112,
            'amount' => 12,
            'request' => 4564,
            'transaction' => 4564234324,
            'date_created' => '2020/12/29',
            'date_paid' => '2020/12/29',
        )
    );