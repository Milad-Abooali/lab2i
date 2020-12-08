<?php


    $hash   = ($_GET['h']) ?? false;
    $id     = ($_GET['i']) ?? false;

    if ($hash && $id){
        $user = new App\Core\SimpleUser();
        if ($user->recoverCheck($id,$hash)) {
            $this->data['reset_pass'] = true;
        }
    }
