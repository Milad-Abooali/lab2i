<?php


$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Admin Lıst Vendors';
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
                            <th>Address</th>
                            <th>Active</th>
                            <th>Verify</th>
                            <th>Admin</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($this->data['vendor_shop']) foreach ($this->data['vendor_shop'] as $item) { ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <td><?= $item['f_name'] ?> <?= $item['l_name'] ?></td>
                            <td><?= $item['address'] ?></td>
                            <td class="text-center">
                                <div class="custom-control custom-switch">
                                    <input data-id="<?= $item['id'] ?>" type="checkbox" class="doA-vendorStatus custom-control-input" id="status-<?= $item['id'] ?>" <?= ($item['status']) ? 'checked' : null ?> >
                                    <label class="custom-control-label" for="status-<?= $item['id'] ?>"></label>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="custom-control custom-switch">
                                    <input data-t="vendors" data-c="verify" data-id="<?= $item['id'] ?>" type="checkbox" class="doA-update custom-control-input" id="verify-<?= $item['id'] ?>" <?= ($item['verify']) ? 'checked' : null ?> >
                                    <label class="custom-control-label" for="verify-<?= $item['id'] ?>"></label>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="custom-control custom-switch">
                                    <input data-t="vendors" data-c="admin" data-id="<?= $item['id'] ?>" type="checkbox" class="doA-update custom-control-input" id="admin-<?= $item['id'] ?>" <?= ($item['admin']) ? 'checked' : null ?> >
                                    <label class="custom-control-label" for="admin-<?= $item['id'] ?>"></label>
                                </div>
                            </td>
                            <td>
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
                var r = confirm("Change vendor status?");
                if (r == true) {
                    let clicked = $(this);
                    let id = clicked.data('id');
                    let status = (clicked.is(':checked')) ? 1 : 0;
                    let data = {
                        t: 'vendors',
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

            //  Update
            $('body').on('click','.doA-update', function(event){
                let clicked = $(this);
                let t = clicked.data('t');
                let c = clicked.data('c');
                let id = clicked.data('id');
                let s = (clicked.is(':checked')) ? 1 : 0;
                let data = {
                    t: t,
                    c: c,
                    id: id,
                    s:s
                }
                ajaxCall ('core/update', data, function(response) {
                    let obj = JSON.parse(response);
                    if (obj.res) {
                        notify('Updated.', 'success', false);
                    } else {
                        notify('Error!', 'error', false);
                    }
                });
            });

            //  Delete Vendor
            $('body').on('click','.doA-delete', function(event){
                var r = confirm("Delete a vendor!");
                if (r == true) {
                        let clicked = $(this);
                    let id = clicked.data('id');
                    let data = {
                        t: 'vendors',
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