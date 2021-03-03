
<div class="col-md-9">
    <div id="v-menu">
        <ul>
            <li <?= ($_GET['rout']=='account') ? 'class="current"' : null ?> >
                <a href='account'>
                    <i class='fa fa-user-circle-o'></i>
                    <div>Profile</div>
                </a>
            </li>
            <li <?= ($_GET['rout']=='dashboard') ? 'class="current"' : null ?>>
                <a href='dashboard'>
                    <i class='fa fa-briefcase'></i>
                    <div>Overview</div>
                </a>
            </li>
            <li <?= ($_GET['rout']=='my-shop') ? 'class="current"' : null ?>>
                <a href='my-shop'>
                    <i class='fa fa-shopping-bag'></i>
                    <div>My Shop</div>
                </a>
            </li>
            <li <?= ($_GET['rout']=='my-offers') ? 'class="current"' : null ?> >
                <a href='my-offers'>
                    <i class='fa fa-gavel'></i>
                    <div>Auctions</div>
                </a>
            </li>
            <li <?= ($_GET['rout']=='my-orders') ? 'class="current"' : null ?> >
                <a href='my-orders'>
                    <i class='fa  fa-flash'></i>
                    <div>Orders</div>
                </a>
            </li>
            <li <?= ($_GET['rout']=='reviews') ? 'class="current"' : null ?> >
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
        <li class="list-group-item"><a href="my-offers">Active Offers <span class="float-right">23</span></a></li>
        <li class="list-group-item"><a href="my-orders">Pending Orders <span class="float-right">4</span></a></li>
        <li class="list-group-item"><a href="my-shop">Active Products <span class="float-right">15</span></a></li>
    </ul>
</div>