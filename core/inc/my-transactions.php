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
    $this->data['transactions'] = array(
        array(
            'id' => 112,
            'alt_id' => 'dsf23434df',
            'amount' => 12,
            'detail' => 4564,
            'source' => 'Bank Account',
            'destination' => 'Website',
            'status' => 1,
            'date' => '2020/12/29',
        ),
        array(
            'id' => 73,
            'alt_id' => '324324',
            'amount' => 9,
            'detail' => 'Refound',
            'source' => 'Website',
            'destination' => 'Bank Account',
            'status' => 1,
            'date' => '2020/12/29',
        ),
        array(
            'id' => 22,
            'alt_id' => 'B34Cdf9/34d',
            'amount' => 2,
            'detail' => 5481,
            'source' => 'Paypal',
            'destination' => 'Website',
            'status' => 0,
            'date' => '2020/12/29',
        )
    );