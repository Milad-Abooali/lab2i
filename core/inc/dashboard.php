<?php

/**
 * INC
 * Dashboard
 */

    USE App\Core\iSQL;

    // Check user type
    $user = ($_SESSION['M']['user']) ?? false;
    $vendor = ($_SESSION['M']['vendor']) ?? false;

    $db = new iSQL(DB_INFO);

    $db->ver();

    if($user) {
        $this->data['test'] = 1;
    }

    if ($vendor) {
        $this->data['test'] = 1;

    }

