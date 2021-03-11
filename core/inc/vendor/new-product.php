<?php


/**
 * INC
 * Dashboard
 */
    namespace App\Core;

    $db = new iSQL(DB_INFO);

    // Categories.
    $categories_id = $_GET['category'];
    $this->data['categories'] = $db->selectid('categories', $categories_id);

    // Tags
    $tags = $db->selectAll('tags');
    foreach ($tags as $tag) $this->data['tags'][$tag['id']] = $tag;


    if ($_POST ?? false) {
        $insert['shop_id'] = $_SESSION['M']['vendor']['id'];
        $insert['title'] = $_POST['category'];
        $insert['excerpt'] = base64_encode($_POST['excerpt']);
        $insert['category'] = $categories_id;
        $insert['tags'] = implode(',',$_POST['tags']);
        $insert['price'] = $_POST['price'];

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
                    $dir_path = APP_ROOT.'/cdn/upload/products/'.$this->data['insert_id'];
                    if (!is_dir($dir_path)) mkdir($dir_path);
                    $location = $dir_path.'/'.$filename;
                    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
                    $valid_extensions = array("jpg","jpeg","png");
                    if (in_array(strtolower($imageFileType),$valid_extensions)) if (move_uploaded_file($_FILES['image']['tmp_name'][$i],$location)) continue;
                }
            }

            // Upload Feature Video
            if($_FILES['video'] ?? false) {
                $count_image = count($_FILES['video']['name']);
                for($i=0;$i<$count_image;$i++) {
                    $fileNameCmps = explode(".", $_FILES['video']['name'][$i]);
                    $filename = $i.'.'.strtolower(end($fileNameCmps));
                    $dir_path = APP_ROOT.'/cdn/upload/products/'.$this->data['insert_id'];
                    if (!is_dir($dir_path)) mkdir($dir_path);
                    $location = $dir_path.'/'.$filename;
                    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
                    $valid_extensions = array("flv","mp4","3gp","mov","wmv","avi","m3u8","mkv");
                    if (in_array(strtolower($imageFileType),$valid_extensions)) if (move_uploaded_file($_FILES['video']['tmp_name'][$i],$location)) continue;
                }
            }

            header("Location: ".APP_URL.'my-shop');
        } else {
            $this->data['error'] = 'Error!';
        }


    }