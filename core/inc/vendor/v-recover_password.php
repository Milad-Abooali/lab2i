<?php

/**
 * INC
 * Recover Password
 */

    $hash      = ($_GET['h']) ?? false;
    $email     = ($_GET['i']) ?? false;

    if ($hash && $email){
        $this->data['rec_pass'] = true;
        $vendor = new App\Core\simple_vendor();
        if ($vendor->recoverCheck($email,$hash)) {
            $this->data['reset_pass'] = true;
        } else {

        }
    }
