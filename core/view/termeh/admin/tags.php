<?php


$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Admin Settings';
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

                <form id="profile" class="form-horizontal" method="post" action="user/update">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">New Tag</label><input type="text" class="form-control" placeholder="example" name="tag" required >
                                <button class="btn mt-2 btn-block btn-primary float-right" type="submit">example</button>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                    </div>
                </form>

                <hr>
                <table id="tagsTable" class="table table-sm table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Mange</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($this->data['tags']) foreach ($this->data['tags'] as $item) { ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><input type="text" class="form-control" placeholder="example" name="tag" value="<?= $item['name'] ?>" disabled></td>
                            <td>
                                <button class="doA-delete btn mx-2 btn-sm btn-danger float-right" type="submit">Delete</button>
                                <button class="doP-edit btn mx-2 btn-sm btn-primary" type="submit">Edit</button>
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

            $('#tagsTable').DataTable();

        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>