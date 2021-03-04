<?php

/**
 * INC
 * Dashboard
 */

use App\Core\iSQL;

    // Requests
    $db = new iSQL(DB_INFO);
    $this->data['tags'] = $db->selectAll('tags');