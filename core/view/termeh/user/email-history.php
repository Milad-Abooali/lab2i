<?php

use App\Core\M;

$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Email History';
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
                            <h4 class="text-right">Email History</h4>
                        </div>
                        <div class="container">
                            <table id="email-history" class="table table-sm table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Sent Date</th>
                                    <th>View</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($this->data['transactions']) foreach ($this->data['transactions'] as $item) { ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= $item['subject'] ?></td>
                                    <td><?= $item['send_date'] ?></td>
                                    <td><button data-id="<?= $item['id'] ?>" class="btn btn-sm btn-info doA-showEmail">Show Message</button></td>
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
            $('#email-history').DataTable(
                {
                    "order": [[ 0, "desc" ]]
                }
            );

            $("body").on("click", "#email-history .doA-showEmail", function(event){
                let data = {
                    id:  $(this).data('id')
                };
                ajaxCall ('core/emailLog', data,function(response) {
                    let obj = JSON.parse(response);
                    (obj.e) && notify('Can not load email!','error',false);
                    if (obj.res) {
                        let content = obj.res.content;
                        makeModal('Subject: '+obj.res.subject,content,'lg');
                    }
                });
            });

        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>