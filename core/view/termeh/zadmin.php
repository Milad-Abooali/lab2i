<?php


$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Admin';
$this->data['PAGE']['keywords'] = 'test';
$this->data['PAGE']['description'] = 'test';
$this->data['PAGE']['robots'] = 1; // Null = Follow
$this->data['PAGE']['image'] = 'test';
$this->data['PAGE']['canonical'] = APP_URL;
$this->data['PAGE']['path'] = $this->page_path;
$this->data['PAGE']['amphtml'] = NULL;
$this->data['PAGE']['feed'] = NULL;

$this->data['PAGE']['head'] = ' ';


include_once $this->PATH."global/head.php";
include_once $this->PATH."global/header.php";
?>

<?php if (is_vendor && $_SESSION['M']['vendor']['admin']) { ?>
    <main role="main" class="container">
        <h6>Admin Panel
        <small class="float-right">
            <button class="btn btn-sm btn-primary"><i class="fa "></i>Save</button>
            <button class="btn btn-sm btn-outline-danger">Save</button>
        </small>
        </h6>
        <hr>
        <div class="row">
            <div class="col-md-3 border-right">
                <?php include_once $this->PATH."admin/sidebar.php"; ?>
            </div>
            <div class="col-md-9">
                page
            </div>
        </div>


    </main>

    <?php } ?>
    <script>

        $( document ).ready(function() {


        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>