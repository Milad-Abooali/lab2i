<?php

use App\Core\M;

$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Privacy & Security';
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
    <?php if (is_user){ ?>

        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <?php include_once $this->PATH."widgets/profile-menu.php"; ?>
                </div>
                <div class="col-md-9">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Privacy & Security</h4>
                    </div>
                    <div class="container">

                    </div>
                </div>
            </div>
        </div>
    <?php }; ?>

</main>

<script>

    $( document ).ready(function() {

        //  Data Table - Transaction
        $('#Invoices').DataTable();

    });

</script>

<?php include_once $this->PATH."global/footer.php"; ?>


