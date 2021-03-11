<?php


$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Admin List Users';
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
        <h6><?= $this->data['PAGE']['title'] ?>
        <small class="float-right">

        </small>
        </h6>
        <hr>
        <div class="row">
            <div class="col-md-3 border-right">
                <?php include_once $this->PATH."admin/sidebar.php"; ?>
            </div>
            <div class="col-md-9">

                <table id="ProductsTable" class="table table-sm table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>birthday</th>
                            <th>interests</th>
                            <th>job</th>
                            <th>income</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>reg_date</th>
                            <th>extra</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($this->data['users']) foreach ($this->data['users'] as $item) { ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <td>
                                <i class="fa <?= ($item['gender']) ? 'fa-male text-primary' : 'fa-female text-warning' ?>"></i>
                                <?= $item['f_name'] ?> <?= $item['l_name'] ?></td>
                            <td><?= $item['birthday'] ?></td>
                            <td>
                                <?php
                                if($item['interests']) {
                                    $interests = explode(',',$item['interests']);
                                    foreach ($interests as $interest) echo '<span class="small badge-pill badge-info">'.$interest.'</span><br>';
                                }
                                ?>
                            </td>
                            <td><?= $item['job'] ?></td>
                            <td><?= $item['income'] ?></td>
                            <td><?= $item['Phone'] ?></td>
                            <td>
                                <?= $item['country'] ?>
                                <?= $item['region'] ?>
                                <?= $item['region'] ?>
                                <?= $item['address'] ?>
                                <?= $item['postcode'] ?>
                            </td>
                            <td><?= $item['reg_date'] ?></td>
                            <td>
                                <?php if ($item['extra']) { ?>
                                  <button class="doM-extra btn btn-sm btn-info float-right" data-id="<?= $item['id'] ?>">Show</button>
                                <?php } ?>
                            </td>

                            <td class="text-center">
                                <div class="custom-control custom-switch">
                                    <input data-id="<?= $item['id'] ?>" type="checkbox" class="doA-vendorStatus custom-control-input" id="status-<?= $item['id'] ?>" <?= ($item['status']) ? 'checked' : null ?> >
                                    <label class="custom-control-label" for="status-<?= $item['id'] ?>">Active</label>
                                </div>
                                <button class="doA-delete btn btn-sm btn-danger float-right" data-id="<?= $item['id'] ?>">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>


    </main>

    <?php } ?>
    <script>

        $( document ).ready(function() {

            //  Data Table - Transaction
            $('#ProductsTable').DataTable();

            //  Vendor Status
            $('body').on('click','.doA-vendorStatus', function(event){
                var r = confirm("Change user status?");
                if (r == true) {
                    let clicked = $(this);
                    let id = clicked.data('id');
                    let status = (clicked.is(':checked')) ? 1 : 0;
                    let data = {
                        t: 'users',
                        id: id,
                        status:status
                    }
                    ajaxCall ('core/status', data, function(response) {
                        let obj = JSON.parse(response);
                        if (obj.res) {
                            notify('Updated.', 'success', false);
                        } else {
                            notify('Error!', 'error', false);
                        }
                    });
                }
            });

            //  Delete User
            $('body').on('click','.doA-delete', function(event){
                var r = confirm("Delete a user!");
                if (r == true) {
                        let clicked = $(this);
                    let id = clicked.data('id');
                    let data = {
                        t: 'users',
                        id: id
                    }
                    ajaxCall ('core/delete', data, function(response) {
                        let obj = JSON.parse(response);
                        if (obj.res) {
                            notify('Deleted.', 'success', false);
                            clicked.closest("tr").remove();
                        } else {
                            notify('Error!', 'error', false);
                        }
                    });
                }
            });

        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>