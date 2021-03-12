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
        $vendor = new App\Core\simple_vendor();
        $this->data['active'] = $vendor->activate($email, $hash);
    }
