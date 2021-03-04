<?php
/**
 * @ TODO Admin page session
 */

?>
<div class="accordion" id="adminMenu">
    <div class="menu-group">
        <div class="menu-title" id="headingOne">
            <div class="mb-0 py-2" data-toggle="collapse" data-target="#a0">
                <i class="fa fa-arrow-right"></i> Site Settings
            </div>
        </div>
        <div id="a0" class="collapse show" aria-labelledby="headingOne" data-parent="#adminMenu">
            <a class="d-block py-2 pl-4 border-bottom" href="#">General Settings</a>
            <a class="d-block py-2 pl-4 border-bottom" href="#">Categories</a>
            <a class="d-block py-2 pl-4 border-bottom" href="#">Products</a>
        </div>
    </div>
    <div class="menu-group">
        <div class="menu-title" id="headingTwo">
            <div class="mb-0 py-2" data-toggle="collapse" data-target="#a1">
                <i class="fa fa-arrow-right"></i>  Vendors
            </div>
        </div>
        <div id="a1" class="collapse" aria-labelledby="headingTwo" data-parent="#adminMenu">
            <a class="d-block py-2 pl-4 border-bottom" href="#">List Vendors</a>
            <a class="d-block py-2 pl-4 border-bottom" href="#">Verification</a>
            <a class="d-block py-2 pl-4 border-bottom" href="#">Reviews</a>
        </div>
    </div>
    <div class="menu-group">
        <div class="menu-title" id="headingThree">
            <div class="mb-0 py-2" data-toggle="collapse" data-target="#a2">
                <i class="fa fa-arrow-right"></i> Users
            </div>
        </div>
        <div id="a2" class="collapse" aria-labelledby="headingThree" data-parent="#adminMenu">
            <a class="d-block py-2 pl-4 border-bottom" href="#">List Users</a>
        </div>
    </div>
    <div class="menu-group">
        <div class="menu-title" id="headingThree">
            <div class="mb-0 py-2" data-toggle="collapse" data-target="#a3">
                <i class="fa fa-arrow-right"></i> Tenders & offers
            </div>
        </div>
        <div id="a3" class="collapse" aria-labelledby="headingThree" data-parent="#adminMenu">
            <a class="d-block py-2 pl-4 border-bottom" href="#">Active Tenders</a>
            <a class="d-block py-2 pl-4 border-bottom" href="#">Archive</a>
        </div>
    </div>
    <div class="menu-group">
        <div class="menu-title" id="headingThree">
            <div class="mb-0 py-2" data-toggle="collapse" data-target="#a4">
                <i class="fa fa-arrow-right"></i> Financial
            </div>
        </div>
        <div id="a4" class="collapse" aria-labelledby="headingThree" data-parent="#adminMenu">
            <a class="d-block py-2 pl-4 border-bottom" href="#">Invoices</a>
            <a class="d-block py-2 pl-4 border-bottom" href="#">Transactions</a>
        </div>
    </div>
    <div class="menu-group">
        <div class="menu-title" id="headingThree">
            <div class="mb-0 py-2" data-toggle="collapse" data-target="#a4">
                <i class="fa fa-arrow-right"></i> CMS
            </div>
        </div>
        <div id="a4" class="collapse" aria-labelledby="headingThree" data-parent="#adminMenu">
            <a class="d-block py-2 pl-4 border-bottom" href="#">Pages</a>
        </div>
    </div>
</div>



<script>
    $(document).ready(function(){
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