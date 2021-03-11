<?php


$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Home';
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

        Request:
        <?php \App\Core\M::print($this->data['request']); ?>

        <?php if (is_vendor) { ?>
            <a class="btn btn-primary" href="new-offer&id=<?= $_GET['id'] ?>">Offer</a>
        <?php } ?>

        <hr>
        Offers:
        <?php if($this->data['offers']) foreach($this->data['offers'] as $offer) { ?>
            <div class="card">
                <?php \App\Core\M::print($offer); ?>

                <?php if ($_SESSION['M']['user']['id'] == $this->data['request']['user_id'] & !$this->data['request']['status']) { ?>
                  <button class="doA-Accept btn btn-success" data-id="<?= $offer['id'] ?>">Accept</button>
                <?php } ?>
            </div>
        <?php } ?>





    </main>

    <script>

        $( document ).ready(function() {


        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>