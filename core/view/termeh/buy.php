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

        <?php \App\Core\m::print($this->data['product']); ?>

        <?php \App\Core\m::print($this->data['category']); ?>

        <?php \App\Core\m::print($this->data['tags']); ?>


        <?php if(is_user) { ?>
            <button class="doA-buy btn btn-primary" data-id="<?= $this->data['product']['id'] ?> ">Buy</button>
        <?php } ?>


    </main>

    <script>

        $( document ).ready(function() {

            //  Accept
            $('body').on('click','.doA-buy', function(event){
                let id = $(this).data('id');
                const data = {
                    id:id
                }
                ajaxCall ('request/buy', data,function(response) {
                    let obj = JSON.parse(response);
                    if(obj.e) {
                        notify('Error!','error',false);
                    } else {
                        window.location.replace("invoice&id="+obj.res);
                    }
                });
            });

        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>