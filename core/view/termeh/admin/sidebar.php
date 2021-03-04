<?php
/**
 * @ TODO Admin page session
 */

?>
<div class="accordion" id="adminMenu">
    <a class="d-block py-2 pl-4 border-bottom" href="<?= APP_URL ?>admin">Admin Dashboard</a>
    <div class="menu-group">
        <div class="menu-title" id="headingOne">
            <div class="mb-0 py-2" data-toggle="collapse" data-target="#a0">
                <i class="fa fa-arrow-right"></i> Site Settings
            </div>
        </div>
        <div id="a0" class="collapse" aria-labelledby="headingOne" data-parent="#adminMenu">
            <a class="d-block py-2 pl-4 border-bottom" href="<?= APP_URL ?>admin/settings">General Settings</a>
            <a class="d-block py-2 pl-4 border-bottom" href="<?= APP_URL ?>admin/categories">Categories</a>
            <a class="d-block py-2 pl-4 border-bottom" href="<?= APP_URL ?>admin/products">Products</a>
        </div>
    </div>
    <div class="menu-group">
        <div class="menu-title" id="headingTwo">
            <div class="mb-0 py-2" data-toggle="collapse" data-target="#a1">
                <i class="fa fa-arrow-right"></i>  Vendors
            </div>
        </div>
        <div id="a1" class="collapse" aria-labelledby="headingTwo" data-parent="#adminMenu">
            <a class="d-block py-2 pl-4 border-bottom" href="<?= APP_URL ?>admin/list-vendors">List Vendors</a>
            <a class="d-block py-2 pl-4 border-bottom" href="<?= APP_URL ?>admin/verification">Verification</a>
            <a class="d-block py-2 pl-4 border-bottom" href="<?= APP_URL ?>admin/reviews">Reviews</a>
        </div>
    </div>
    <div class="menu-group">
        <div class="menu-title" id="headingThree">
            <div class="mb-0 py-2" data-toggle="collapse" data-target="#a2">
                <i class="fa fa-arrow-right"></i> Users
            </div>
        </div>
        <div id="a2" class="collapse" aria-labelledby="headingThree" data-parent="#adminMenu">
            <a class="d-block py-2 pl-4 border-bottom" href="<?= APP_URL ?>admin/list-users">List Users</a>
        </div>
    </div>
    <div class="menu-group">
        <div class="menu-title" id="headingThree">
            <div class="mb-0 py-2" data-toggle="collapse" data-target="#a3">
                <i class="fa fa-arrow-right"></i> Tenders & offers
            </div>
        </div>
        <div id="a3" class="collapse" aria-labelledby="headingThree" data-parent="#adminMenu">
            <a class="d-block py-2 pl-4 border-bottom" href="<?= APP_URL ?>admin/active-tenders">Active Tenders</a>
            <a class="d-block py-2 pl-4 border-bottom" href="<?= APP_URL ?>admin/tenders-archive">Tenders Archive</a>
        </div>
    </div>
    <div class="menu-group">
        <div class="menu-title" id="headingThree">
            <div class="mb-0 py-2" data-toggle="collapse" data-target="#a4">
                <i class="fa fa-arrow-right"></i> Financial
            </div>
        </div>
        <div id="a4" class="collapse" aria-labelledby="headingThree" data-parent="#adminMenu">
            <a class="d-block py-2 pl-4 border-bottom" href="<?= APP_URL ?>admin/invoices">Invoices</a>
            <a class="d-block py-2 pl-4 border-bottom" href="<?= APP_URL ?>admin/transactions">Transactions</a>
        </div>
    </div>
    <div class="menu-group">
        <div class="menu-title" id="headingThree">
            <div class="mb-0 py-2" data-toggle="collapse" data-target="#a5">
                <i class="fa fa-arrow-right"></i> CMS
            </div>
        </div>
        <div id="a5" class="collapse" aria-labelledby="headingThree" data-parent="#adminMenu">
            <a class="d-block py-2 pl-4 border-bottom" href="<?= APP_URL ?>admin/pages">Pages</a>
        </div>
    </div>
</div>



<script>
    $(document).ready(function(){

        // Menu Select Active Link
        var adminMenuLink = $("#adminMenu a[href$='<?= $_GET['rout'] ?>']");
        adminMenuLink.addClass('font-weight-bold');
        adminMenuLink.closest( ".menu-group").find('.menu-title>div').trigger('click');

        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
            $(this).prev(".menu-title").find(".fa").addClass("fa-arrow-down").removeClass("fa-arrow-right");
        });

        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
            $(this).prev(".menu-title").find(".fa").removeClass("fa-arrow-right").addClass("fa-arrow-down");
        }).on('hide.bs.collapse', function(){
            $(this).prev(".menu-title").find(".fa").removeClass("fa-arrow-down").addClass("fa-arrow-right");
        });
    });
</script>