<?php

/**
 * INC
 * Dashboard
 */

use App\Core\iSQL;
use App\Core\M;

    // Database connection
    $db = new iSQL(DB_INFO);

    // Products
    $this->data['products'] = $db->selectAll('products');

    // Categories
    $this->data['categories'] = $db->selectAll('categories');

    // Tags
    $tags = $db->selectAll('tags');
    foreach ($tags as $tag) $this->data['tags'][$tag['id']] = $tag;

    /**
     *  Add new product
     */
    if ($_POST ?? false){
        $insert['title'] = $_POST['title'];
        $insert['excerpt'] = $_POST['excerpt'];
        if($_POST['tags'] ?? false) $insert['tags'] = implode(',',$_POST['tags']);
        $insert['form'] = $_POST['form'];
        $insert['commission_type'] = $_POST['commission_type'];
        $insert['commission_fee'] = $_POST['commission_fee'];
        $insert['highlight'] = isset($_POST['highlight']);
        $insert['image'] = isset($_POST['image']);
        $insert['video'] = isset($_POST['video']);
        $insert['date_range'] = isset($_POST['date_range']);
        $insert['discount'] = isset($_POST['discount']);
        $insert['auto_offer'] = isset($_POST['auto_offer']);
        $this->data['insert_id'] = $db->insert('categories', $insert);

        if($this->data['insert_id']) {

            // Update Tag Counter
            if($_POST['tags'] ?? false) {
                foreach($_POST['tags'] as $tag) {
                    $where = "id=$tag";
                    $db->increase('tags','count_c', $where);
                }
            }

            // Upload Feature Image
            if($_FILES['featuredImage'] ?? false) {

                    if (isset($_FILES['featuredImage']) && $_FILES['featuredImage']['error'] === UPLOAD_ERR_OK)
                    {
                        // get details of the uploaded file
                        $fileTmpPath = $_FILES['featuredImage']['tmp_name'];
                        $fileName = $_FILES['featuredImage']['name'];
                        $fileSize = $_FILES['featuredImage']['size'];
                        $fileType = $_FILES['featuredImage']['type'];
                        $fileNameCmps = explode(".", $fileName);
                        $fileExtension = strtolower(end($fileNameCmps));

                        // sanitize file-name
                        $newFileName = $this->data['insert_id'] . '.' . $fileExtension;

                        // check if file has one of the following extensions
                        $allowedfileExtensions = array('jpg', 'png', 'jpeg');

                        if (in_array($fileExtension, $allowedfileExtensions))
                        {
                            // directory in which the uploaded file will be moved
                            $uploadFileDir = APP_ROOT.'/cdn/upload/categories/';
                            $dest_path = $uploadFileDir . $newFileName;

                            if(move_uploaded_file($fileTmpPath, $dest_path))
                            {
                                $message ='File is successfully uploaded.';
                            }
                            else
                            {
                                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                            }
                        }
                        else
                        {
                            $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
                        }
                    }
                    else
                    {
                        $message = 'There is some error in the file upload. Please check the following error.<br>';
                        $message .= 'Error:' . $_FILES['featuredImage']['error'];
                    }
                    $this->data['upload_file'] = $message;
            }

        }

    }