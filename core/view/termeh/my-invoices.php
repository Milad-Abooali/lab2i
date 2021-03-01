<?php

use App\Core\M;

$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'My Invoices';
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
                            <h4 class="text-right">My Invoices</h4>
                        </div>
                        <div class="container">
                            <table id="Invoices" class="table table-sm table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Request</th>
                                    <th>Transaction</th>
                                    <th>Date Created</th>
                                    <th>Date Paid</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($this->data['invoices']) foreach ($this->data['invoices'] as $item) { ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td>$ <?= $item['amount'] ?></td>
                                    <td><a class="btn-link" target="_blank" href="request-<?= $item['request'] ?>"><?= $item['request'] ?></a> <sup><i class="fa fa-external-link text-secondary small"></i></sup></td>
                                    <td><a class="btn-link"><?= $item['transaction'] ?></a></td>
                                    <td><?= $item['date_created'] ?></td>
                                    <td class="text-success"><?= $item['date_paid'] ?></td>
                                    <td>
                                    <?php if($item['date_paid']){ ?>
                                        <span class="btn btn-sm btn-block btn-outline-success disabled">Paid</span>
                                    <?php } else { ?>
                                        <a href="invoice-<?= $item['id'] ?>" class="btn btn-sm btn-block btn-primary">Pay Now</a>
                                    <?php } ?>
                                    </td>
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
            $('#Invoices').DataTable();

        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>