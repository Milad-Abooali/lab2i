<?php

use App\Core\M;

$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'New Offer';
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

        <?php if (is_vendor){ ?>
            <link href="<?= CSS ?>v-menu.css" rel="stylesheet" />

        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">

                <div class="col-md-12">


                    <form id="addProduct" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                        <section class="row">

                            <?php if ($error ?? false) { ?>
                                <div class="alert alert-danger"><?= $this->data['error'] ?></div>
                            <?php } ?>

                            <!-- Main Information -->
                            <div class="col-md-8">
                                <label class="labels">Title</label>
                                <input type="text" class="form-control" placeholder="example" name="title" required>
                            </div>
                            <div class="col-md-4">
                                <label class="labels">Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">$</span>
                                    </div>
                                    <input type="number" class="price form-control" min="0.00" max="10000.00" step="0.01" id="transferAmount" name="price">
                                </div>                            </div>
                            <div class="col-md-12 my-3">
                                <label class="labels">Description</label>
                                <textarea class="form-control" placeholder="enter Description" name="excerpt" required> </textarea>
                            </div>

                            <div class="col-md-12 my-3 text-center">
                                <h5>Media</h5>
                            </div>

                            <div class="col-md-6">
                                <label class="labels">Images <sup>1 image required</sup></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image1" name="image[]" accept="image/*">
                                    <label class="custom-file-label" for="image1">Choose file</label>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image2" name="image[]" accept="image/*">
                                    <label class="custom-file-label" for="image2">Choose file</label>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image3" name="image[]" accept="image/*">
                                    <label class="custom-file-label" for="image3">Choose file</label>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image4" name="image[]" accept="image/*">
                                    <label class="custom-file-label" for="image4">Choose file</label>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image5" name="image[]" accept="image/*">
                                    <label class="custom-file-label" for="image5">Choose file</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Video <sup>Optional</sup></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="video1" name="video[]" accept="video/*">
                                    <label class="custom-file-label" for="video1">Choose file</label>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="video2" name="video[]" accept="video/*">
                                    <label class="custom-file-label" for="video2">Choose file</label>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="video3" name="video[]" accept="video/*">
                                    <label class="custom-file-label" for="video3">Choose file</label>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3 text-center">
                                <input type="hidden" name="id" value="<?= $_GET['id'] ?>" required>
                                <button class="btn mt-2 btn-primary px-5" type="submit">Add Offer</button>
                            </div>

                        </section>
                    </form>


                </div>
            </div>
        </div>
        <?php } else { ?>
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3">
                    Please Login ...
                </div>
        </div>
        <?php } ?>

    </main>

    <script>
        $( document ).ready(function() {
            CKEDITOR.replace( 'excerpt' );
        });
    </script>

<?php include_once $this->PATH."global/footer.php"; ?>