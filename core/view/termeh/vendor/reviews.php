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

                <?php include_once $this->PATH."global/v-menu.php"; ?>

                <div class="col-md-12 border-top pt-3 mt-3">


                    <div class="panel panel-default widget">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-comment"></span>
                            <h3 class="panel-title">
                                Recent Reviews</h3>
                            <span class="label label-info">
                    78</span>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-xs-2 col-md-1">
                                            <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                                        <div class="col-xs-10 col-md-11">
                                            <div>
                                                <a href="http://bootsnipp.com/BhaumikPatel/snippets/4ldn">Cool Sign Up</a>
                                                <div class="mic-info">
                                                    By: <a href="#">Bhaumik Patel</a> on 11 Nov 2013
                                                </div>
                                            </div>
                                            <div class="comment-text">
                                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                                euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim
                                            </div>
                                            <div class="action text-right">
                                                <button type="button" class="btn btn-success btn-xs" title="Delete" data-toggle="tooltip" data-placement="top" title="Add response">
                                                    <i class="fa fa-mail-reply"></i> Reply
                                                </button>
                                                <button type="button" class="btn btn-outline-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Report This">
                                                    <i class="fa fa-warning"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-xs-2 col-md-1">
                                            <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                                        <div class="col-xs-10 col-md-11">
                                            <div>
                                                <a href="http://bootsnipp.com/BhaumikPatel/snippets/4ldn">Cool Sign Up</a>
                                                <div class="mic-info">
                                                    By: <a href="#">Bhaumik Patel</a> on 11 Nov 2013
                                                </div>
                                            </div>
                                            <div class="comment-text">
                                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                                euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim
                                            </div>
                                            <div class="action text-right">
                                                <button type="button" class="btn btn-success btn-xs" title="Delete" data-toggle="tooltip" data-placement="top" title="Add response">
                                                    <i class="fa fa-mail-reply"></i> Reply
                                                </button>
                                                <button type="button" class="btn btn-outline-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Report This">
                                                    <i class="fa fa-warning"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-xs-2 col-md-1">
                                            <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                                        <div class="col-xs-10 col-md-11">
                                            <div>
                                                <a href="http://bootsnipp.com/BhaumikPatel/snippets/4ldn">Cool Sign Up</a>
                                                <div class="mic-info">
                                                    By: <a href="#">Bhaumik Patel</a> on 11 Nov 2013
                                                </div>
                                            </div>
                                            <div class="comment-text">
                                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                                euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim
                                            </div>
                                            <div class="action text-right">
                                                <button type="button" class="btn btn-success btn-xs" title="Delete" data-toggle="tooltip" data-placement="top" title="Add response">
                                                    <i class="fa fa-mail-reply"></i> Reply
                                                </button>
                                                <button type="button" class="btn btn-outline-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Report This">
                                                    <i class="fa fa-warning"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-primary btn-sm btn-block" role="button"><span class="glyphicon glyphicon-refresh"></span> More</a>
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