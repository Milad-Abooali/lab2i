<?php


$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Admin Requests Archive';
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
                <table id="TendersTable" class="table table-sm table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Tags</th>
                            <th>Expire</th>
                            <th>Winner</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($this->data['Requests']) foreach ($this->data['Requests'] as $item) { ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td>
                                <?php
                                    $owner = \App\Core\F::getUserByID($item['user_id']);
                                    echo $owner['f_name'].' '.$owner['l_name'];
                                ?>
                            </td>
                            <td><?= $item['title'] ?></td>
                            <td>
                                <?php
                                if($item['tags']) {
                                    $tags = explode(',',$item['tags']);
                                    foreach ($tags as $tag) echo '<span class="small badge-pill badge-info">'.$this->data['tags'][$tag]['name'].'</span><br>';
                                }
                                ?>
                            </td>
                            <td><?php \App\Core\F::status($item['status'],'ico') ?> <?= $item['expire'] ?></td>
                            <td><?php if($item['Vendor_id']) { echo $this->data['vendor_shop'][$item['Vendor_id']]['title']; ?> | <?php $item['offer_id']; } ?></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="<?= APP_URL ?>request&id=<?= $item['id'] ?>">View</a>
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


            //  Delete Request
            $('body').on('click','.doA-delete', function(event){
                var r = confirm("Delete a product!");
                if (r == true) {
                    let clicked = $(this);
                    let id = clicked.data('id');
                    let data = {
                        t: 'requests',
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