<?php

/**
 * INC
 * Dashboard
 */

use App\Core\iSQL;
use App\Core\M;

    // Database connection
    $db = new iSQL(DB_INFO);

    // Tags
    $tags = $db->selectAll('tags');
    foreach ($tags as $tag) $this->data['tags'][$tag['id']] = $tag;


    if ($_POST ?? false) {
        $insert['user_id'] = $_SESSION['M']['user']['id'];
        $insert['title'] = $_POST['title'];
        if ($_POST['date']=='on') {
            $insert['start'] = $_POST['start'];
            $insert['end'] = $_POST['end'];
        }
        if ($_POST['price']=='on') {
            $insert['ask'] = $_POST['ask'];
            $insert['max'] = $_POST['max'];
        }
        $insert['quantity'] = $_POST['quantity'];
        $insert['expire'] = $_POST['expire'];
        $insert['description'] = base64_encode($_POST['description']);
        $insert['tags'] = implode(',',$_POST['tags']);

        $this->data['insert_id'] = $db->insert('products', $insert);


        if($this->data['insert_id']) {

            // Update Tag Counter
            if($_POST['tags'] ?? false) {
                foreach($_POST['tags'] as $tag) {
                    $where = "id=$tag";
                    $db->increase('tags','count_p', $where);
                }
            }

            // Upload Feature Image
            if($_FILES['image'] ?? false) {
                $count_image = count($_FILES['image']['name']);
                for($i=0;$i<$count_image;$i++) {
                    $filename = $i.'.jpg';
                    $dir_path = APP_ROOT.'/cdn/upload/requests/'.$this->data['insert_id'];
                    if (!is_dir($dir_path)) mkdir($dir_path);
                    $location = $dir_path.'/'.$filename;
                    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
                    $valid_extensions = array("jpg","jpeg","png");
                    if (in_array(strtolower($imageFileType),$valid_extensions)) if (move_uploaded_file($_FILES['image']['tmp_name'][$i],$location)) continue;
                }
            }

            header("Location: ".APP_URL.'my-requests');
        } else {
            $this->data['error'] = 'Error!';
        }

        M::print($db->log());
    }