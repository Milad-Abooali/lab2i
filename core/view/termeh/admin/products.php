<?php


$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Admin Products';
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
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Tags</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($this->data['products']) foreach ($this->data['products'] as $item) { ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $this->data['vendor_shop'][$item['shop_id']]['title'] ?></td>
                            <td>
                                <?= $item['title'] ?>
                                <hr>
                                <img style="width:95px" src="<?= CDN.'upload/products/'.$item['id'].'/0.jpg'; ?>">
                            </td>
                            <td><?= $this->data['categories'][$item['category']]['title'] ?></td>
                            <td>
                                <?php
                                if($item['tags']) {
                                    $tags = explode(',',$item['tags']);
                                    foreach ($tags as $tag) echo '<span class="small badge-pill badge-info">'.$this->data['tags'][$tag]['name'].'</span><br>';
                                }
                                ?>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="<?= APP_URL ?>buy/<?= $item['id'] ?>">View</a>
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


            //  Delete Product
            $('body').on('click','.doA-delete', function(event){
                let clicked = $(this);
                let id = clicked.data('id');
                let data = {
                    t: 'products',
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
            });

        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>