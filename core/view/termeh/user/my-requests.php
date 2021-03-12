<?php

use App\Core\M;

$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'My Requests';
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
        <?php if (is_user): ?>

            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <?php include_once $this->PATH."widgets/profile-menu.php"; ?>
                    </div>
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">My Requests</h4>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <p class="text-left">
                                You have <strong><?= $this->data['requests_count'] ?></strong> orders.
                        </div>
                        <div class="container">
                            <ul class="list-inline row">
                                <?php if ($this->data['requests']) foreach ($this->data['requests'] as $item) { ?>
                                    <li class="col-md-6 small mb-3 px-2">
                                        <?php \App\Core\m::print($item); ?>
                                        <a href="request&id=<?= $item['id'] ?>" class="btn btn-primary">Show</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <script>

        $( document ).ready(function() {


        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>