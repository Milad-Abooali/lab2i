<?php

/**
 * INC
 * Dashboard
 */

use App\Core\i_sql;

    // Requests
    $db = new i_sql(DB_INFO);
    $this->data['tags'] = $db->selectAll('tags');