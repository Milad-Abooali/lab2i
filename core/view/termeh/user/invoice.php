<?php

use App\Core\M;

$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Add Invoice';
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

            <link href="<?= CSS ?>v-menu.css" rel="stylesheet" />

        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">

                <div class="col-md-12">


                    <?php M::print($this->data['invoice']); ?>


                    <?php if ($this->data['invoice']['transaction_id']) { ?>
                        <?php M::print($this->data['transaction']); ?>
                    <?php } else { ?>
                        <select class="form-control" id="gateway" name="gateway">
                            <option value="1">Paypal</option>
                            <option value="3">Credit Card</option>
                        </select>
                        <button class="doM-payment btn btn-primary">Pay</button>
                    <?php } ?>

                </div>
            </div>
        </div>

    </main>

    <script>
        $( document ).ready(function() {

        });
    </script>

<?php include_once $this->PATH."global/footer.php"; ?>