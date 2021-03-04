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

                <form id="addCat" class="form-horizontal" method="post" action="cats/add">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="labels">Title</label>
                                <input type="text" class="form-control" placeholder="example" name="title" required >
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Excerpt</label>
                                <textarea class="form-control" placeholder="enter address" name="excerpt"> </textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Tags</label>
                                <select multiple="" class="selectpicker form-control" id="tags" name="tags[]" data-container="body" data-live-search="true" title="Select category tag" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="false" tabindex="-98">
                                    <?php foreach($this->data['tags'] as $item) { ?>
                                        <option id="<?= $item['id'] ?>"><?= $item['name'] ?>(<?= $item['count_c'] ?>)</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Excerpt</label>
                                <input type="text" class="form-control" placeholder="example" name="title" required >
                            </div>

                            <div class="col-md-12 text-center">
                                <button class="btn mt-2 col-md-6 btn-primary" type="submit">Add Tag</button>
                            </div>
                        </div>
                    </div>
                </form>

                <hr>

            </div>
        </div>


    </main>

    <?php } ?>
    <script>

        $( document ).ready(function() {


        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>