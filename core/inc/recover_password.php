<?php

/**
 * INC
 * Recover Password
 */

    $hash      = ($_GET['h']) ?? false;
    $email     = ($_GET['i']) ?? false;

    if ($hash && $email){
        $this->data['rec_pass'] = true;
        $user = new App\Core\SimpleUser();
        if ($user->recoverCheck($email,$hash)) {
            $this->data['reset_pass'] = true;
        } else {

        }
    }
