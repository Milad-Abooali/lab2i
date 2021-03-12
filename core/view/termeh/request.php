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

                <?php if ($_SESSION['M']['user']['id'] == $this->data['request']['user_id']) { ?>

                    <?php if (!$this->data['request']['status']) { ?>
                      <button class="doA-Accept btn btn-success" data-id="<?= $offer['id'] ?>">Accept</button>
                    <?php } elseif ($this->data['request']['offer_id'] === $offer['id'] ) { ?>

                    <?php if ($this->data['request']['invoice_id']) { ?>
                            <?php if ($this->data['invoice']['date_paid']) { ?>
                                <button class="doM-voucher btn btn-success" data-id="<?= $offer['id'] ?>">Show Voucher</button>
                            <?php } else { ?>
                                <a href="invoice&id=<?= $this->data['invoice']['id'] ?>" class="btn btn-success">Pay Invoice</a>
                            <?php } ?>
                    <?php } ?>

                <?php } ?>

                <?php } ?>
            </div>
        <?php } ?>





    </main>

    <script>

        $( document ).ready(function() {

            //  Accept
            $('body').on('click','.doA-Accept', function(event){
                let id = $(this).data('id');
                const data = {
                    id:id
                }
                ajaxCall ('request/acceptOffer', data,function(response) {
                    let obj = JSON.parse(response);
                    if(obj.e) {
                        notify('Error!','error',false);
                    } else {
                        location.reload();
                    }
                });
            });

        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>