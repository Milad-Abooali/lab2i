<?php


/**
 * INC
 * Dashboard
 */
    namespace App\Core;

    $db = new i_sql(DB_INFO);

    $this->data['myShop'] = $db->selectId('vendor_shop', $_SESSION['M']['vendor']['id']);



    // Requests
    $this->data['requests'] = array(
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
        ),
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
    $this->data['requests_count']        = count($this->data['requests']);
