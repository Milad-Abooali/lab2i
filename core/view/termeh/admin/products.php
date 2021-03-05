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

                <form id="addProducts" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="labels">Title</label>
                                <input type="text" class="form-control" placeholder="example" name="title" required>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Category</label>
                                <select class="selectpicker form-control" id="tags" name="category" data-container="body" data-live-search="true" title="Category" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="false" tabindex="-98" required>
                                    <?php foreach($this->data['categories'] as $category) { ?>
                                        <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn mt-2 col-md-6 btn-primary" type="submit">Add Product</button>
                            </div>
                        </div>
                    </div>
                </form>

                <hr>

                <table id="categoriesTable" class="table table-sm table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($this->data['categories']) foreach ($this->data['categories'] as $item) { ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['category'] ?></td>
                            <td>
                                <button class="doA-delete btn btn-sm btn-danger" data-id="<?= $item['id'] ?>">Delete</button>
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
            $('#categoriesTable').DataTable();


            //  Delete Category
            $('body').on('click','.doA-delete', function(event){
                let clicked = $(this);
                let id = clicked.data('id');
                let data = {
                    t: 'categories',
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