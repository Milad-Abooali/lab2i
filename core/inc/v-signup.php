<?php

/**
 * INC
 * Register
 */

    $hash      = ($_GET['h']) ?? false;
    $email     = ($_GET['i']) ?? false;
    $this->data['activate'] = false;

    if ($hash && $email){
        $this->data['activate'] = true;
        $user = new App\Core\SimpleUser();
        $this->data['active'] = $user->activate($email, $hash);
    }
