<?php

/**
 * INC
 * Dashboard
 */

use App\Core\iSQL;

// Requests
    $db = new iSQL(DB_INFO);
    $this->data['tags'] = $db->selectAll('tags');


    $this->data['forms'] = scandir(APP_ROOT.'/core/inc/instances-forms');
    unset($this->data['forms'][0],$this->data['forms'][1]);
