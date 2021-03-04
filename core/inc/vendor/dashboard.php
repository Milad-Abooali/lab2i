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

    $this->data['requests_card'] = array(
       array(
            'id' => 314123,
            'views' => 2763,
            'title' => 'Title',
            'category' => 'category',
            'offer_count' => 27,
            'offers_best' => 950,
            'expire_date' => '2020/12/29',
        ),
        array(
            'id' => 314123,
            'views' => 2763,
            'title' => 'Title',
            'category' => 'category',
            'offer_count' => 27,
            'offers_best' => 950,
            'expire_date' => '2020/12/29',
        )
    );