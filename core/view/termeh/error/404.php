<?php


$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = '403 - Forbidden';
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

    <main role="main" class="container">

        404 - Not found
        <hr>

    <?php if($_GET['y'] ?? false) { ?>
        <div class="alert alert-danger">
            <?= $_GET['y'] ?? false ?>
        </div>
    <?php } ?>
    </main>

    <script>

        $( document ).ready(function() {


        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>