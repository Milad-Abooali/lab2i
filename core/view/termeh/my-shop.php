<?php

use App\Core\M;

$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Profile';
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
                <div class="col-md-9">
                    <div id="v-menu">
                        <ul>
                            <li>
                                <a href='account'>
                                    <i class='fa fa-user-circle-o'></i>
                                    <div>Profile</div>
                                </a>
                            </li>
                            <li>
                                <a href='dashboard'>
                                    <i class='fa fa-briefcase'></i>
                                    <div>Overview</div>
                                </a>
                            </li>
                            <li class='current'>
                                <a href='my-shop'>
                                    <i class='fa fa-gears'></i>
                                    <div>My Shop</div>
                                </a>
                            </li>
                            <li>
                                <a href='my-offers'>
                                    <i class='fa fa-gavel'></i>
                                    <div>Auctions</div>
                                </a>
                            </li>
                            <li>
                                <a href='statistics'>
                                    <i class='fa fa-bar-chart'></i>
                                    <div>Statistics</div>
                                </a>
                            </li>
                            <li>
                                <a href='reviews'>
                                    <i class='fa fa-wechat'></i>
                                    <div>Reviews</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 small">
                    <ul class="list-group">
                        <li class="list-group-item">Active Offers <span class="float-right">23</span></li>
                        <li class="list-group-item">Pending Orders <span class="float-right">4</span></li>
                        <li class="list-group-item">Active Products <span class="float-right">15</span></li>
                    </ul>
                </div>
                <div class="col-md-12 border-top pt-3 mt-3">

                    <div class="row">
                        <link href="<?= CSS ?>s-menu.css" rel="stylesheet" />
                        <div id="s-menu" class="col-md-3 border-right">
                            <div class="tabbable tabs-left">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                                    <li><a href="#about" data-toggle="tab">About</a></li>
                                    <li><a href="#services" data-toggle="tab">Services</a></li>
                                    <li><a href="#contact" data-toggle="tab">Contact</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home">
                                        <div class="">
                                            <h1>Home Tab</h1>
                                            <p>These lists are meant to identify articles which deserve editor attention because they are the most important for an encyclopedia to have, as determined by the community of participating editors. They may also be of interest to readers as an alternative to lists of overview articles.</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="about">
                                        <div class="">
                                            <h1>About Tab</h1>
                                            <p>because they are the most important for an encyclopedia to have, as determined by the community of participating editors. They may also be of interest to readers as an alternative to lists of overview articles.</p>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="services">
                                        <div class="">
                                            <h1>Services Tab</h1>
                                            <p>meant to identify articles which deserve editor attention because they are the most important for an encyclopedia to have, as determined by the community of participating editors. They may also be of interest to readers as an alternative to lists of overview articles.</p>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="contact">
                                        <div class="">
                                            <h1>Contact Tab</h1>
                                            <p>deserve editor attention because they are the most important for an encyclopedia to have, as determined by the community of participating editors. They may also be of interest to readers as an alternative to lists of overview articles.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            content

                        </div>
                    </div>
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

        //  update
        $('body').on('submit','form#update', function(event){
            event.preventDefault();
            const data = $(this).serialize();
            const classA = $(this).attr('action');
            ajaxCall (classA, data,function(response) {
                let obj = JSON.parse(response);
                $('form#update').append('<p class="alert alert-success noticForm"><i class="text-success fa fa-check"></i> Account updated</p>');
                setTimeout(function(){
                    $(".noticForm").fadeOut();
                }, 1500);
            });
        });
    </script>

<?php include_once $this->PATH."global/footer.php"; ?>