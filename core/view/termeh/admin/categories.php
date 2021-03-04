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

                @TODO | Site Categories
                
                <!--
                <form id="profile" class="form-horizontal" method="post" action="user/update">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">My Profile</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" name="f_name" value="<?= $_SESSION['M']['user']['f_name'] ?? null ?>"></div>
                            <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" placeholder="surname" name="l_name" value="<?= $_SESSION['M']['user']['l_name'] ?? null ?>" ></div>
                        </div>

                        <div class="my-4 alert form-alert"></div>
                        <hr>
                        <div class="mt-4 text-center"><button class="btn btn-sm btn-primary float-right" type="submit">Save</button></div>
                    </div>
                </form>
                -->

            </div>
        </div>


    </main>

    <?php } ?>
    <script>

        $( document ).ready(function() {


        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>