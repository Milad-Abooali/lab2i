<?php

use App\Core\M;

$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'My Transactions';
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
                            <h4 class="text-right">My Transactions</h4>
                        </div>
                        <div class="container">
                            <table id="Transaction" class="table table-sm table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Alt ID</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Source</th>
                                    <th>Destination</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($this->data['transactions']) foreach ($this->data['transactions'] as $item) { ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= $item['alt_id'] ?></td>
                                    <td>$ <?= $item['amount'] ?></td>
                                    <td>
                                        <?php
                                        if (is_int($item['detail'])) {
                                            echo '<a target="_blank" class="btn-link" href="invoice-'.$item['detail'].'">Invoice #'.$item['detail'].'</a> <sup><i class="fa fa-external-link text-secondary small"></i></sup>';
                                        } else {
                                            echo $item['detail'];
                                        }
                                        ?>
                                    </td>
                                    <td><?= $item['source'] ?></td>
                                    <td><?= $item['destination'] ?></td>
                                    <td><?= ($item['status']) ? '<span class="text-success">Done</span>' : '<span class="text-danger">Failed</span>' ?></td>
                                    <td><?= $item['date'] ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <script>

        $( document ).ready(function() {

            //  Data Table - Transaction
            $('#Transaction').DataTable();

        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>